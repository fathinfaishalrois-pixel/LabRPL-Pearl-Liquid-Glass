@extends('layouts.app')
@section('title','Detail Pengguna')
@section('heading',$user->name)
@section('content')
<div class="card"><p>Email: {{ $user->email }}</p><p>Role: {{ ucfirst($user->role) }}</p><a class="btn secondary" href="{{ route('pengguna.index') }}">Kembali</a></div>
@endsection
