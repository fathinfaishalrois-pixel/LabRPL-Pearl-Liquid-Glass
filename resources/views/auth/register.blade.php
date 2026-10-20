@extends('layouts.app')
@section('title', 'Buat Akun')
@section('content')
<div class="login-page register-page">
  <section class="login-hero">
    <a class="brand" href="{{ route('home') }}"><span class="brandmark">L</span><span><strong>LabRPL</strong><small>LAB EQUIPMENT OS</small></span></a>
    <div class="hero-copy"><div class="eyebrow">MULAI SEKARANG</div><h1>Semua alat.<br>Satu kendali.</h1><p>Buat akun siswa untuk mengajukan peminjaman dan melihat aktivitas laboratorium dengan lebih mudah.</p></div>
    <div class="secure-note">● REGISTRASI PENGGUNA · ROLE SISWA OTOMATIS</div>
  </section>
  <section class="login-card-wrap"><div class="login-card">
    <div class="eyebrow">REGISTRASI PENGGUNA</div><h2>Buat akun LabRPL</h2><div class="sub">Isi data berikut untuk mulai menggunakan sistem.</div>
    @if($errors->any())<div class="alert error" role="alert">{{ $errors->first() }}</div>@endif
    <form method="POST" action="{{ route('register.submit') }}">
      @csrf
      <div class="field"><label for="name">NAMA LENGKAP</label><input class="input" id="name" name="name" type="text" autocomplete="name" value="{{ old('name') }}" placeholder="Masukkan nama lengkap" maxlength="120" required autofocus></div>
      <div class="field"><label for="email">USERNAME / EMAIL</label><input class="input" id="email" name="email" type="text" inputmode="email" autocomplete="email" value="{{ old('email') }}" placeholder="contoh: nama123" required><small class="hint">Bisa isi <strong>nama123</strong> atau <strong>nama123@gmail.com</strong>.</small></div>
      <div class="field"><label for="password">PASSWORD</label><input class="input" id="password" name="password" type="password" autocomplete="new-password" placeholder="Minimal 8 karakter" minlength="8" required></div>
      <div class="field"><label for="password_confirmation">KONFIRMASI PASSWORD</label><input class="input" id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" placeholder="Ulangi password" minlength="8" required></div>
      <button class="btn" type="submit">Buat akun siswa <span aria-hidden="true">→</span></button>
      <p class="hint role-note">Akun baru otomatis dibuat sebagai siswa. Hak akses admin tidak tersedia pada formulir registrasi.</p>
    </form>
    <div class="auth-switch">Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a></div>
  </div></section>
</div>
@endsection
