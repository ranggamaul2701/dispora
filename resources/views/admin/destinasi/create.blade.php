@extends('layouts.app')

@section('content')

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold mb-1">Tambah Destinasi</h2>
            <p class="text-muted mb-0">
                Tambahkan destinasi wisata baru.
            </p>
        </div>

        <a href="{{ route('admin.destinasi.index') }}"
           class="btn btn-secondary">
            <i class="bi bi-arrow-left me-1"></i>
            Kembali
        </a>

    </div>


    @if($errors->any())

        <div class="alert alert-danger">

            <strong>Terjadi kesalahan:</strong>

            <ul class="mb-0 mt-2">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    <form action="{{ route('admin.destinasi.store') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf


        <div class="card border-0 shadow-sm">

            <div class="card-body p-4">

                <h5 class="fw-bold mb-4">
                    Informasi Destinasi
                </h5>


                <div class="row g-3">

                    <div class="col-md-8">

                        <label class="form-label fw-semibold">
                            Nama Destinasi
                        </label>

                        <input type="text"
                               name="nama"
                               class="form-control"
                               value="{{ old('nama') }}"
                               required>

                    </div>


                    <div class="col-md-4">

                        <label class="form-label fw-semibold">
                            Kategori
                        </label>

                        <select name="kategori"
                                class="form-select"
                                required>

                            <option value="">Pilih Kategori</option>

                            <option value="Wisata Alam"
                                {{ old('kategori') == 'Wisata Alam' ? 'selected' : '' }}>
                                Wisata Alam
                            </option>

                            <option value="Wisata Budaya"
                                {{ old('kategori') == 'Wisata Budaya' ? 'selected' : '' }}>
                                Wisata Budaya
                            </option>

                            <option value="Wisata Religi"
                                {{ old('kategori') == 'Wisata Religi' ? 'selected' : '' }}>
                                Wisata Religi
                            </option>

                            <option value="Wisata Kuliner"
                                {{ old('kategori') == 'Wisata Kuliner' ? 'selected' : '' }}>
                                Wisata Kuliner
                            </option>

                        </select>

                    </div>


                    <div class="col-md-8">

                        <label class="form-label fw-semibold">
                            Slug
                        </label>

                        <input type="text"
                               name="slug"
                               class="form-control"
                               value="{{ old('slug') }}"
                               placeholder="Kosongkan untuk dibuat otomatis">

                    </div>


                    <div class="col-md-4">

                        <label class="form-label fw-semibold">
                            Icon
                        </label>

                        <input type="text"
                               name="icon"
                               class="form-control"
                               value="{{ old('icon', 'bi-geo-alt') }}"
                               placeholder="bi-geo-alt">

                    </div>


                    <div class="col-md-4">

                        <label class="form-label fw-semibold">
                            Rating
                        </label>

                        <input type="number"
                               name="rating"
                               class="form-control"
                               value="{{ old('rating', 0) }}"
                               min="0"
                               max="5"
                               step="0.1">

                    </div>


                    <div class="col-md-4">

                        <label class="form-label fw-semibold">
                            Jumlah Ulasan
                        </label>

                        <input type="number"
                               name="ulasan"
                               class="form-control"
                               value="{{ old('ulasan', 0) }}"
                               min="0">

                    </div>


                    <div class="col-md-4">

                        <label class="form-label fw-semibold">
                            Harga
                        </label>

                        <input type="text"
                               name="harga"
                               class="form-control"
                               value="{{ old('harga', 'Gratis') }}">

                    </div>


                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Jam
                        </label>

                        <input type="text"
                               name="jam"
                               class="form-control"
                               value="{{ old('jam', '08.00-17.00') }}">

                    </div>


                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Durasi
                        </label>

                        <input type="text"
                               name="durasi"
                               class="form-control"
                               value="{{ old('durasi', '1-2 Jam') }}">

                    </div>


                    <div class="col-12">

                        <label class="form-label fw-semibold">
                            Alamat
                        </label>

                        <textarea name="alamat"
                                  class="form-control"
                                  rows="3"
                                  required>{{ old('alamat') }}</textarea>

                    </div>


                    <div class="col-12">

                        <label class="form-label fw-semibold">
                            Google Maps
                        </label>

                        <textarea name="maps"
                                  class="form-control"
                                  rows="2"
                                  placeholder="URL Google Maps">{{ old('maps') }}</textarea>

                    </div>


                    <div class="col-12">

                        <label class="form-label fw-semibold">
                            Deskripsi
                        </label>

                        <textarea name="deskripsi"
                                  class="form-control"
                                  rows="5"
                                  required>{{ old('deskripsi') }}</textarea>

                    </div>


                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Fasilitas
                        </label>

                        <input type="text"
                               name="fasilitas"
                               class="form-control"
                               value="{{ old('fasilitas') }}"
                               placeholder="Parkir, Toilet, Spot Foto">

                        <div class="form-text">
                            Pisahkan dengan koma.
                        </div>

                    </div>


                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Galeri Slug
                        </label>

                        <input type="text"
                               name="galeri_slug"
                               class="form-control"
                               value="{{ old('galeri_slug') }}">

                    </div>


                    <div class="col-12">

                        <label class="form-label fw-semibold">
                            Tips
                        </label>

                        <textarea name="tips"
                                  class="form-control"
                                  rows="3">{{ old('tips') }}</textarea>

                    </div>


                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Foto
                        </label>

                        <input type="file"
                               name="foto"
                               class="form-control"
                               accept=".jpg,.jpeg,.png,.webp">

                    </div>


                    <div class="col-md-6 d-flex align-items-end">

                        <div class="form-check mb-2">

                            <input type="checkbox"
                                   name="aktif"
                                   value="1"
                                   class="form-check-input"
                                   id="aktif"
                                   checked>

                            <label class="form-check-label"
                                   for="aktif">
                                Destinasi aktif
                            </label>

                        </div>

                    </div>

                </div>

            </div>


            <div class="card-footer bg-white border-0 p-4">

                <button type="submit"
                        class="btn btn-success">

                    <i class="bi bi-save me-1"></i>
                    Simpan Destinasi

                </button>

                <a href="{{ route('admin.destinasi.index') }}"
                   class="btn btn-secondary">

                    Batal

                </a>

            </div>

        </div>

    </form>

</div>

@endsection