@extends('layouts.app')
@section('title', '500 — Terjadi Kesalahan Server')
@section('content')
<div style="min-height:100vh;display:flex;align-items:center;justify-content:center;text-align:center;padding:120px 20px 60px;background:var(--light-bg)">
    <div>
        <div style="font-size:3.5rem;color:#E53935;margin-bottom:12px"><i class="bi bi-exclamation-triangle-fill"></i></div>
        <h1 style="font-size:5rem;font-weight:800;color:var(--primary);line-height:1">500</h1>
        <h3 style="font-weight:800;color:var(--primary);margin-bottom:10px">Terjadi Kendala pada Sistem</h3>
        <p style="color:var(--text-soft);max-width:440px;margin:0 auto 26px">Mohon maaf, sistem kami sedang mengalami kendala sementara. Silakan coba kembali beberapa saat lagi.</p>
        <a href="{{ route('home') }}" class="btn-primary-custom"><i class="bi bi-house-fill"></i> Kembali ke Beranda</a>
        <a href="{{ route('kontak.index') }}" class="btn-accent ms-2"><i class="bi bi-envelope-fill"></i> Hubungi Kami</a>
    </div>
</div>
@endsection
