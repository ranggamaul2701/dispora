@extends('layouts.admin')

@section('title', 'Tambah Agenda')

@section('content')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1 class="h3 mb-1">
                Tambah Agenda
            </h1>

            <p class="text-muted mb-0">
                Tambahkan agenda pariwisata baru.
            </p>
        </div>

        <a
            href="{{ route('admin.agenda.index') }}"
            class="btn btn-outline-secondary"
        >
            <i class="bi bi-arrow-left me-1"></i>
            Kembali
        </a>

    </div>


    {{-- ERROR VALIDATION --}}
    @if ($errors->any())

        <div class="alert alert-danger">

            <strong>
                Ada kesalahan:
            </strong>

            <ul class="mb-0 mt-2">

                @foreach ($errors->all() as $error)

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
                action="{{ route('admin.agenda.store') }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf


                {{-- NAMA --}}
                <div class="mb-3">

                    <label
                        for="nama"
                        class="form-label fw-semibold"
                    >
                        Nama Agenda
                    </label>

                    <input
                        type="text"
                        name="nama"
                        id="nama"
                        class="form-control"
                        value="{{ old('nama') }}"
                        placeholder="Contoh: Festival Mahakam"
                        required
                    >

                </div>


                {{-- KATEGORI --}}
                <div class="mb-3">

                    <label
                        for="kategori"
                        class="form-label fw-semibold"
                    >
                        Kategori
                    </label>

                    <input
                        type="text"
                        name="kategori"
                        id="kategori"
                        class="form-control"
                        value="{{ old('kategori') }}"
                        placeholder="Contoh: Festival"
                        required
                    >

                </div>


                {{-- DESKRIPSI --}}
                <div class="mb-3">

                    <label
                        for="deskripsi"
                        class="form-label fw-semibold"
                    >
                        Deskripsi
                    </label>

                    <textarea
                        name="deskripsi"
                        id="deskripsi"
                        rows="5"
                        class="form-control"
                        placeholder="Deskripsi agenda..."
                    >{{ old('deskripsi') }}</textarea>

                </div>


                {{-- LOKASI --}}
                <div class="mb-3">

                    <label
                        for="lokasi"
                        class="form-label fw-semibold"
                    >
                        Lokasi
                    </label>

                    <input
                        type="text"
                        name="lokasi"
                        id="lokasi"
                        class="form-control"
                        value="{{ old('lokasi') }}"
                        placeholder="Contoh: Tepian Mahakam"
                        required
                    >

                </div>


                <div class="row">

                    {{-- TANGGAL MULAI --}}
                    <div class="col-md-6 mb-3">

                        <label
                            for="tanggal_mulai"
                            class="form-label fw-semibold"
                        >
                            Tanggal Mulai
                        </label>

                        <input
                            type="date"
                            name="tanggal_mulai"
                            id="tanggal_mulai"
                            class="form-control"
                            value="{{ old('tanggal_mulai') }}"
                            required
                        >

                    </div>


                    {{-- TANGGAL SELESAI --}}
                    <div class="col-md-6 mb-3">

                        <label
                            for="tanggal_selesai"
                            class="form-label fw-semibold"
                        >
                            Tanggal Selesai
                        </label>

                        <input
                            type="date"
                            name="tanggal_selesai"
                            id="tanggal_selesai"
                            class="form-control"
                            value="{{ old('tanggal_selesai') }}"
                            required
                        >

                    </div>

                </div>


                {{-- JAM --}}
                <div class="mb-3">

                    <label
                        for="jam_mulai"
                        class="form-label fw-semibold"
                    >
                        Jam
                    </label>

                    <input
                        type="text"
                        name="jam_mulai"
                        id="jam_mulai"
                        class="form-control"
                        value="{{ old('jam_mulai') }}"
                        placeholder="Contoh: 08.00 WITA"
                    >

                </div>


                {{-- PENYELENGGARA --}}
                <div class="mb-3">

                    <label
                        for="penyelenggara"
                        class="form-label fw-semibold"
                    >
                        Penyelenggara
                    </label>

                    <input
                        type="text"
                        name="penyelenggara"
                        id="penyelenggara"
                        class="form-control"
                        value="{{ old('penyelenggara') }}"
                        placeholder="Nama penyelenggara"
                    >

                </div>


                {{-- KONTAK --}}
                <div class="mb-3">

                    <label
                        for="kontak"
                        class="form-label fw-semibold"
                    >
                        Kontak
                    </label>

                    <input
                        type="text"
                        name="kontak"
                        id="kontak"
                        class="form-control"
                        value="{{ old('kontak') }}"
                        placeholder="Nomor telepon / email"
                    >

                </div>


                {{-- GAMBAR --}}
                <div class="mb-4">

                    <label
                        for="gambar"
                        class="form-label fw-semibold"
                    >
                        Foto Agenda
                    </label>

                    <input
                        type="file"
                        name="gambar"
                        id="gambar"
                        class="form-control"
                        accept=".jpg,.jpeg,.png,.webp"
                    >

                    <div class="form-text">
                        Format JPG, JPEG, PNG atau WEBP. Maksimal 5 MB.
                    </div>


                    {{-- PREVIEW --}}
                    <div
                        id="preview-container"
                        class="mt-3"
                        style="display:none;"
                    >

                        <p class="fw-semibold mb-2">
                            Preview Foto
                        </p>

                        <img
                            id="preview"
                            src=""
                            alt="Preview"
                            class="img-fluid rounded"
                            style="
                                max-width: 400px;
                                max-height: 250px;
                                object-fit: cover;
                            "
                        >

                    </div>

                </div>


                {{-- PUBLISH --}}
                <div class="form-check mb-4">

                    <input
                        type="checkbox"
                        name="is_published"
                        id="is_published"
                        value="1"
                        class="form-check-input"
                        checked
                    >

                    <label
                        for="is_published"
                        class="form-check-label"
                    >
                        Publikasikan agenda
                    </label>

                </div>


                {{-- BUTTON --}}
                <div class="d-flex gap-2">

                    <button
                        type="submit"
                        class="btn btn-success"
                    >
                        <i class="bi bi-save me-1"></i>
                        Simpan Agenda
                    </button>

                    <a
                        href="{{ route('admin.agenda.index') }}"
                        class="btn btn-outline-secondary"
                    >
                        Batal
                    </a>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- PREVIEW SCRIPT --}}
<script>

document
    .getElementById('gambar')
    .addEventListener('change', function(event) {

        const file = event.target.files[0];

        const preview =
            document.getElementById('preview');

        const container =
            document.getElementById('preview-container');


        if (!file) {

            container.style.display = 'none';

            preview.src = '';

            return;
        }


        const reader = new FileReader();


        reader.onload = function(e) {

            preview.src = e.target.result;

            container.style.display = 'block';

        };


        reader.readAsDataURL(file);

    });

</script>

@endsection