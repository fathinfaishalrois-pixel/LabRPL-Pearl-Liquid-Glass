@extends('layouts.app')
@section('title','Ajukan Peminjaman')
@section('heading','Ajukan Peminjaman')
@section('subtitle','Pilih alat yang dibutuhkan dan tentukan tanggal pengembalian.')
@section('content')
<div class="card" style="max-width:900px"><form method="POST" action="{{ route('peminjaman.store') }}">@csrf
<div class="form-grid"><div class="field"><label>Tanggal pinjam</label><input class="input" type="date" name="loan_date" min="{{ now()->toDateString() }}" value="{{ old('loan_date',now()->toDateString()) }}" required></div><div class="field"><label>Rencana pengembalian</label><input class="input" type="date" name="due_date" min="{{ now()->toDateString() }}" value="{{ old('due_date',now()->addDays(2)->toDateString()) }}" required></div></div>
<div class="field" style="margin-top:20px"><label>Alat dan jumlah</label><div class="hint">Pilih minimal satu alat. Jumlah tidak boleh melebihi stok tersedia.</div>
@forelse($equipment as $item)<div style="display:grid;grid-template-columns:minmax(0,1fr) 100px;gap:12px;align-items:center;padding:12px 0;border-bottom:1px solid #edf1f7"><label style="font-size:12px"><strong>{{ $item->name }}</strong><div class="hint">{{ $item->code }} · {{ $item->category }} · Stok {{ $item->stock }}</div></label><div><input class="input" type="number" name="items[{{ $loop->index }}][quantity]" min="0" max="{{ $item->stock }}" value="{{ old('items.'.$loop->index.'.quantity',0) }}"><input type="hidden" name="items[{{ $loop->index }}][equipment_id]" value="{{ $item->id }}"></div></div>
@empty<div class="empty">Tidak ada alat yang tersedia.</div>@endforelse</div>
<div class="field" style="margin-top:20px"><label>Catatan (opsional)</label><textarea class="textarea" rows="3" name="notes" placeholder="Keperluan penggunaan alat...">{{ old('notes') }}</textarea></div>
<div class="form-actions"><a class="btn ghost" href="{{ route('peminjaman.index') }}">Batal</a><button class="btn" type="submit">Kirim pengajuan →</button></div>
</form></div>
@endsection
