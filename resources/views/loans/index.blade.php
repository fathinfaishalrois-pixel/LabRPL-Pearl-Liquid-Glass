@extends('layouts.app')
@section('title','Peminjaman')
@section('heading','Peminjaman Alat')
@section('subtitle','Pantau permintaan, status persetujuan, dan tanggal pengembalian.')
@section('content')
<div class="card"><div class="section-title"><div><h2>Daftar transaksi</h2><p>{{ $loans->total() }} transaksi peminjaman</p></div><a class="btn" href="{{ route('peminjaman.create') }}">＋ Ajukan peminjaman</a></div>
<div class="table-wrap"><table><thead><tr><th>PEMINJAM</th><th>ALAT</th><th>TANGGAL PINJAM</th><th>TANGGAL KEMBALI</th><th>STATUS</th><th>AKSI</th></tr></thead><tbody>
@forelse($loans as $loan)<tr><td><div class="item-main">{{ $loan->user->name }}</div><div class="item-sub">{{ $loan->user->email }}</div></td><td>{{ $loan->items->map(fn($i)=>$i->equipment->name.' × '.$i->quantity)->join(', ') }}</td><td>{{ $loan->loan_date->format('d M Y') }}</td><td>{{ $loan->due_date->format('d M Y') }}</td><td><span class="badge {{ $loan->status }}">{{ ucfirst($loan->status) }}</span></td><td><a class="btn secondary small" href="{{ route('peminjaman.show',$loan) }}">Detail</a></td></tr>
@empty<tr><td colspan="6"><div class="empty">Belum ada pengajuan peminjaman.</div></td></tr>@endforelse
</tbody></table></div><div class="pagination">{{ $loans->links() }}</div></div>
@endsection
