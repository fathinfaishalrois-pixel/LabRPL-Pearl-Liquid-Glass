@extends('layouts.app')
@section('title','Pengguna')
@section('heading','Manajemen Pengguna')
@section('subtitle','Atur akun admin dan siswa yang menggunakan sistem LabRPL.')
@section('content')
<div class="card"><div class="section-title"><div><h2>Daftar pengguna</h2><p>{{ $users->total() }} akun terdaftar</p></div><a class="btn" href="{{ route('pengguna.create') }}">＋ Tambah pengguna</a></div>
<div class="table-wrap"><table><thead><tr><th>NAMA</th><th>EMAIL</th><th>ROLE</th><th>TERDAFTAR</th><th>AKSI</th></tr></thead><tbody>
@forelse($users as $user)<tr><td><div class="item-main">{{ $user->name }}</div></td><td>{{ $user->email }}</td><td><span class="badge {{ $user->role==='admin'?'disetujui':'' }}">{{ ucfirst($user->role) }}</span></td><td>{{ $user->created_at->format('d M Y') }}</td><td><div style="display:flex;gap:6px"><a class="btn secondary small" href="{{ route('pengguna.edit',$user) }}">Edit</a><form method="POST" action="{{ route('pengguna.destroy',$user) }}" onsubmit="return confirm('Hapus akun ini?')">@csrf @method('DELETE')<button class="btn danger small" type="submit">Hapus</button></form></div></td></tr>
@empty<tr><td colspan="5"><div class="empty">Belum ada pengguna.</div></td></tr>@endforelse
</tbody></table></div><div class="pagination">{{ $users->links() }}</div></div>
@endsection
