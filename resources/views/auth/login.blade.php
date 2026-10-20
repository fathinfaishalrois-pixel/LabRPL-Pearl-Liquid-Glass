@extends('layouts.app')
@section('title', 'Login')
@section('content')
<div class="login-page">
  <section class="login-hero">
    <a class="brand" href="{{ route('home') }}"><span class="brandmark">L</span><span><strong>LabRPL</strong><small>SMART LABORATORY</small></span></a>
    <div class="hero-copy"><div class="eyebrow">SMART LABORATORY · RPL</div><h1>Inventaris rapi.<br>Aktivitas terkendali.</h1><p>Satu ruang digital untuk mengelola alat, mengajukan peminjaman, dan menjaga setiap inventaris laboratorium tetap terlacak.</p></div>
    <div class="secure-note">● SECURE ACCESS · ROLE-BASED PERMISSIONS</div>
  </section>
  <section class="login-card-wrap"><div class="login-card glass">
    <div class="eyebrow">SELAMAT DATANG KEMBALI</div><h2>Masuk ke LabRPL</h2><div class="sub">Gunakan email akunmu. Sistem otomatis memberikan akses sesuai peran akun.</div>
    @if($errors->any())<div class="alert error" role="alert">{{ $errors->first() }}</div>@endif
    @if(session('success'))<div class="alert success" role="status">{{ session('success') }}</div>@endif
    <form method="POST" action="{{ route('login.submit') }}">
      @csrf
      <div class="field"><label for="email">USERNAME / EMAIL</label><input class="input" id="email" name="email" type="text" inputmode="email" autocomplete="username" value="{{ old('email') }}" placeholder="contoh: nama123 atau email@domain.com" required autofocus><small class="hint">Jika tanpa domain, sistem menambahkan <strong>@gmail.com</strong>.</small></div>
      <div class="field"><label for="password">PASSWORD</label><input class="input" id="password" name="password" type="password" autocomplete="current-password" placeholder="Masukkan password" required></div>
      <div class="checkline"><label><input type="checkbox" name="remember" value="1"> Ingat saya</label><span>Akses aman sesuai role</span></div>
      <button class="btn" type="submit">Masuk ke dashboard <span aria-hidden="true">→</span></button>
    </form><div class="auth-switch">Belum punya akun? <a href="{{ route('register') }}">Buat akun siswa</a></div>
  </div></section>
</div>
@endsection
