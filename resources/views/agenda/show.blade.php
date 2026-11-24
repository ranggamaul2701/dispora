@extends('layouts.app')

@section('title', $agenda->nama)

@section('content')

<div class="container py-5">

    <a
        href="{{ route('agenda.index') }}"
        class="btn btn-outline-success mb-4"
    >
        <i class="bi bi-arrow-left"></i>
        Kembali ke Agenda
    </a>


    <div class="card border-0 shadow-sm overflow-hidden">

        @if($agenda->gambar)

            <img
                src="{{ media_url(
                    $agenda->gambar,
                    'agenda'
                ) }}"
                alt="{{ $agenda->nama }}"
                style="
                    width:100%;
                    max-height:500px;
                    object-fit:cover;
                "
            >

        @endif


        <div class="card-body p-4 p-md-5">

            @if($agenda->kategori)

                <span class="badge bg-success mb-3">
                    {{ $agenda->kategori }}
                </span>

            @endif


            <h1 class="fw-bold mb-4">
                {{ $agenda->nama }}
            </h1>


            <div class="row g-3 mb-4">

                <div class="col-md-6">

                    <strong>
                        <i class="bi bi-calendar"></i>
                        Tanggal
                    </strong>

                    <br>

                    {{ $agenda->tanggal_mulai->translatedFormat('d F Y') }}

                    @if(
                        $agenda->tanggal_selesai &&
                        $agenda->tanggal_selesai != $agenda->tanggal_mulai
                    )

                        -
                        {{ $agenda->tanggal_selesai->translatedFormat('d F Y') }}

                    @endif

                </div>


                @if($agenda->jam_mulai)

                    <div class="col-md-6">

                        <strong>
                            <i class="bi bi-clock"></i>
                            Jam
                        </strong>

                        <br>

                        {{ $agenda->jam_mulai }}

                    </div>

                @endif


                @if($agenda->lokasi)

                    <div class="col-md-6">

                        <strong>
                            <i class="bi bi-geo-alt"></i>
                            Lokasi
                        </strong>

                        <br>

                        {{ $agenda->lokasi }}

                    </div>

                @endif


                @if($agenda->penyelenggara)

                    <div class="col-md-6">

                        <strong>
                            Penyelenggara
                        </strong>

                        <br>

                        {{ $agenda->penyelenggara }}

                    </div>

                @endif


                @if($agenda->kontak)

                    <div class="col-md-6">

                        <strong>
                            Kontak
                        </strong>

                        <br>

                        {{ $agenda->kontak }}

                    </div>

                @endif

            </div>


            @if($agenda->deskripsi)

                <hr>

                <h4 class="fw-bold mt-4">
                    Keterangan
                </h4>

                <div class="text-muted"
                     style="line-height:1.8;">

                    {!! nl2br(e($agenda->deskripsi)) !!}

                </div>

            @endif

        </div>

    </div>

</div>

@endsection