@extends('layouts.app')
@section('title','Proses Pengembalian')
@section('heading','Proses Pengembalian')
@section('subtitle','Konfirmasi kondisi alat yang diterima dari peminjam.')
@section('content')
<div class="card" style="max-width:850px"><div class="section-title"><div><h2>Transaksi #{{ $loan->id }}</h2><p>{{ $loan->user->name }} · Jatuh tempo {{ $loan->due_date->format('d M Y') }}</p></div><span class="badge disetujui">Disetujui</span></div>
<div class="table-wrap"><table><thead><tr><th>ALAT</th><th>KODE</th><th>JUMLAH</th></tr></thead><tbody>@foreach($loan->items as $item)<tr><td>{{ $item->equipment->name }}</td><td>{{ $item->equipment->code }}</td><td>{{ $item->quantity }}</td></tr>@endforeach</tbody></table></div>
<form method="POST" action="{{ route('pengembalian.store',$loan) }}" style="margin-top:22px">@csrf
<div class="field"><label>Kondisi saat dikembalikan</label><select class="select" name="condition" required><option value="baik">Baik</option><option value="perlu_perbaikan">Perlu perbaikan</option><option value="rusak">Rusak</option></select></div>
<div class="field"><label>Catatan pemeriksaan (opsional)</label><textarea class="textarea" name="notes" rows="3" placeholder="Catat kerusakan atau kelengkapan yang kurang..."></textarea></div>
<div class="alert" style="background:#eff6ff;color:#2457bd">Setelah disimpan, status peminjaman menjadi “Dikembalikan” dan jumlah stok akan ditambah kembali.</div>
<div class="form-actions"><a class="btn ghost" href="{{ route('pengembalian.index') }}">Batal</a><button class="btn" type="submit">Konfirmasi pengembalian →</button></div>
</form></div>
@endsection
