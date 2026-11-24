@extends('layouts.app')
@section('title', $item->nama)
@section('meta', \Illuminate\Support\Str::limit($item->deskripsi, 150))

@section('content')
@include('partials.page-banner', [
    'title' => $item->nama, 'bgUrl' => media_url($item->gambar, 'destinasi'),
    'badge' => e($item->kategori),
    'extra' => '<div style="color:rgba(255,255,255,.85);font-size:.9rem;margin:4px 0 8px"><i class="bi bi-star-fill text-warning me-1"></i><strong>' . number_format($item->rating, 1) . '</strong> (' . number_format($item->ulasan) . ' ulasan) &nbsp;•&nbsp; <i class="bi bi-geo-alt"></i> ' . e(\Illuminate\Support\Str::limit($item->alamat, 60)) . '</div>',
    'crumbs' => [['Destinasi', route('destinasi.index')], [$item->nama]],
])

<section class="section-pad bg-soft">
<div class="container">
<div class="row g-5">
    <div class="col-lg-8">

        <div class="box">
            <div class="row g-3">
                @foreach([['bi-ticket-perforated','Harga Tiket',$item->harga],['bi-clock','Jam Buka',$item->jam],['bi-stopwatch','Estimasi Waktu',$item->durasi],['bi-star-fill','Rating',number_format($item->rating,1).' / 5']] as $r)
                    <div class="col-6 col-md-3"><div class="text-center" style="background:var(--light-bg);border-radius:12px;padding:16px 10px;height:100%">
                        <i class="bi {{ $r[0] }}" style="font-size:1.4rem;color:var(--primary)"></i>
                        <div class="info-label mt-1">{{ $r[1] }}</div>
                        <div style="font-weight:800;color:var(--primary);font-size:.85rem;line-height:1.3">{{ $r[2] }}</div>
                    </div></div>
                @endforeach
            </div>
        </div>

        <div class="box">
            <h4 class="box-title"><i class="bi bi-info-circle me-2"></i>Tentang Destinasi</h4>
            <p style="line-height:1.85;margin:0">{!! nl2br(e($item->deskripsi)) !!}</p>
        </div>

        @if(!empty($item->fasilitas))
            <div class="box">
                <h4 class="box-title"><i class="bi bi-check2-circle me-2"></i>Fasilitas</h4>
                <div class="row g-2">
                    @foreach($item->fasilitas as $f)
                        <div class="col-6 col-md-4"><div style="display:flex;align-items:center;gap:10px;padding:10px 14px;background:var(--light-bg);border:1px solid var(--border);border-radius:10px;font-size:.87rem;font-weight:500">
                            <i class="bi bi-check-circle-fill" style="color:var(--primary)"></i>{{ $f }}
                        </div></div>
                    @endforeach
                </div>
            </div>
        @endif

        @if($item->tips)
            <div style="background:linear-gradient(135deg,var(--primary),var(--primary-light));border-radius:var(--radius);padding:26px;margin-bottom:24px">
                <h4 style="color:#fff;font-weight:800;margin-bottom:10px"><i class="bi bi-lightbulb me-2"></i>Tips Berkunjung</h4>
                <p style="color:rgba(255,255,255,.92);line-height:1.75;margin:0">{{ $item->tips }}</p>
            </div>
        @endif

        <div class="box">
            <h4 class="box-title"><i class="bi bi-geo-alt me-2"></i>Lokasi & Alamat</h4>
            <p class="mb-3"><i class="bi bi-pin-map-fill me-2" style="color:var(--primary)"></i>{{ $item->alamat }}</p>
            <div style="border-radius:12px;overflow:hidden">
                <iframe src="{{ $item->mapsUrl() }}" width="100%" height="330" style="border:0" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <a class="btn-accent mt-3" target="_blank" rel="noopener" href="https://www.google.com/maps/search/?api=1&query={{ urlencode($item->nama . ' ' . $item->alamat) }}"><i class="bi bi-cursor-fill"></i> Buka di Google Maps</a>
        </div>

        @if(count($foto))
            <div class="box">
                <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                    <h4 class="box-title mb-0"><i class="bi bi-images me-2"></i>Foto Wisata {{ $item->nama }}</h4>
                    @if($item->galeri_slug && empty($item->foto_tambahan))
                        <a href="{{ route('galeri.album', $item->galeri_slug) }}" class="btn-accent" style="padding:7px 16px;font-size:.82rem">Lihat Semua Album <i class="bi bi-arrow-right"></i></a>
                    @else
                        <span class="badge" style="background:var(--light-bg);color:var(--primary);font-weight:700;padding:6px 12px;border-radius:20px;font-size:.8rem">{{ count($foto) }} Foto Tersedia</span>
                    @endif
                </div>
                <div class="row g-2">
                    @foreach($foto as $i => $f)
                        <div class="col-6 col-md-4">
                            <div class="gallery-card" onclick="openLb({{ $i }})">
                                <img src="{{ $f['url'] }}" alt="{{ $f['judul'] ?? $item->nama }}" loading="lazy" onerror="this.src='{{ asset('images/no-image.png') }}'">
                                <div class="gallery-card-overlay"><span><i class="bi bi-zoom-in me-1"></i> Perbesar</span></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    <div class="col-lg-4">
        <div class="box">
            <h5 class="box-title" style="font-size:.95rem">Bagikan</h5>
            <div class="d-flex gap-2 flex-wrap">
                @php $u = urlencode(url()->current()); $t = urlencode($item->nama); @endphp
                <a target="_blank" rel="noopener" href="https://www.facebook.com/sharer/sharer.php?u={{ $u }}" class="btn-accent" style="background:#1877F2"><i class="bi bi-facebook"></i></a>
                <a target="_blank" rel="noopener" href="https://twitter.com/intent/tweet?url={{ $u }}&text={{ $t }}" class="btn-accent" style="background:#111"><i class="bi bi-twitter-x"></i></a>
                <a target="_blank" rel="noopener" href="https://wa.me/?text={{ $t }}%20{{ $u }}" class="btn-accent" style="background:#25D366"><i class="bi bi-whatsapp"></i></a>
                <a target="_blank" rel="noopener" href="https://t.me/share/url?url={{ $u }}&text={{ $t }}" class="btn-accent" style="background:#26A5E4"><i class="bi bi-telegram"></i></a>
            </div>
        </div>
        <div class="box">
            <h5 class="box-title" style="font-size:.95rem">Destinasi Lainnya</h5>
            @foreach($lainnya as $l)
                <a href="{{ route('destinasi.show', $l->slug) }}" style="display:flex;gap:12px;padding-bottom:12px;margin-bottom:12px;border-bottom:1px solid var(--border)">
                    <img src="{{ media_url($l->gambar, 'destinasi') }}" alt="{{ $l->nama }}" style="width:64px;height:64px;object-fit:cover;border-radius:10px;flex-shrink:0">
                    <div>
                        <div style="font-weight:800;color:var(--primary);font-size:.88rem;line-height:1.3">{{ $l->nama }}</div>
                        <div style="font-size:.76rem;color:var(--text-soft)"><i class="bi bi-ticket-perforated"></i> {{ $l->harga }}</div>
                        <div style="font-size:.76rem;color:var(--text-soft)"><i class="bi bi-star-fill text-warning me-1"></i>{{ number_format($l->rating, 1) }}</div>
                    </div>
                </a>
            @endforeach
            <a href="{{ route('destinasi.index') }}" class="btn-accent w-100 mt-1">Semua Destinasi</a>
        </div>
        <div style="background:var(--primary);border-radius:var(--radius);padding:24px;text-align:center">
            <div style="font-size:2.2rem;color:#fff;margin-bottom:8px"><i class="bi bi-calculator"></i></div>
            <h6 style="color:#fff;font-weight:800">Rencanakan Perjalanan</h6>
            <p style="color:rgba(255,255,255,.75);font-size:.84rem">Hitung estimasi biaya atau susun itinerary wisata Anda.</p>
            <a href="{{ route('kalkulator.index') }}" class="btn-primary-custom" style="padding:9px 18px;font-size:.84rem">Kalkulator Biaya</a>
        </div>
    </div>
</div>
</div>
</section>

@if(count($foto))
<div class="lightbox" id="lb" onclick="if(event.target===this)closeLb()">
    <button class="lb-close" onclick="closeLb()" aria-label="Tutup"><i class="bi bi-x-lg"></i></button>
    <img id="lbImg" src="" alt="">
    <div class="d-flex gap-3 mt-3"><button class="lb-btn" onclick="stepLb(-1)">← Sebelumnya</button><button class="lb-btn" onclick="stepLb(1)">Berikutnya →</button></div>
</div>
@push('scripts')
<script>
var lbPhotos = @json(array_column($foto, 'url')), lbCur = 0, lb = document.getElementById('lb'), lbImg = document.getElementById('lbImg');
function openLb(i){ lbCur = i; lbImg.src = lbPhotos[i]; lb.classList.add('open'); document.body.style.overflow = 'hidden'; }
function closeLb(){ lb.classList.remove('open'); document.body.style.overflow = ''; }
function stepLb(d){ lbCur = (lbCur + d + lbPhotos.length) % lbPhotos.length; lbImg.src = lbPhotos[lbCur]; }
document.addEventListener('keydown', function(e){ if(!lb.classList.contains('open')) return; if(e.key==='Escape') closeLb(); if(e.key==='ArrowLeft') stepLb(-1); if(e.key==='ArrowRight') stepLb(1); });
</script>
@endpush
@endif
@endsection
