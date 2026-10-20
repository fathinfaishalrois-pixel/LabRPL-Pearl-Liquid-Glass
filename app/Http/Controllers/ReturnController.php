<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Loan;
use App\Models\ReturnRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReturnController extends Controller
{
    public function index()
    {
        $loans = Loan::with(['user', 'items.equipment', 'returnRecord'])
            ->whereIn('status', ['disetujui', 'dikembalikan'])->latest()->paginate(10);
        return view('returns.index', compact('loans'));
    }

    public function create(Loan $loan)
    {
        abort_unless($loan->status === 'disetujui', 404);
        $loan->load(['user', 'items.equipment']);
        return view('returns.create', compact('loan'));
    }

    public function store(Request $request, Loan $loan)
    {
        abort_unless($loan->status === 'disetujui', 404);
        $data = $request->validate([
            'condition' => ['required', 'in:baik,perlu_perbaikan,rusak'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        DB::transaction(function () use ($loan, $data) {
            foreach ($loan->items as $item) {
                Equipment::whereKey($item->equipment_id)->lockForUpdate()->firstOrFail()
                    ->increment('stock', $item->quantity);
            }
            ReturnRecord::create([
                'loan_id' => $loan->id, 'returned_at' => now(),
                'condition' => $data['condition'], 'notes' => $data['notes'] ?? null,
            ]);
            $loan->update(['status' => 'dikembalikan']);
        });

        return redirect()->route('pengembalian.index')->with('success', 'Pengembalian dicatat dan stok diperbarui.');
    }
}
