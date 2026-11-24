@extends('layouts.app')

@section('title', $destinasi->nama . ' - Destinasi Wisata Samarinda')

@section('content')

<section class="detail-banner">
    <div class="container">
        <div class="detail-banner-content">

            <div class="breadcrumb-custom">
                <a href="{{ route('home') }}">Beranda</a>
                <span>/</span>
                <a href="{{ route('destinasi.index') }}">Destinasi</a>
                <span>/</span>
                <span>{{ $destinasi->nama }}</span>
            </div>

            <h1>{{ $destinasi->nama }}</h1>

        </div>
    </div>
</section>


<section class="destinasi-detail py-5">

    <div class="container">

        <div class="row g-5">

            {{-- FOTO --}}
            <div class="col-lg-7">

                <div class="detail-image">

                    @if($destinasi->foto)

                        @if(\Illuminate\Support\Str::startsWith($destinasi->foto, ['http://', 'https://']))

                            <img
                                src="{{ $destinasi->foto }}"
                                alt="{{ $destinasi->nama }}"
                            >

                        @else

                            <img
                                src="{{ asset('storage/' . $destinasi->foto) }}"
                                alt="{{ $destinasi->nama }}"
                                onerror="this.onerror=null;this.src='{{ asset('images/no-image.png') }}';"
                            >

                        @endif

                    @else

                        <img
                            src="{{ asset('images/no-image.png') }}"
                            alt="{{ $destinasi->nama }}"
                        >

                    @endif

                </div>

            </div>


            {{-- INFORMASI --}}
            <div class="col-lg-5">

                <div class="detail-content">

                    <span class="detail-category">
                        {{ strtoupper($destinasi->kategori) }}
                    </span>

                    <h2>
                        {{ $destinasi->nama }}
                    </h2>


                    {{-- RATING --}}
                    <div class="detail-rating">

                        <span class="star"><i class="bi bi-star-fill text-warning"></i></span>

                        <strong>
                            {{ number_format((float) $destinasi->rating, 1) }}
                        </strong>

                        @if($destinasi->ulasan > 0)
                            <span>
                                ({{ $destinasi->ulasan }} ulasan)
                            </span>
                        @endif

                    </div>


                    {{-- DESKRIPSI --}}
                    <p class="detail-description">
                        {{ $destinasi->deskripsi }}
                    </p>


                    {{-- INFORMASI --}}
                    <div class="detail-info-list">

                        @if($destinasi->alamat)

                            <div class="detail-info-item">

                                <div class="info-icon">
                                    <i class="bi bi-geo-alt"></i>
                                </div>

                                <div>
                                    <small>Alamat</small>

                                    <p>
                                        {{ $destinasi->alamat }}
                                    </p>
                                </div>

                            </div>

                        @endif


                        @if($destinasi->harga)

                            <div class="detail-info-item">

                                <div class="info-icon">
                                    <i class="bi bi-ticket-perforated"></i>
                                </div>

                                <div>
                                    <small>Harga</small>

                                    <p>
                                        {{ $destinasi->harga }}
                                    </p>
                                </div>

                            </div>

                        @endif


                        @if($destinasi->jam)

                            <div class="detail-info-item">

                                <div class="info-icon">
                                    <i class="bi bi-clock"></i>
                                </div>

                                <div>
                                    <small>Jam Operasional</small>

                                    <p>
                                        {{ $destinasi->jam }}
                                    </p>
                                </div>

                            </div>

                        @endif


                        @if($destinasi->durasi)

                            <div class="detail-info-item">

                                <div class="info-icon">
                                    <i class="bi bi-stopwatch"></i>
                                </div>

                                <div>
                                    <small>Durasi Kunjungan</small>

                                    <p>
                                        {{ $destinasi->durasi }}
                                    </p>
                                </div>

                            </div>

                        @endif

                    </div>


                    {{-- GOOGLE MAPS --}}
                    @if($destinasi->maps)

                        <a
                            href="{{ $destinasi->maps }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="maps-button"
                        >
                            <i class="bi bi-geo-alt-fill me-1"></i> Lihat Lokasi di Google Maps
                        </a>

                    @endif

                </div>

            </div>

        </div>


        {{-- FASILITAS DAN TIPS --}}
        <div class="row g-4 mt-4">

            @if($destinasi->fasilitas)

                <div class="col-lg-6">

                    <div class="detail-box">

                        <h3>Fasilitas</h3>

                        <div class="facility-list">

                            @foreach($destinasi->fasilitas as $fasilitas)

                                <div class="facility-item">

                                    <span class="facility-check">
                                        <i class="bi bi-check-lg"></i>
                                    </span>

                                    <span>
                                        {{ $fasilitas }}
                                    </span>

                                </div>

                            @endforeach

                        </div>

                    </div>

                </div>

            @endif


            @if($destinasi->tips)

                <div class="col-lg-6">

                    <div class="detail-box">

                        <h3>Tips Berkunjung</h3>

                        <p class="tips-text">
                            {{ $destinasi->tips }}
                        </p>

                    </div>

                </div>

            @endif

        </div>


        {{-- KEMBALI --}}
        <div class="mt-5">

            <a
                href="{{ route('destinasi.index') }}"
                class="back-button"
            >
                ← Kembali ke Destinasi
            </a>

        </div>

    </div>

</section>


<style>

.detail-banner {
    min-height: 270px;
    display: flex;
    align-items: center;

    background:
        linear-gradient(
            rgba(9, 91, 52, .82),
            rgba(9, 91, 52, .82)
        ),
        url('{{ asset('images/hero-bg-1.jpg') }}');

    background-size: cover;
    background-position: center;
}

.detail-banner-content {
    padding: 55px 0;
}

.detail-banner h1 {
    color: #fff;
    font-size: 42px;
    font-weight: 800;
    margin-top: 20px;
}

.breadcrumb-custom {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 10px;
    font-size: 14px;
}

.breadcrumb-custom a {
    color: #fff;
    text-decoration: none;
}

.breadcrumb-custom a:hover {
    color: #fbbd19;
}

.breadcrumb-custom span {
    color: rgba(255,255,255,.7);
}

.breadcrumb-custom span:last-child {
    color: #fbbd19;
    font-weight: 600;
}


.detail-image {
    width: 100%;
    height: 480px;
    overflow: hidden;
    border-radius: 22px;
    background: #edf3ef;

    box-shadow:
        0 15px 40px rgba(0,0,0,.08);
}

.detail-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}


.detail-content {
    padding: 10px 0;
}

.detail-category {
    display: inline-block;

    padding: 7px 14px;

    border-radius: 20px;

    background: #fbbd19;

    color: #17452f;

    font-size: 12px;
    font-weight: 800;

    margin-bottom: 15px;
}

.detail-content h2 {
    color: #126b45;

    font-size: 36px;
    line-height: 1.2;

    font-weight: 800;

    margin-bottom: 12px;
}


.detail-rating {
    display: flex;
    align-items: center;

    gap: 6px;

    margin-bottom: 20px;

    color: #708578;
}

.detail-rating .star {
    color: #f5b914;
    font-size: 20px;
}

.detail-rating strong {
    color: #222;
    font-size: 18px;
}


.detail-description {
    color: #66786d;

    font-size: 16px;
    line-height: 1.8;

    margin-bottom: 25px;
}


.detail-info-list {
    border-top: 1px solid #e7eee9;
    margin-top: 20px;
}

.detail-info-item {
    display: flex;
    gap: 15px;

    padding: 15px 0;

    border-bottom: 1px solid #e7eee9;
}

.info-icon {
    width: 42px;
    height: 42px;
    min-width: 42px;

    display: flex;
    align-items: center;
    justify-content: center;

    background: #edf7f1;

    border-radius: 12px;

    font-size: 19px;
}

.detail-info-item small {
    display: block;

    color: #8a998f;

    font-size: 12px;

    margin-bottom: 3px;
}

.detail-info-item p {
    margin: 0;

    color: #30483b;

    font-size: 14px;

    font-weight: 600;

    line-height: 1.5;
}


.maps-button {
    display: inline-flex;

    align-items: center;
    justify-content: center;

    width: 100%;

    margin-top: 25px;

    padding: 13px 18px;

    border-radius: 10px;

    background: #126b45;

    color: #fff;

    text-decoration: none;

    font-weight: 700;

    font-size: 14px;

    transition: .25s ease;
}

.maps-button:hover {
    background: #0d5738;
    color: #fff;

    transform: translateY(-2px);
}


.detail-box {
    height: 100%;

    padding: 28px;

    border-radius: 18px;

    background: #f7faf8;

    border: 1px solid #e5eee8;
}

.detail-box h3 {
    color: #126b45;

    font-size: 21px;

    font-weight: 750;

    margin-bottom: 20px;
}


.facility-list {
    display: grid;

    grid-template-columns: repeat(2, 1fr);

    gap: 12px;
}

.facility-item {
    display: flex;
    align-items: center;

    gap: 9px;

    color: #52665a;

    font-size: 14px;
}

.facility-check {
    display: flex;

    align-items: center;
    justify-content: center;

    width: 22px;
    height: 22px;

    border-radius: 50%;

    background: #126b45;

    color: #fff;

    font-size: 12px;

    font-weight: 700;
}


.tips-text {
    color: #64776b;

    line-height: 1.8;

    font-size: 15px;

    margin: 0;
}


.back-button {
    display: inline-flex;

    align-items: center;

    padding: 12px 20px;

    border-radius: 10px;

    background: #126b45;

    color: #fff;

    text-decoration: none;

    font-weight: 700;

    font-size: 14px;

    transition: .25s ease;
}

.back-button:hover {
    background: #0d5738;
    color: #fff;

    transform: translateX(-3px);
}


@media (max-width: 991px) {

    .detail-image {
        height: 400px;
    }

    .detail-content h2 {
        font-size: 30px;
    }

}


@media (max-width: 768px) {

    .detail-banner h1 {
        font-size: 30px;
    }

    .detail-image {
        height: 300px;
    }

    .facility-list {
        grid-template-columns: 1fr;
    }

}

</style>

@endsection