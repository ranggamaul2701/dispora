@extends('layouts.app')
@section('title', 'Album ' . $meta['nama'])

@section('content')
@include('partials.page-banner', [
    'title' => $meta['nama'], 'bgUrl' => $meta['cover'] ?? asset('images/hero/hero-bg-2.jpg'),
    'badge' => 'Album Galeri', 'sub' => $meta['desc'],
    'extra' => '<div style="color:rgba(255,255,255,.8);font-size:.88rem;margin-bottom:6px"><i class="bi bi-images"></i> ' . count($foto) . ' foto</div>',
    'crumbs' => [['Galeri', route('galeri.index')], [$meta['nama']]],
])

<section class="section-pad bg-soft">
    <div class="container">
        @if(count($foto) === 0)
            <div class="box text-center py-5">
                <div style="font-size:3rem;color:#90A4AE;margin-bottom:12px"><i class="bi bi-folder2-open"></i></div>
                <h5 style="color:var(--primary);font-weight:800">Album ini belum memiliki foto</h5>
                <p class="text-muted mb-0">Foto dapat ditambahkan oleh admin melalui dashboard.</p>
            </div>
        @else
            <div class="row g-3">
                @foreach($foto as $i => $f)
                    <div class="col-lg-4 col-md-6 col-6" data-aos="zoom-in" data-aos-delay="{{ ($i % 6) * 50 }}">
                        <div class="gallery-card" onclick="openLb({{ $i }})">
                            <img src="{{ $f['url'] }}" alt="{{ $f['judul'] }}" loading="lazy">
                            <span class="photo-no">{{ $i + 1 }}/{{ count($foto) }}</span>
                            <div class="gallery-card-overlay"><span><i class="bi bi-zoom-in"></i> {{ $f['judul'] }}</span></div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
        <div class="mt-4"><a href="{{ route('galeri.index') }}" class="btn-accent"><i class="bi bi-arrow-left"></i> Kembali ke Galeri</a></div>
    </div>
</section>

<section class="section-pad" style="padding-top:50px;padding-bottom:50px">
    <div class="container">
        <h5 style="font-weight:800;color:var(--primary);margin-bottom:18px"><i class="bi bi-collection me-2"></i>Album Lainnya</h5>
        <div class="row g-3">
            @foreach($lain as $slug => $o)
                <div class="col-lg-2 col-md-4 col-6">
                    <a href="{{ route('galeri.album', $slug) }}" class="gallery-card" style="aspect-ratio:1">
                        <img src="{{ $o['cover'] ?? media_url(null) }}" alt="{{ $o['nama'] }}" loading="lazy">
                        <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(13,71,161,.85),transparent 55%)"></div>
                        <div style="position:absolute;bottom:8px;left:0;right:0;text-align:center;z-index:2;color:#fff;font-size:.74rem;font-weight:700">{{ $o['nama'] }}</div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>

<div class="lightbox" id="lb" onclick="if(event.target===this)closeLb()">
    <button class="lb-close" onclick="closeLb()" aria-label="Tutup"><i class="bi bi-x-lg"></i></button>
    <div id="lbCount" style="position:absolute;top:24px;left:50%;transform:translateX(-50%);color:rgba(255,255,255,.75);font-size:.85rem;font-weight:600"></div>
    <img id="lbImg" src="" alt="">
    <p id="lbCap" style="color:#fff;font-weight:600;margin:14px 0 4px;text-align:center"></p>
    <div class="d-flex gap-3 mt-2"><button class="lb-btn" onclick="stepLb(-1)">← Sebelumnya</button><button class="lb-btn" onclick="stepLb(1)">Berikutnya →</button></div>
    <div style="position:absolute;bottom:18px;color:rgba(255,255,255,.4);font-size:.75rem">← → navigasi • ESC tutup</div>
</div>
@endsection

@push('scripts')
<script>
var photos = @json($foto), cur = 0, lb = document.getElementById('lb'), img = document.getElementById('lbImg');
function show(){ var p = photos[cur]; img.style.opacity = 0; setTimeout(function(){ img.src = p.url; img.alt = p.judul; img.style.opacity = 1; }, 120); document.getElementById('lbCap').textContent = p.judul; document.getElementById('lbCount').textContent = (cur + 1) + ' / ' + photos.length; }
function openLb(i){ cur = i; lb.classList.add('open'); document.body.style.overflow = 'hidden'; show(); }
function closeLb(){ lb.classList.remove('open'); document.body.style.overflow = ''; }
function stepLb(d){ cur = (cur + d + photos.length) % photos.length; show(); }
document.addEventListener('keydown', function(e){ if(!lb.classList.contains('open')) return; if(e.key==='Escape') closeLb(); if(e.key==='ArrowLeft') stepLb(-1); if(e.key==='ArrowRight') stepLb(1); });
</script>
@endpush
