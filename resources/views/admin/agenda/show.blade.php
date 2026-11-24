<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Agenda - Admin DISPORAPAR Samarinda</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f7f6;
            font-family: Arial, sans-serif;
        }

        .navbar-custom {
            background: #198754;
        }

        .page-title {
            font-weight: 700;
            color: #198754;
        }

        .agenda-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            background: white;
            box-shadow: 0 4px 15px rgba(0,0,0,.08);
            height: 100%;
        }

        .agenda-image {
            width: 100%;
            height: 220px;
            object-fit: cover;
        }

        .agenda-placeholder {
            height: 220px;
            background: #e9f5ee;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #198754;
            font-size: 50px;
        }

        .badge-kategori {
            background: #198754;
        }

        .agenda-title {
            font-size: 20px;
            font-weight: 700;
            color: #222;
        }

        .agenda-info {
            color: #666;
            font-size: 14px;
        }

        .agenda-description {
            color: #555;
            line-height: 1.6;
        }
    </style>
</head>

<body>

<nav class="navbar navbar-dark navbar-custom">
    <div class="container">
        <a href="{{ route('admin.dashboard') }}"
           class="navbar-brand fw-bold">
            DISPORAPAR SAMARINDA
        </a>

        <a href="{{ route('admin.dashboard') }}"
           class="btn btn-light btn-sm">
            Dashboard
        </a>
    </div>
</nav>

<div class="container py-5">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="page-title mb-1">
                Agenda Pariwisata
            </h2>

            <p class="text-muted mb-0">
                Daftar agenda yang tersimpan di sistem.
            </p>
        </div>

        <a href="{{ route('admin.agenda.create') }}"
           class="btn btn-success">
            + Tambah Agenda
        </a>

    </div>


    {{-- PESAN SUKSES --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    {{-- PESAN ERROR --}}
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif


    {{-- JUMLAH DATA --}}
    <div class="mb-4">
        <strong>{{ $agenda->total() }}</strong>
        agenda ditemukan
    </div>


    {{-- AGENDA --}}
    <div class="row g-4">

        @forelse($agenda as $item)

            <div class="col-lg-4 col-md-6">

                <div class="agenda-card">

                    {{-- FOTO --}}
                    @if($item->gambar)

                        <img
                            src="{{ media_url($item->gambar, 'agenda') }}"
                            alt="{{ $item->nama }}"
                            class="agenda-image"
                        >

                    @else

                        <div class="agenda-placeholder">
                            <i class="bi bi-calendar-event"></i>
                        </div>

                    @endif


                    <div class="p-4">

                        {{-- KATEGORI --}}
                        @if($item->kategori)
                            <span class="badge badge-kategori mb-3">
                                {{ $item->kategori }}
                            </span>
                        @endif


                        {{-- NAMA --}}
                        <h3 class="agenda-title">
                            {{ $item->nama }}
                        </h3>


                        {{-- TANGGAL --}}
                        <div class="agenda-info mb-2">
                            <i class="bi bi-calendar-event me-1"></i>

                            {{ \Carbon\Carbon::parse($item->tanggal_mulai)->translatedFormat('d F Y') }}

                            @if($item->tanggal_selesai &&
                                $item->tanggal_selesai != $item->tanggal_mulai)

                                -
                                {{ \Carbon\Carbon::parse($item->tanggal_selesai)->translatedFormat('d F Y') }}

                            @endif
                        </div>


                        {{-- JAM --}}
                        @if($item->jam_mulai)
                            <div class="agenda-info mb-2">
                                <i class="bi bi-clock me-1"></i> {{ $item->jam_mulai }}
                            </div>
                        @endif


                        {{-- LOKASI --}}
                        @if($item->lokasi)
                            <div class="agenda-info mb-3">
                                <i class="bi bi-geo-alt me-1"></i> {{ $item->lokasi }}
                            </div>
                        @endif


                        {{-- DESKRIPSI --}}
                        @if($item->deskripsi)
                            <p class="agenda-description mb-3">
                                {{ $item->deskripsi }}
                            </p>
                        @endif


                        {{-- PENYELENGGARA --}}
                        @if($item->penyelenggara)
                            <div class="small text-muted mb-2">
                                <strong>Penyelenggara:</strong>
                                {{ $item->penyelenggara }}
                            </div>
                        @endif


                        {{-- KONTAK --}}
                        @if($item->kontak)
                            <div class="small text-muted mb-3">
                                <strong>Kontak:</strong>
                                {{ $item->kontak }}
                            </div>
                        @endif


                        {{-- STATUS --}}
                        @if($item->is_published)
                            <span class="badge bg-success mb-3">
                                Published
                            </span>
                        @else
                            <span class="badge bg-secondary mb-3">
                                Draft
                            </span>
                        @endif


                        {{-- BUTTON --}}
                        <div class="d-flex gap-2">

                            <a
                                href="{{ route('admin.agenda.edit', $item->id) }}"
                                class="btn btn-warning btn-sm"
                            >
                                Edit
                            </a>

                            <a
                                href="{{ route('admin.agenda.show', $item->id) }}"
                                class="btn btn-info btn-sm text-white"
                            >
                                Detail
                            </a>

                            <form
                                action="{{ route('admin.agenda.destroy', $item->id) }}"
                                method="POST"
                                onsubmit="return confirm('Hapus agenda ini?')"
                            >

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn btn-danger btn-sm"
                                >
                                    Hapus
                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        @empty

            <div class="col-12">

                <div class="alert alert-warning">
                    Belum ada agenda yang tersedia.
                </div>

            </div>

        @endforelse

    </div>


    {{-- PAGINATION --}}
    @if($agenda->hasPages())

        <div class="mt-5">
            {{ $agenda->links() }}
        </div>

    @endif

</div>

</body>
</html>