@extends('auth.layout')
@section('title', 'Daftar')
@section('heading')
    <h4 style="font-weight:800;color:var(--primary);margin:0 0 4px">Daftar Akun Tamu</h4>
    <p style="color:#90A4AE;font-size:.85rem;margin:0">Bergabung dan nikmati layanan wisata Samarinda</p>
@endsection
@section('card')
<form method="POST" action="{{ route('register.attempt') }}">
    @csrf
    <label class="form-label-x">Nama Lengkap</label>
    <div class="field"><i class="bi bi-person ic"></i><input class="form-input" name="name" value="{{ old('name') }}" required autofocus></div>
    <label class="form-label-x">Email</label>
    <div class="field"><i class="bi bi-envelope ic"></i><input class="form-input" type="email" name="email" value="{{ old('email') }}" required></div>
    <label class="form-label-x">Password</label>
    <div class="field"><i class="bi bi-lock ic"></i><input class="form-input" type="password" id="pw1" name="password" placeholder="Minimal 6 karakter" required style="padding-right:42px"><button type="button" class="eye" onclick="toggleEye('pw1', this)"><i class="bi bi-eye"></i></button></div>
    <label class="form-label-x">Konfirmasi Password</label>
    <div class="field" style="margin-bottom:22px"><i class="bi bi-lock-fill ic"></i><input class="form-input" type="password" name="password_confirmation" required></div>
    <button type="submit" class="btn-main"><i class="bi bi-person-check"></i> Daftar Sekarang</button>
</form>
<div class="sep"><span>sudah punya akun?</span></div>
<a href="{{ route('login') }}" class="btn-alt"><i class="bi bi-box-arrow-in-right"></i> Masuk</a>
@endsection
