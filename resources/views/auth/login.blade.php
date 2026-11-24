@extends('auth.layout')
@section('title', 'Login')
@section('heading')
    <h4 style="font-weight:800;color:var(--primary);margin:0 0 4px">Masuk ke Akun</h4>
    <p style="color:#90A4AE;font-size:.85rem;margin:0">Pariwisata Samarinda — Disporapar</p>
@endsection
@section('card')
<form method="POST" action="{{ route('login.attempt') }}">
    @csrf
    <label class="form-label-x">Email</label>
    <div class="field"><i class="bi bi-envelope ic"></i><input class="form-input" type="email" name="email" value="{{ old('email') }}" placeholder="email@example.com" required autofocus></div>
    <label class="form-label-x">Password</label>
    <div class="field"><i class="bi bi-lock ic"></i><input class="form-input" type="password" id="pw" name="password" placeholder="••••••••" required style="padding-right:42px"><button type="button" class="eye" onclick="toggleEye('pw', this)"><i class="bi bi-eye"></i></button></div>
    <label style="display:flex;align-items:center;gap:8px;font-size:.85rem;color:var(--text-soft);margin-bottom:20px;cursor:pointer"><input type="checkbox" name="remember" style="accent-color:var(--primary)"> Ingat saya</label>
    <button type="submit" class="btn-main"><i class="bi bi-box-arrow-in-right"></i> Masuk Sekarang</button>
</form>
<div style="margin-top:24px;padding-top:18px;border-top:1px solid #ECEFF1;text-align:center">
    <p style="font-size:.82rem;color:#78909C;margin-bottom:12px;line-height:1.5">
        <i class="bi bi-info-circle me-1"></i> Login dikhususkan untuk Administrator & Staf. Pengunjung umum dapat langsung menjelajahi informasi wisata tanpa perlu mendaftar.
    </p>
    <a href="{{ route('home') }}" class="btn-alt" style="justify-content:center;text-decoration:none">
        <i class="bi bi-arrow-left"></i> Kembali ke Beranda
    </a>
</div>
@endsection
