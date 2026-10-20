@extends('layouts.app')
@section('title',$user->exists?'Edit Pengguna':'Tambah Pengguna')
@section('heading',$user->exists?'Edit Pengguna':'Tambah Pengguna')
@section('subtitle','Akun siswa dapat mengajukan peminjaman; admin mengelola semua data.')
@section('content')
<div class="card" style="max-width:850px"><form method="POST" action="{{ $user->exists?route('pengguna.update',$user):route('pengguna.store') }}">@csrf @if($user->exists)@method('PUT')@endif
<div class="form-grid"><div class="field"><label>Nama lengkap</label><input class="input" name="name" value="{{ old('name',$user->name) }}" required></div><div class="field"><label>Email</label><input class="input" type="email" name="email" value="{{ old('email',$user->email) }}" required></div><div class="field"><label>Role</label><select class="select" name="role"><option value="siswa" @selected(old('role',$user->role??'siswa')==='siswa')>Siswa</option><option value="admin" @selected(old('role',$user->role)==='admin')>Admin</option></select></div><div class="field"><label>Password {{ $user->exists?'(kosongkan jika tidak diubah)':'' }}</label><input class="input" type="password" name="password" {{ $user->exists?'':'required' }} minlength="8"></div><div class="field"><label>Konfirmasi password</label><input class="input" type="password" name="password_confirmation" {{ $user->exists?'':'required' }} minlength="8"></div></div>
<div class="form-actions"><a class="btn ghost" href="{{ route('pengguna.index') }}">Batal</a><button class="btn" type="submit">Simpan pengguna →</button></div></form></div>
@endsection
