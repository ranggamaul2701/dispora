@extends('layouts.app')
@section('title', $berita->judul)
@section('meta', \Illuminate\Support\Str::limit($berita->ringkasan, 150))

@section('content')
@include('partials.page-banner', [
    'title' => $berita->judul, 'bgUrl' => media_url($berita->gambar, 'berita'),
    'badge' => e($berita->icon . ' ' . $berita->kategori),
    'crumbs' => [['Berita', route('berita.index')], ['Detail']],
])

<section class="section-pad bg-soft">
<div class="container">
<div class="row g-5">
    <div class="col-lg-8">
        <div class="box">
            <img src="{{ media_url($berita->gambar, 'berita') }}" alt="{{ $berita->judul }}" style="width:100%;max-height:420px;object-fit:cover;border-radius:12px;margin-bottom:22px">
            <div class="meta-line" style="padding-bottom:16px;margin-bottom:20px;border-bottom:1px solid var(--border)">
                <span><i class="bi bi-calendar3"></i> {{ $berita->created_at->translatedFormat('d F Y') }}</span>
                <span><i class="bi bi-eye"></i> {{ number_format($berita->views) }} kali dibaca</span>
                <span><i class="bi bi-person"></i> Tim Pariwisata Samarinda</span>
            </div>
            <p style="font-weight:600;color:var(--text-soft);font-size:1.02rem">{{ $berita->ringkasan }}</p>
            <div style="line-height:1.9;font-size:.98rem">{!! $berita->konten !!}</div>
            <hr>
            <div class="d-flex align-items-center gap-2 flex-wrap">
                <strong style="color:var(--primary)">Bagikan:</strong>
                @php $u = urlencode(url()->current()); $t = urlencode($berita->judul); @endphp
                <a target="_blank" rel="noopener" href="https://www.facebook.com/sharer/sharer.php?u={{ $u }}" class="btn-accent" style="background:#1877F2;padding:7px 14px"><i class="bi bi-facebook"></i></a>
                <a target="_blank" rel="noopener" href="https://twitter.com/intent/tweet?url={{ $u }}&text={{ $t }}" class="btn-accent" style="background:#111;padding:7px 14px"><i class="bi bi-twitter-x"></i></a>
                <a target="_blank" rel="noopener" href="https://wa.me/?text={{ $t }}%20{{ $u }}" class="btn-accent" style="background:#25D366;padding:7px 14px"><i class="bi bi-whatsapp"></i></a>
            </div>
        </div>
        <a href="{{ route('berita.index') }}" class="btn-accent"><i class="bi bi-arrow-left"></i> Kembali ke Berita</a>
    </div>
    <div class="col-lg-4">
        <div class="box">
            <h5 class="box-title" style="font-size:.95rem">Berita Lainnya</h5>
            @foreach($lainnya as $l)
                <a href="{{ route('berita.show', $l->slug) }}" style="display:flex;gap:12px;padding-bottom:12px;margin-bottom:12px;border-bottom:1px solid var(--border)">
                    <img src="{{ media_url($l->gambar, 'berita') }}" alt="" style="width:64px;height:64px;object-fit:cover;border-radius:10px;flex-shrink:0">
                    <div><div style="font-weight:700;color:var(--primary);font-size:.86rem;line-height:1.35">{{ \Illuminate\Support\Str::limit($l->judul, 60) }}</div><div style="font-size:.74rem;color:var(--text-soft)">{{ $l->created_at->translatedFormat('d M Y') }}</div></div>
                </a>
            @endforeach
        </div>
        <div class="box">
            <h5 class="box-title" style="font-size:.95rem">Kategori</h5>
            @foreach(config('pariwisata.kategori_berita') as $kat)
                <a href="{{ route('berita.index', ['kategori' => $kat]) }}" style="display:flex;justify-content:space-between;padding:9px 0;border-bottom:1px solid var(--border);color:var(--text-main);font-size:.88rem">{{ $kat }}<i class="bi bi-arrow-right" style="color:var(--accent-dark)"></i></a>
            @endforeach
        </div>
    </div>
</div>
</div>
</section>
@endsection
