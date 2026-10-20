<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class LoanController extends Controller
{
    public function index()
    {
        $query = Loan::with(['user', 'items.equipment'])->latest();
        if (auth()->user()->role !== 'admin') $query->where('user_id', auth()->id());
        $loans = $query->paginate(10);
        return view('loans.index', compact('loans'));
    }

    public function create()
    {
        $equipment = Equipment::where('stock', '>', 0)->orderBy('name')->get();
        return view('loans.create', compact('equipment'));
    }

    public function store(Request $request)
    {
        // Kuantitas 0 berarti item tidak dipilih; buang sebelum validasi.
        $selectedItems = collect($request->input('items', []))
            ->filter(fn ($item) => (int) ($item['quantity'] ?? 0) > 0)
            ->values()
            ->all();
        $request->merge(['items' => $selectedItems]);

        $data = $request->validate([
            'loan_date' => ['required', 'date', 'after_or_equal:today'],
            'due_date' => ['required', 'date', 'after_or_equal:loan_date'],
            'notes' => ['nullable', 'string', 'max:1000'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.equipment_id' => ['required', 'exists:equipment,id', 'distinct'],
            'items.*.quantity' => ['required', 'integer', 'min:1', 'max:100'],
        ]);

        $loan = DB::transaction(function () use ($data) {
            $loan = Loan::create([
                'user_id' => auth()->id(), 'loan_date' => $data['loan_date'],
                'due_date' => $data['due_date'], 'notes' => $data['notes'] ?? null,
                'status' => 'menunggu',
            ]);
            foreach ($data['items'] as $item) {
                $equipment = Equipment::findOrFail($item['equipment_id']);
                if ($item['quantity'] > $equipment->stock) {
                    throw ValidationException::withMessages(['items' => "Stok {$equipment->name} tidak mencukupi."]);
                }
                $loan->items()->create([
                    'equipment_id' => $equipment->id, 'quantity' => $item['quantity'],
                ]);
            }
            return $loan;
        });

        return redirect()->route('peminjaman.show', $loan)->with('success', 'Pengajuan peminjaman dikirim.');
    }

    public function show(Loan $loan)
    {
        abort_if(auth()->user()->role !== 'admin' && $loan->user_id !== auth()->id(), 403);
        $loan->load(['user', 'items.equipment', 'returnRecord']);
        return view('loans.show', compact('loan'));
    }

    public function destroy(Loan $loan)
    {
        abort_if(auth()->user()->role !== 'admin' && $loan->user_id !== auth()->id(), 403);
        if (!in_array($loan->status, ['menunggu', 'ditolak'])) {
            return back()->with('error', 'Hanya pengajuan menunggu/ditolak yang dapat dibatalkan.');
        }
        $loan->delete();
        return redirect()->route('peminjaman.index')->with('success', 'Pengajuan dibatalkan.');
    }

    public function updateStatus(Request $request, Loan $loan)
    {
        $data = $request->validate(['status' => ['required', 'in:disetujui,ditolak']]);
        if ($loan->status !== 'menunggu') return back()->with('error', 'Status transaksi sudah diproses.');

        DB::transaction(function () use ($loan, $data) {
            if ($data['status'] === 'disetujui') {
                foreach ($loan->items as $item) {
                    $equipment = Equipment::whereKey($item->equipment_id)->lockForUpdate()->firstOrFail();
                    if ($equipment->stock < $item->quantity) {
                        throw ValidationException::withMessages(['status' => "Stok {$equipment->name} tidak mencukupi."]);
                    }
                    $equipment->decrement('stock', $item->quantity);
                }
            }
            $loan->update(['status' => $data['status']]);
        });

        return back()->with('success', 'Status peminjaman diperbarui.');
    }
}
