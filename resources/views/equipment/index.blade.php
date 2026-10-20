@extends('layouts.app')
@section('title','Data Alat')
@section('heading','Manajemen Alat')
@section('subtitle','Kelola inventaris, stok, kondisi, dan ketersediaan alat.')
@section('content')
<div class="card"><div class="section-title"><div><h2>Inventaris laboratorium</h2><p>{{ $equipment->total() }} jenis alat terdaftar</p></div>@if(auth()->user()->role==='admin')<a class="btn" href="{{ route('alat.create') }}">＋ Tambah alat</a>@endif</div>
<form class="toolbar" method="GET"><input class="input search" name="q" value="{{ request('q') }}" placeholder="Cari nama, kode, kategori..."><button class="btn secondary" type="submit">Cari</button><a class="btn ghost" href="{{ route('alat.index') }}">Reset</a></form>
<div class="table-wrap"><table><thead><tr><th>KODE / NAMA ALAT</th><th>KATEGORI</th><th>STOK</th><th>KONDISI</th><th>AKSI</th></tr></thead><tbody>
@forelse($equipment as $item)<tr><td><div class="item-main">{{ $item->name }}</div><div class="item-sub">{{ $item->code }}</div></td><td>{{ $item->category }}</td><td><strong>{{ $item->stock }}</strong> unit</td><td><span class="badge {{ $item->condition }}">{{ str_replace('_',' ',ucfirst($item->condition)) }}</span></td><td><div style="display:flex;gap:6px"><a class="btn secondary small" href="{{ route('alat.show',$item) }}">Detail</a>@if(auth()->user()->role==='admin')<a class="btn secondary small" href="{{ route('alat.edit',$item) }}">Edit</a><form method="POST" action="{{ route('alat.destroy',$item) }}" onsubmit="return confirm('Hapus alat ini?')">@csrf @method('DELETE')<button class="btn danger small" type="submit">Hapus</button></form>@endif</div></td></tr>
@empty<tr><td colspan="5"><div class="empty">Belum ada data alat. Tambahkan inventaris pertama.</div></td></tr>@endforelse
</tbody></table></div><div class="pagination">{{ $equipment->links() }}</div></div>
@endsection
