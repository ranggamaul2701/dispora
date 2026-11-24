@extends('layouts.app')
@section('title', 'Galeri Wisata')

@section('content')
@include('partials.page-banner', [
    'title' => 'Galeri Wisata Samarinda', 'bg' => 'hero-bg-3.jpg',
    'badge' => 'Dokumentasi Visual', 'sub' => 'Abadikan keindahan destinasi, budaya, kuliner, dan festival Kota Samarinda.',
    'crumbs' => [['Galeri']],
])

<div style="background:var(--primary);padding:18px 0"><div class="container"><div class="row g-3 text-center">
    @foreach([[count($albums),'Album Foto'],[$total,'Total Foto'],['2026','Tahun Dokumentasi']] as $s)
        <div class="col-4"><div style="font-size:1.6rem;font-weight:800;color:var(--accent);line-height:1">{{ $s[0] }}</div><div style="font-size:.78rem;color:rgba(255,255,255,.75)">{{ $s[1] }}</div></div>
    @endforeach
</div></div></div>

<section class="section-pad bg-soft">
    <div class="container">
        <div class="section-title-wrap" data-aos="fade-up"><div class="section-eyebrow">Koleksi Foto</div><h2 class="section-title">Album Foto Destinasi Wisata</h2><div class="section-divider"></div></div>
        <div class="row g-4">
            @foreach($albums as $i => $a)
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ ($i % 3) * 80 }}">
                    <a href="{{ route('galeri.album', $a['slug']) }}" class="dest-card" style="color:inherit">
                        <div class="dest-card-thumb" style="height:230px">
                            <img src="{{ $a['cover'] ?? media_url(null) }}" alt="{{ $a['nama'] }}" loading="lazy">
                            <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(13,71,161,.65),transparent 55%)"></div>
                            <span class="dest-badge">{{ $a['jumlah'] }} foto</span>
                            <div style="position:absolute;bottom:14px;left:16px;color:#fff;font-weight:800;font-size:1.1rem;z-index:2;text-shadow:0 2px 8px rgba(0,0,0,.4)">@if(str_starts_with($a['icon'] ?? '', 'bi-'))<i class="bi {{ $a['icon'] }} me-1"></i>@endif{{ $a['nama'] }}</div>
                        </div>
                        <div class="card-body-x">
                            <p>{{ $a['desc'] }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="meta-line mb-0"><span><i class="bi bi-images"></i> {{ $a['jumlah'] }} foto</span></span>
                                <span style="color:var(--primary);font-weight:700;font-size:.85rem">Lihat Album <i class="bi bi-arrow-right"></i></span>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section style="background:linear-gradient(135deg,var(--primary-dark),var(--primary));padding:56px 0;text-align:center">
    <div class="container" data-aos="fade-up">
        <div style="font-size:2.4rem;color:#fff;margin-bottom:10px"><i class="bi bi-camera-fill"></i></div>
        <h3 style="color:#fff;font-weight:800">Punya Foto Wisata Samarinda?</h3>
        <p style="color:rgba(255,255,255,.78);max-width:480px;margin:0 auto 22px">Bagikan momen indah Anda di destinasi wisata Samarinda. Hubungi kami untuk mengirim foto terbaik Anda.</p>
        <a href="{{ route('kontak.index') }}" class="btn-primary-custom"><i class="bi bi-send-fill"></i> Kirim Foto Anda</a>
    </div>
</section>
@endsection
