@extends('layouts.app')
@section('title','Pengembalian')
@section('heading','Pengembalian Alat')
@section('subtitle','Catat pengembalian alat dan periksa kondisi saat diterima.')
@section('content')
<div class="card"><div class="section-title"><div><h2>Transaksi pengembalian</h2><p>Hanya peminjaman yang disetujui dapat dikembalikan.</p></div></div>
<div class="table-wrap"><table><thead><tr><th>PEMINJAM</th><th>ALAT</th><th>JATUH TEMPO</th><th>STATUS</th><th>AKSI</th></tr></thead><tbody>
@forelse($loans as $loan)<tr><td><div class="item-main">{{ $loan->user->name }}</div><div class="item-sub">#{{ $loan->id }}</div></td><td>{{ $loan->items->map(fn($i)=>$i->equipment->name.' × '.$i->quantity)->join(', ') }}</td><td>{{ $loan->due_date->format('d M Y') }}</td><td><span class="badge {{ $loan->status }}">{{ ucfirst($loan->status) }}</span></td><td>@if($loan->status==='disetujui')<a class="btn small" href="{{ route('pengembalian.create',$loan) }}">Proses kembali</a>@else<span class="hint">Sudah dikembalikan</span>@endif</td></tr>
@empty<tr><td colspan="5"><div class="empty">Belum ada transaksi untuk pengembalian.</div></td></tr>@endforelse
</tbody></table></div><div class="pagination">{{ $loans->links() }}</div></div>
@endsection
