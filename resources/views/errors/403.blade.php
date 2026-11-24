@extends('layouts.app')
@section('title', '403 — Akses Ditolak')
@section('content')
<div style="min-height:100vh;display:flex;align-items:center;justify-content:center;text-align:center;padding:120px 20px 60px;background:var(--light-bg)">
    <div>
        <div style="font-size:3.5rem;color:#C62828;margin-bottom:12px"><i class="bi bi-shield-lock-fill"></i></div>
        <h1 style="font-size:5rem;font-weight:800;color:var(--primary);line-height:1">403</h1>
        <h3 style="font-weight:800;color:var(--primary);margin-bottom:10px">Akses Ditolak</h3>
        <p style="color:var(--text-soft);max-width:420px;margin:0 auto 26px">{{ $exception->getMessage() ?: 'Anda tidak memiliki izin untuk membuka halaman ini.' }}</p>
        <a href="{{ route('home') }}" class="btn-primary-custom"><i class="bi bi-house-fill"></i> Kembali ke Beranda</a>
    </div>
</div>
@endsection
