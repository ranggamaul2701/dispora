@extends('layouts.app')

@section('title', 'Edit Agenda')

@section('content')

<div class="container py-5">

    <div class="mb-4">

        <a
            href="{{ route('admin.agenda.index') }}"
            class="text-decoration-none"
        >
            <i class="bi bi-arrow-left"></i>
            Kembali ke Agenda
        </a>

        <h2 class="fw-bold mt-3">
            Edit Agenda
        </h2>

    </div>


    @if($errors->any())

        <div class="alert alert-danger">

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    <div class="card border-0 shadow-sm">

        <div class="card-body p-4">

            <form
                action="{{ route(
                    'admin.agenda.update',
                    $agenda->id
                ) }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf

                @method('PUT')


                {{-- NAMA --}}

                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Nama Agenda
                    </label>

                    <input
                        type="text"
                        name="nama"
                        class="form-control"
                        value="{{ old('nama', $agenda->nama) }}"
                        required
                    >

                </div>


                {{-- KATEGORI --}}

                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Kategori
                    </label>

                    <select
                        name="kategori"
                        class="form-select"
                        required
                    >

                        @foreach([
                            'Festival',
                            'Budaya',
                            'Kuliner',
                            'Ekonomi Kreatif',
                            'Pariwisata'
                        ] as $kategori)

                            <option
                                value="{{ $kategori }}"
                                @selected(
                                    old(
                                        'kategori',
                                        $agenda->kategori
                                    ) === $kategori
                                )
                            >
                                {{ $kategori }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- DESKRIPSI --}}

                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Deskripsi
                    </label>

                    <textarea
                        name="deskripsi"
                        rows="5"
                        class="form-control"
                    >{{ old(
                        'deskripsi',
                        $agenda->deskripsi
                    ) }}</textarea>

                </div>


                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label fw-semibold">
                            Lokasi
                        </label>

                        <input
                            type="text"
                            name="lokasi"
                            class="form-control"
                            value="{{ old(
                                'lokasi',
                                $agenda->lokasi
                            ) }}"
                            required
                        >

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label fw-semibold">
                            Penyelenggara
                        </label>

                        <input
                            type="text"
                            name="penyelenggara"
                            class="form-control"
                            value="{{ old(
                                'penyelenggara',
                                $agenda->penyelenggara
                            ) }}"
                        >

                    </div>

                </div>


                <div class="row">

                    <div class="col-md-4 mb-3">

                        <label class="form-label fw-semibold">
                            Tanggal Mulai
                        </label>

                        <input
                            type="date"
                            name="tanggal_mulai"
                            class="form-control"
                            value="{{ old(
                                'tanggal_mulai',
                                optional(
                                    $agenda->tanggal_mulai
                                )->format('Y-m-d')
                            ) }}"
                            required
                        >

                    </div>


                    <div class="col-md-4 mb-3">

                        <label class="form-label fw-semibold">
                            Tanggal Selesai
                        </label>

                        <input
                            type="date"
                            name="tanggal_selesai"
                            class="form-control"
                            value="{{ old(
                                'tanggal_selesai',
                                optional(
                                    $agenda->tanggal_selesai
                                )->format('Y-m-d')
                            ) }}"
                            required
                        >

                    </div>


                    <div class="col-md-4 mb-3">

                        <label class="form-label fw-semibold">
                            Jam Mulai
                        </label>

                        <input
                            type="time"
                            name="jam_mulai"
                            class="form-control"
                            value="{{ old(
                                'jam_mulai',
                                $agenda->jam_mulai
                            ) }}"
                        >

                    </div>

                </div>


                {{-- KONTAK --}}

                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Kontak
                    </label>

                    <input
                        type="text"
                        name="kontak"
                        class="form-control"
                        value="{{ old(
                            'kontak',
                            $agenda->kontak
                        ) }}"
                    >

                </div>


                {{-- FOTO LAMA --}}

                @if($agenda->gambar)

                    <div class="mb-3">

                        <label class="form-label fw-semibold">
                            Foto Saat Ini
                        </label>

                        <br>

                        <img
                            src="{{ media_url(
                                $agenda->gambar,
                                'agenda'
                            ) }}"
                            alt="{{ $agenda->nama }}"
                            style="
                                width:280px;
                                height:180px;
                                object-fit:cover;
                                border-radius:10px;
                            "
                        >

                    </div>

                @endif


                {{-- FOTO BARU --}}

                <div class="mb-4">

                    <label class="form-label fw-semibold">
                        Ganti Foto
                    </label>

                    <input
                        type="file"
                        name="gambar"
                        class="form-control"
                        accept=".jpg,.jpeg,.png,.webp"
                        onchange="previewAgenda(event)"
                    >

                    <div class="form-text">
                        Kosongkan jika tidak ingin mengganti foto.
                    </div>


                    <div
                        id="preview-container"
                        class="mt-3"
                        style="display:none;"
                    >

                        <img
                            id="preview-image"
                            src=""
                            alt="Preview"
                            style="
                                width:280px;
                                height:180px;
                                object-fit:cover;
                                border-radius:10px;
                            "
                        >

                    </div>

                </div>


                {{-- PUBLISH --}}

                <div class="form-check mb-4">

                    <input
                        type="checkbox"
                        name="is_published"
                        value="1"
                        class="form-check-input"
                        id="is_published"
                        @checked($agenda->is_published)
                    >

                    <label
                        class="form-check-label"
                        for="is_published"
                    >
                        Tampilkan agenda di website
                    </label>

                </div>


                <div class="d-flex gap-2">

                    <a
                        href="{{ route('admin.agenda.index') }}"
                        class="btn btn-secondary"
                    >
                        Batal
                    </a>

                    <button
                        type="submit"
                        class="btn btn-success"
                    >
                        <i class="bi bi-save me-1"></i>
                        Update Agenda
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection


@push('scripts')

<script>

function previewAgenda(event)
{
    const file = event.target.files[0];

    const previewContainer =
        document.getElementById('preview-container');

    const previewImage =
        document.getElementById('preview-image');

    if (!file) {

        previewContainer.style.display = 'none';

        return;
    }

    previewImage.src =
        URL.createObjectURL(file);

    previewContainer.style.display = 'block';
}

</script>

@endpush