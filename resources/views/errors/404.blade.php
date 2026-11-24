@extends('layouts.app')
@section('title', '404 — Halaman Tidak Ditemukan')
@section('content')
<div style="min-height:100vh;display:flex;align-items:center;justify-content:center;text-align:center;padding:120px 20px 60px;background:var(--light-bg)">
    <div>
        <div style="font-size:3.5rem;color:var(--primary);margin-bottom:12px"><i class="bi bi-compass"></i></div>
        <h1 style="font-size:5rem;font-weight:800;color:var(--primary);line-height:1">404</h1>
        <h3 style="font-weight:800;color:var(--primary);margin-bottom:10px">Halaman Tidak Ditemukan</h3>
        <p style="color:var(--text-soft);max-width:420px;margin:0 auto 26px">Halaman yang Anda cari tidak tersedia atau sudah dipindahkan.</p>
        <a href="{{ route('home') }}" class="btn-primary-custom"><i class="bi bi-house-fill"></i> Kembali ke Beranda</a>
        <a href="{{ route('search') }}" class="btn-accent ms-2"><i class="bi bi-search"></i> Cari Konten</a>
    </div>
</div>
@endsection
