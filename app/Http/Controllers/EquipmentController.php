<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EquipmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Equipment::query();
        if ($request->filled('q')) {
            $q = $request->string('q');
            $query->where(fn ($sub) => $sub->where('name', 'like', "%{$q}%")
                ->orWhere('code', 'like', "%{$q}%")->orWhere('category', 'like', "%{$q}%"));
        }
        $equipment = $query->latest()->paginate(10)->withQueryString();
        return view('equipment.index', compact('equipment'));
    }

    public function create() { return view('equipment.form', ['equipment' => new Equipment()]); }
    public function store(Request $request)
    {
        $data = $this->validated($request);
        Equipment::create($data);
        return redirect()->route('alat.index')->with('success', 'Alat berhasil ditambahkan.');
    }

    public function show(Equipment $equipment) { return view('equipment.show', compact('equipment')); }
    public function edit(Equipment $equipment) { return view('equipment.form', compact('equipment')); }

    public function update(Request $request, Equipment $equipment)
    {
        $equipment->update($this->validated($request, $equipment));
        return redirect()->route('alat.index')->with('success', 'Data alat diperbarui.');
    }

    public function destroy(Equipment $equipment)
    {
        if ($equipment->loanItems()->exists()) {
            return back()->with('error', 'Alat memiliki riwayat peminjaman, sehingga tidak dapat dihapus.');
        }
        $equipment->delete();
        return redirect()->route('alat.index')->with('success', 'Alat berhasil dihapus.');
    }

    public function updateStock(Request $request, Equipment $equipment)
    {
        abort_unless(auth()->user()->role === 'admin', 403);
        $data = $request->validate(['stock' => ['required', 'integer', 'min:0']]);
        $equipment->update($data);
        return back()->with('success', 'Stok diperbarui.');
    }

    private function validated(Request $request, ?Equipment $equipment = null): array
    {
        return $request->validate([
            'code' => ['required', 'string', 'max:40', Rule::unique('equipment', 'code')->ignore($equipment?->id)],
            'name' => ['required', 'string', 'max:120'],
            'category' => ['required', 'string', 'max:80'],
            'stock' => ['required', 'integer', 'min:0'],
            'condition' => ['required', Rule::in(['baik', 'perlu_perbaikan', 'rusak'])],
        ]);
    }
}
