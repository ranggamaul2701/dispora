@extends('layouts.app')
@section('title', 'Beranda')

@section('content')

{{-- HERO --}}
<section class="hero-section">
    <div class="hero-slides">
        @foreach(['hero-bg-1.jpg','hero-bg-2.jpg','hero-bg-3.jpg'] as $i => $h)
            <div class="hero-slide {{ $i === 0 ? 'active' : '' }}" style="background-image:url('{{ asset('images/hero/'.$h) }}')"></div>
        @endforeach
    </div>
    <div class="hero-overlay"></div>
    <div class="container" style="position:relative;z-index:2">
        <div class="row align-items-center">
            <div class="col-lg-6 hero-content" data-aos="fade-right">
                <div class="hero-badge"> Website Resmi Pariwisata Samarinda</div>
                <h1 class="hero-title">Jelajahi Pesona<br><span>Wisata Kota</span><br>Samarinda</h1>
                <p class="hero-desc">Temukan keindahan Tepian Mahakam, kekayaan budaya Kutai, kuliner khas, dan destinasi wisata unggulan Kota Samarinda.</p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('destinasi.index') }}" class="btn-primary-custom"><i class="bi bi-compass-fill"></i> Jelajahi Destinasi</a>
                    <a href="{{ route('agenda.index') }}" class="btn-outline-custom"><i class="bi bi-calendar-event"></i> Lihat Event</a>
                </div>
                <div class="hero-stats">
                    <div class="hero-stat-item"><span class="number">80+</span><span class="label">Destinasi Wisata</span></div>
                    <div class="hero-stat-item"><span class="number">150+</span><span class="label">Event / Tahun</span></div>
                    <div class="hero-stat-item"><span class="number">40+</span><span class="label">Pelaku Ekraf</span></div>
                    <div class="hero-stat-item"><span class="number">25+</span><span class="label">Kuliner Khas</span></div>
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-block hero-foto" data-aos="fade-left" data-aos-delay="150">
                <img src="{{ asset('images/hero/foto-kanan.jpg') }}" alt="Pariwisata Samarinda">
            </div>
        </div>
    </div>
    <div class="hero-dots">
        @foreach([0,1,2] as $d)<button type="button" class="hero-dot {{ $d === 0 ? 'active' : '' }}" data-slide="{{ $d }}" aria-label="Slide {{ $d + 1 }}"></button>@endforeach
    </div>
</section>

{{-- TENTANG --}}
<section class="section-pad">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-5" data-aos="fade-right">
                <div class="tentang-img-wrap">
                    <img src="{{ asset('images/tentang/gedung-dinas.jpg') }}" alt="Gedung Disporapar Samarinda">
                    <div class="tentang-badge"><span class="num">25+</span><span class="txt">Tahun<br>Melayani</span></div>
                </div>
            </div>
            <div class="col-lg-7" data-aos="fade-left">
                <div class="section-eyebrow">Tentang Kami</div>
                <h2 class="section-title">Mengembangkan Pariwisata<br>Samarinda yang Berdaya Saing</h2>
                <p class="text-muted mb-4">Bidang Pengembangan Pariwisata Disporapar Kota Samarinda bertugas merencanakan, mengembangkan, dan mempromosikan destinasi wisata agar mampu bersaing di tingkat nasional maupun internasional.</p>
                <div class="point"><div class="point-icon"><i class="bi bi-map-fill"></i></div><div><h6>Pengembangan Destinasi</h6><p>Identifikasi dan pengembangan potensi destinasi wisata baru di Kota Samarinda.</p></div></div>
                <div class="point"><div class="point-icon"><i class="bi bi-megaphone-fill"></i></div><div><h6>Promosi & Pemasaran</h6><p>Promosi wisata melalui media digital, pameran, dan festival pariwisata.</p></div></div>
                <div class="point"><div class="point-icon"><i class="bi bi-palette-fill"></i></div><div><h6>Ekonomi Kreatif</h6><p>Pembinaan pelaku UMKM dan industri kreatif berbasis budaya lokal.</p></div></div>
                <a href="{{ route('about') }}" class="btn-accent mt-2">Selengkapnya <i class="bi bi-arrow-right"></i></a>
            </div>
        </div>
    </div>
</section>

{{-- DESTINASI --}}
<section class="section-pad bg-soft">
    <div class="container">
        <div class="section-title-wrap" data-aos="fade-up">
            <div class="section-eyebrow">Jelajahi</div>
            <h2 class="section-title">Destinasi Unggulan Samarinda</h2>
            <div class="section-divider"></div>
            <p class="section-desc mt-3">Temukan keberagaman destinasi wisata yang siap memukau setiap pengunjung.</p>
        </div>
        <div class="row g-4">
            @forelse($destinasi as $i => $d)
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ ($i % 3) * 80 }}">
                    @include('partials.card-destinasi', ['d' => $d])
                </div>
            @empty
                <div class="col-12 text-center text-muted py-5">Belum ada destinasi.</div>
            @endforelse
        </div>
        <div class="text-center mt-5"><a href="{{ route('destinasi.index') }}" class="btn-accent"><i class="bi bi-grid-3x3-gap"></i> Semua Destinasi</a></div>
    </div>
</section>

{{-- BERITA --}}
<section class="section-pad">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-5 flex-wrap gap-3" data-aos="fade-up">
            <div><div class="section-eyebrow">Informasi</div><h2 class="section-title mb-0">Berita Pariwisata</h2></div>
            <a href="{{ route('berita.index') }}" class="btn-accent">Semua Berita <i class="bi bi-arrow-right"></i></a>
        </div>
        <div class="row g-4">
            @forelse($berita as $i => $b)
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $i * 90 }}">
                    @include('partials.card-berita', ['b' => $b])
                </div>
            @empty
                <div class="col-12 text-center text-muted py-5">Belum ada berita.</div>
            @endforelse
        </div>
    </div>
</section>

{{-- GALERI --}}
<section class="section-pad bg-soft">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-4 flex-wrap gap-3" data-aos="fade-up">
            <div><div class="section-eyebrow">Dokumentasi</div><h2 class="section-title mb-0">Galeri Wisata Samarinda</h2></div>
            <a href="{{ route('galeri.index') }}" class="btn-accent">Lihat Semua <i class="bi bi-arrow-right"></i></a>
        </div>
        <div class="row g-3">
            @forelse($galeri as $i => $g)
                <div class="col-lg-3 col-md-4 col-6" data-aos="zoom-in" data-aos-delay="{{ $i * 50 }}">
                    <a class="gallery-card" href="{{ route('galeri.album', $g['album']) }}">
                        <img src="{{ $g['url'] }}" alt="{{ $g['label'] }}" loading="lazy">
                        <div class="gallery-card-overlay"><span>{{ $g['label'] }}</span></div>
                    </a>
                </div>
            @empty
                <div class="col-12 text-center text-muted py-5">Belum ada foto galeri.</div>
            @endforelse
        </div>
    </div>
</section>

{{-- AGENDA --}}
<section class="section-pad">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-5" data-aos="fade-right">
                <div class="section-eyebrow">Kalender Wisata</div>
                <h2 class="section-title">Event & Festival<br>Pariwisata</h2>
                <div class="section-divider" style="margin:14px 0 20px"></div>
                <p class="text-muted">Jangan lewatkan berbagai event dan festival pariwisata Kota Samarinda yang akan datang.</p>
                <a href="{{ route('agenda.index') }}" class="btn-accent mt-2">Lihat Semua Event <i class="bi bi-arrow-right"></i></a>
                <a href="{{ route('kalender.index') }}" class="btn-accent mt-2" style="background:var(--accent);color:var(--primary-dark)"><i class="bi bi-calendar2-check"></i> Kalender</a>
            </div>
            <div class="col-lg-7" data-aos="fade-left">
                @forelse($agenda as $ev)
                    <a href="{{ route('agenda.show', $ev->id) }}" class="event-card">
                        <div class="event-date-box"><span class="day">{{ $ev->tanggal_mulai->format('d') }}</span><span class="month">{{ $ev->tanggal_mulai->translatedFormat('M') }}</span></div>
                        <div class="event-info">
                            <h6>{{ $ev->nama }}</h6>
                            <div class="event-meta"><i class="bi bi-geo-alt me-1"></i>{{ $ev->lokasi }}</div>
                        </div>
                    </a>
                @empty
                    <div class="box text-center text-muted">Belum ada agenda mendatang.</div>
                @endforelse
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
(function () {
    var slides = document.querySelectorAll('.hero-slide'), dots = document.querySelectorAll('.hero-dot'), cur = 0, timer;
    function go(n) {
        slides[cur].classList.remove('active'); dots[cur].classList.remove('active');
        cur = n; slides[cur].classList.add('active'); dots[cur].classList.add('active');
    }
    function start() { timer = setInterval(function () { go((cur + 1) % slides.length); }, 5500); }
    dots.forEach(function (d) { d.addEventListener('click', function () { clearInterval(timer); go(+d.dataset.slide); start(); }); });
    if (slides.length) start();
})();
</script>
@endpush
