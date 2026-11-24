@extends('layouts.app')
@section('title','Peta Wisata Samarinda')

@section('content')

<section class="page-banner">
    <div class="page-banner-bg" style="background-image:url('{{ asset('images/hero/hero-bg-1.jpg') }}')"></div>
    <div class="page-banner-overlay"></div>
    <div class="container page-banner-content">
        <div style="display:inline-flex;align-items:center;gap:10px;background:rgba(255,255,255,.12);backdrop-filter:blur(8px);border:1px solid rgba(255,255,255,.2);padding:6px 16px;border-radius:20px;margin-bottom:14px">
            <span><i class="bi bi-map text-white"></i></span>
            <span style="color:rgba(255,255,255,.85);font-size:.82rem;font-weight:600;text-transform:uppercase;letter-spacing:.08em">Navigasi Wisata</span>
        </div>
        <h1>Peta Wisata Samarinda</h1>
        <p style="color:rgba(255,255,255,.75);font-size:1rem;max-width:500px;margin:10px 0 16px">
            Temukan semua destinasi wisata Kota Samarinda dalam satu peta interaktif
        </p>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Peta Wisata</li>
            </ol>
        </nav>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row g-4">

            {{-- Filter Kategori --}}
            <div class="col-12" data-aos="fade-up">
                <div style="background:#fff;border-radius:12px;padding:16px 20px;box-shadow:var(--shadow);display:flex;gap:10px;flex-wrap:wrap;align-items:center">
                    <span style="font-weight:700;color:var(--primary);font-size:.88rem;margin-right:4px">Filter:</span>
                    @foreach([['Semua','#1565C0'],['Wisata Alam','#2E7D32'],['Wisata Religi','#F57C00'],['Wisata Budaya','#6A1B9A'],['Kuliner','#C62828'],['Wisata Air','#0277BD']] as $f)
                    <button onclick="filterMap('{{ $f[0] }}')"
                            style="padding:7px 16px;border-radius:20px;font-size:.82rem;font-weight:600;cursor:pointer;border:1.5px solid {{ $f[1] }};background:#fff;color:{{ $f[1] }};transition:.2s"
                            onmouseover="this.style.background='{{ $f[1] }}';this.style.color='#fff'"
                            onmouseout="this.style.background='#fff';this.style.color='{{ $f[1] }}'">
                        {{ $f[0] }}
                    </button>
                    @endforeach
                </div>
            </div>

            {{-- PETA --}}
            <div class="col-lg-8" data-aos="fade-right">
                <div style="border-radius:14px;overflow:hidden;box-shadow:var(--shadow);height:520px">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127838.96048321622!2d117.08837929999999!3d-0.5021787!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2df67f70f5b2a4ab%3A0x5a94a54c42437de5!2sSamarinda%2C%20East%20Kalimantan!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid"
                        width="100%" height="520" style="border:0" allowfullscreen loading="lazy">
                    </iframe>
                </div>
            </div>

            {{-- DAFTAR DESTINASI --}}
            <div class="col-lg-4" data-aos="fade-left">
                <div style="background:#fff;border-radius:14px;box-shadow:var(--shadow);overflow:hidden;height:520px;display:flex;flex-direction:column">
                    <div style="background:var(--primary);padding:16px 20px">
                        <h6 style="color:#fff;font-weight:700;margin:0"><i class="bi bi-geo-alt-fill me-2"></i>Destinasi Wisata</h6>
                    </div>
                    <div style="overflow-y:auto;flex:1;padding:12px">
                        @foreach([
                            ['bi-water','Tepian Mahakam','Pusat Kota','Wisata Alam','Gratis','tepian-mahakam'],
                            ['bi-building','Islamic Center','Sungai Kunjang','Wisata Religi','Gratis','islamic-center'],
                            ['bi-tree','Kebun Raya Unmul','Lempake','Wisata Alam','Rp 10.000','kebun-raya-unmul'],
                            ['bi-bank','Museum Mulawarman','Tenggarong','Wisata Budaya','Rp 5.000','museum-mulawarman'],
                            ['bi-cup-hot','Kampung Kuliner','Pasar Pagi','Kuliner','Mulai 15K','kampung-kuliner'],
                            ['bi-compass','Wisata Sungai Mahakam','Dermaga','Wisata Air','Rp 50.000','wisata-sungai-mahakam'],
                        ] as $d)
                        <a href="{{ route('destinasi.show',$d[5]) }}" style="text-decoration:none">
                            <div style="display:flex;gap:12px;padding:12px;border-radius:10px;margin-bottom:8px;border:1px solid var(--border);transition:.2s"
                                 onmouseover="this.style.background='var(--sky)';this.style.borderColor='var(--primary)'"
                                 onmouseout="this.style.background='#fff';this.style.borderColor='var(--border)'">
                                <div style="width:40px;height:40px;background:var(--sky);border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:1.1rem;flex-shrink:0;color:var(--primary)"><i class="bi {{ $d[0] }}"></i></div>
                                <div style="flex:1;min-width:0">
                                    <div style="font-weight:700;color:var(--primary);font-size:.88rem;margin-bottom:2px">{{ $d[1] }}</div>
                                    <div style="font-size:.75rem;color:var(--text-soft)">
                                        <i class="bi bi-geo-alt me-1"></i>{{ $d[2] }}
                                        &nbsp;•&nbsp;{{ $d[4] }}
                                    </div>
                                </div>
                                <i class="bi bi-chevron-right" style="color:var(--accent);font-size:.9rem;margin-top:10px"></i>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection
