@extends('layouts.app')
@section('title','Dashboard')
@section('heading','Dashboard')
@section('subtitle', auth()->user()->role === 'admin' ? 'Ringkasan operasional laboratorium RPL hari ini.' : 'Pantau alat yang kamu pinjam dan pengajuan peminjamanmu.')
@section('content')
<div class="stats">
  <div class="card stat" style="--tint:#dbeafe"><div class="stat-label">{{ auth()->user()->role === 'admin' ? 'Total jenis alat' : 'Jenis alat terdaftar' }}</div><div class="stat-value">{{ $stats['equipment'] }}</div><div class="stat-foot">Inventaris terdaftar</div></div>
  <div class="card stat" style="--tint:#d1fae5"><div class="stat-label">Unit tersedia</div><div class="stat-value">{{ $stats['available'] }}</div><div class="stat-foot">Stok siap dipinjam</div></div>
  <div class="card stat" style="--tint:#cffafe"><div class="stat-label">{{ auth()->user()->role === 'admin' ? 'Peminjaman aktif' : 'Sedang dipinjam' }}</div><div class="stat-value">{{ $stats['loans'] }}</div><div class="stat-foot">{{ auth()->user()->role === 'admin' ? 'Menunggu / disetujui' : 'Peminjaman akunmu' }}</div></div>
  <div class="card stat" style="--tint:#fef3c7"><div class="stat-label">{{ auth()->user()->role === 'admin' ? 'Perlu persetujuan' : 'Pengajuan menunggu' }}</div><div class="stat-value">{{ $stats['pending'] }}</div><div class="stat-foot" style="color:#a56808">Tinjau permintaan</div></div>
</div>
<div class="card" style="margin-bottom:22px"><div class="section-title"><div><h2>Selamat datang, {{ auth()->user()->name }} 👋</h2><p>{{ auth()->user()->role === 'admin' ? 'Semua aktivitas inventaris dalam satu tampilan.' : 'Ringkasan inventaris dan aktivitas peminjaman akunmu.' }}</p></div><a class="btn" href="{{ route('peminjaman.create') }}">＋ Ajukan peminjaman</a></div>
  <div class="toolbar">
    <a class="btn secondary" href="{{ route('alat.index') }}">▦ {{ auth()->user()->role === 'admin' ? 'Kelola inventaris' : 'Lihat inventaris' }}</a>
    @if(auth()->user()->role==='admin')<a class="btn secondary" href="{{ route('pengguna.index') }}">♙ Kelola pengguna ({{ $userCount }})</a><a class="btn secondary" href="{{ route('pengembalian.index') }}">↩ Proses pengembalian</a>@endif
  </div>
</div>
<div class="card"><div class="section-title"><div><h2>{{ auth()->user()->role === 'admin' ? 'Peminjaman terbaru' : 'Peminjaman saya' }}</h2><p>{{ auth()->user()->role === 'admin' ? 'Aktivitas yang baru dicatat di sistem.' : 'Hanya transaksi dari akunmu yang ditampilkan.' }}</p></div><a class="btn secondary small" href="{{ route('peminjaman.index') }}">Lihat semua →</a></div>
<div class="table-wrap"><table><thead><tr>@if(auth()->user()->role==='admin')<th>PEMINJAM</th>@endif<th>ALAT</th><th>TANGGAL</th><th>STATUS</th><th></th></tr></thead><tbody>
@forelse($recentLoans as $loan)<tr>@if(auth()->user()->role==='admin')<td><div class="item-main">{{ $loan->user->name }}</div><div class="item-sub">{{ $loan->user->email }}</div></td>@endif<td>{{ $loan->items->map(fn($i)=>$i->equipment->name.' × '.$i->quantity)->join(', ') }}</td><td>{{ $loan->loan_date->format('d M Y') }}</td><td><span class="badge {{ $loan->status }}">{{ ucfirst($loan->status) }}</span></td><td><a class="btn secondary small" href="{{ route('peminjaman.show',$loan) }}">Detail</a></td></tr>
@empty<tr><td colspan="5"><div class="empty">Belum ada peminjaman. Buat pengajuan pertama untuk memulai.</div></td></tr>@endforelse
</tbody></table></div></div>
@endsection
