@extends('admin.layout')

@section('title', 'Tambah Foto Galeri')

@section('content')

<div class="container-fluid">

    <div class="mb-4">

        <a
            href="{{ route('admin.galeri.index') }}"
            class="text-decoration-none text-success"
        >
            <i class="bi bi-arrow-left"></i>
            Kembali ke Galeri
        </a>

        <h3 class="fw-bold mt-3 mb-1">
            Tambah Foto Galeri
        </h3>

        <p class="text-muted mb-0">
            Upload foto baru ke album galeri.
        </p>

    </div>

    @if($errors->any())

        <div class="alert alert-danger">

            <strong>Periksa kembali data:</strong>

            <ul class="mb-0 mt-2">

                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>

    @endif

    <div class="row">

        <div class="col-lg-8">

            <div class="card border-0 shadow-sm">

                <div class="card-body p-4">

                    <form
                        action="{{ route('admin.galeri.store') }}"
                        method="POST"
                        enctype="multipart/form-data"
                    >

                        @csrf

                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Album Galeri
                            </label>

                            <select
                                name="album_id"
                                class="form-select"
                                required
                            >

                                <option value="">
                                    -- Pilih Album --
                                </option>

                                @foreach($albums as $album)

                                    <option
                                        value="{{ $album->id }}"
                                        {{ old('album_id', request('album')) == $album->id ? 'selected' : '' }}
                                    >
                                        {{ $album->nama }}
                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Judul Foto
                            </label>

                            <input
                                type="text"
                                name="judul"
                                class="form-control"
                                value="{{ old('judul') }}"
                                placeholder="Contoh: Senja di Tepian Mahakam"
                                required
                            >

                        </div>

                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Foto
                            </label>

                            <input
                                type="file"
                                name="foto"
                                class="form-control"
                                accept=".jpg,.jpeg,.png,.webp"
                                required
                            >

                            <div class="form-text">
                                Format JPG, JPEG, PNG atau WEBP. Maksimal 5 MB.
                            </div>

                        </div>

                        <div
                            id="preview-container"
                            class="mb-4"
                            style="display:none;"
                        >

                            <label class="form-label fw-semibold">
                                Preview
                            </label>

                            <div>
                                <img
                                    id="preview-image"
                                    src=""
                                    alt="Preview"
                                    class="rounded"
                                    style="
                                        max-width:100%;
                                        max-height:350px;
                                        object-fit:cover;
                                    "
                                >
                            </div>

                        </div>

                        <div class="d-flex gap-2">

                            <a
                                href="{{ route('admin.galeri.index') }}"
                                class="btn btn-light"
                            >
                                Batal
                            </a>

                            <button
                                type="submit"
                                class="btn btn-success"
                            >
                                <i class="bi bi-upload me-1"></i>
                                Upload Foto
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

        <div class="col-lg-4 mt-4 mt-lg-0">

            <div class="card border-0 shadow-sm">

                <div class="card-body p-4">

                    <h5 class="fw-bold mb-3">
                        Informasi
                    </h5>

                    <p class="text-muted small">
                        Foto yang diupload melalui halaman ini akan
                        disimpan di storage aplikasi dan dapat ditampilkan
                        bersama foto galeri lama.
                    </p>

                    <hr>

                    <div class="small">

                        <div class="mb-2">
                            <strong>Format:</strong>
                            JPG, JPEG, PNG, WEBP
                        </div>

                        <div class="mb-2">
                            <strong>Maksimal:</strong>
                            5 MB
                        </div>

                        <div>
                            <strong>Lokasi:</strong>
                            storage/app/public/galeri
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<script>

document
    .querySelector('input[name="foto"]')
    .addEventListener('change', function(event) {

        const file = event.target.files[0];

        const previewContainer =
            document.getElementById('preview-container');

        const previewImage =
            document.getElementById('preview-image');

        if (!file) {
            previewContainer.style.display = 'none';
            previewImage.src = '';
            return;
        }

        const reader = new FileReader();

        reader.onload = function(e) {
            previewImage.src = e.target.result;
            previewContainer.style.display = 'block';
        };

        reader.readAsDataURL(file);

    });

</script>

@endsection