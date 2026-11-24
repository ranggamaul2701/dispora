@extends('layouts.app')

@section('title', $destinasi->nama . ' - Destinasi Wisata Samarinda')

@section('content')

<style>
    .dest-detail-page {
        padding-top: 55px;
        padding-bottom: 80px;
    }

    .dest-detail-image {
        width: 100%;
        height: 520px;
        object-fit: cover;
        border-radius: 18px;
        display: block;
    }

    .dest-detail-image-placeholder {
        width: 100%;
        height: 520px;
        border-radius: 18px;
        background: #f1f5f3;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 5rem;
    }

    .dest-detail-title {
        font-size: 2.8rem;
        font-weight: 800;
        color: #16834f;
        line-height: 1.15;
        margin-bottom: 15px;
    }

    .dest-detail-category {
        display: inline-block;
        background: #ffb511;
        color: #111;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: .8rem;
        font-weight: 700;
        margin-bottom: 16px;
    }

    .dest-detail-rating {
        font-size: 1rem;
        margin-bottom: 25px;
    }

    .dest-detail-description {
        font-size: 1rem;
        line-height: 1.8;
        color: #444;
        margin-bottom: 25px;
    }

    .dest-info-box {
        border-top: 1px solid #ddd;
        padding-top: 20px;
    }

    .dest-info-item {
        margin-bottom: 20px;
    }

    .dest-info-item strong {
        display: block;
        font-size: 1rem;
        margin-bottom: 5px;
        color: #222;
    }

    .dest-info-item span {
        color: #555;
        font-size: .95rem;
    }

    @media (max-width: 991px) {

        .dest-detail-page {
            padding-top: 40px;
        }

        .dest-detail-image,
        .dest-detail-image-placeholder {
            height: 400px;
        }

        .dest-detail-title {
            font-size: 2.2rem;
        }
    }

    @media (max-width: 575px) {

        .dest-detail-image,
        .dest-detail-image-placeholder {
            height: 280px;
        }

        .dest-detail-title {
            font-size: 1.8rem;
        }
    }
</style>


<section class="dest-detail-page">

    <div class="container">

        {{-- ================================================= --}}
        {{-- TOMBOL KEMBALI --}}
        {{-- ================================================= --}}

        <div class="mb-4">

            <a
                href="{{ route('destinasi.index') }}"
                class="btn-accent d-inline-flex align-items-center"
            >

                <i class="bi bi-arrow-left me-2"></i>

                Kembali ke Destinasi

            </a>

        </div>


        {{-- ================================================= --}}
        {{-- DETAIL --}}
        {{-- ================================================= --}}

        <div class="row g-5 align-items-start">


            {{-- ================================================= --}}
            {{-- FOTO --}}
            {{-- ================================================= --}}

            <div
                class="col-lg-6"
                data-aos="fade-right"
            >

                @php

                    /*
                    |--------------------------------------------------------------------------
                    | FOTO DESTINASI
                    |--------------------------------------------------------------------------
                    |
                    | Mendukung:
                    |
                    | 1. Foto lama
                    |    public/images/destinasi/
                    |
                    | 2. Foto baru dari dashboard
                    |    storage/app/public/destinasi/
                    |
                    */

                    $fotoUrl = media_url(
                        $destinasi->foto,
                        'destinasi'
                    );

                @endphp


                @if($destinasi->foto)

                    <img
                        src="{{ $fotoUrl }}"
                        alt="{{ $destinasi->nama }}"
                        class="dest-detail-image"
                        onerror="
                            this.onerror=null;
                            this.style.display='none';
                            document.getElementById('destFotoPlaceholder').style.display='flex';
                        "
                    >

                    <div
                        id="destFotoPlaceholder"
                        class="dest-detail-image-placeholder"
                        style="display:none;"
                    >
                        @if(str_starts_with($destinasi->icon ?? '', 'bi-'))<i class="bi {{ $destinasi->icon }}"></i>@else<i class="bi bi-geo-alt"></i>@endif
                    </div>

                @else

                    <div class="dest-detail-image-placeholder">

                        @if(str_starts_with($destinasi->icon ?? '', 'bi-'))<i class="bi {{ $destinasi->icon }}"></i>@else<i class="bi bi-geo-alt"></i>@endif

                    </div>

                @endif

            </div>



            {{-- ================================================= --}}
            {{-- INFORMASI --}}
            {{-- ================================================= --}}

            <div
                class="col-lg-6"
                data-aos="fade-left"
            >

                {{-- KATEGORI --}}

                <span class="dest-detail-category">

                    {{ $destinasi->kategori }}

                </span>


                {{-- JUDUL --}}

                <h1 class="dest-detail-title">

                    {{ $destinasi->nama }}

                </h1>


                {{-- RATING --}}

                <div class="dest-detail-rating">

                    ⭐

                    <strong>
                        {{ number_format((float) $destinasi->rating, 1) }}
                    </strong>

                    @if($destinasi->ulasan > 0)

                        <span class="text-muted">
                            ({{ number_format($destinasi->ulasan) }}
                            ulasan)
                        </span>

                    @endif

                </div>


                {{-- DESKRIPSI --}}

                <div class="dest-detail-description">

                    {{ $destinasi->deskripsi }}

                </div>


                {{-- ================================================= --}}
                {{-- INFO --}}
                {{-- ================================================= --}}

                <div class="dest-info-box">


                    {{-- ALAMAT --}}

                    <div class="dest-info-item">

                        <strong>

                            <i class="bi bi-geo-alt me-1"></i> Alamat

                        </strong>

                        <span>

                            {{ $destinasi->alamat }}

                        </span>

                    </div>



                    {{-- HARGA --}}

                    <div class="dest-info-item">

                        <strong>

                            <i class="bi bi-ticket-perforated me-1"></i> Harga

                        </strong>

                        <span>

                            {{ $destinasi->harga }}

                        </span>

                    </div>



                    {{-- JAM --}}

                    <div class="dest-info-item">

                        <strong>

                            <i class="bi bi-clock me-1"></i> Jam Operasional

                        </strong>

                        <span>

                            {{ $destinasi->jam }}

                        </span>

                    </div>



                    {{-- DURASI --}}

                    <div class="dest-info-item">

                        <strong>

                            <i class="bi bi-stopwatch me-1"></i> Durasi

                        </strong>

                        <span>

                            {{ $destinasi->durasi }}

                        </span>

                    </div>



                    {{-- FASILITAS --}}

                    @if(!empty($destinasi->fasilitas))

                        <div class="dest-info-item">

                            <strong>

                                <i class="bi bi-check2-circle me-1"></i> Fasilitas

                            </strong>

                            <span>

                                @foreach($destinasi->fasilitas as $fasilitas)

                                    <span
                                        style="
                                            display:inline-block;
                                            background:#f1f7f3;
                                            color:#167449;
                                            padding:5px 10px;
                                            border-radius:15px;
                                            margin:3px;
                                            font-size:.8rem;
                                        "
                                    >

                                        {{ $fasilitas }}

                                    </span>

                                @endforeach

                            </span>

                        </div>

                    @endif



                    {{-- TIPS --}}

                    @if($destinasi->tips)

                        <div class="dest-info-item">

                            <strong>

                                <i class="bi bi-lightbulb me-1"></i> Tips

                            </strong>

                            <span>

                                {{ $destinasi->tips }}

                            </span>

                        </div>

                    @endif


                </div>



                {{-- ================================================= --}}
                {{-- GOOGLE MAP --}}
                {{-- ================================================= --}}

                @if($destinasi->maps)

                    <div class="mt-4">

                        <a
                            href="{{ $destinasi->maps }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="btn-accent d-inline-flex align-items-center"
                        >

                            <i class="bi bi-geo-alt me-2"></i>

                            Lihat di Google Maps

                        </a>

                    </div>

                @endif

            </div>

        </div>

    </div>

</section>

@endsection