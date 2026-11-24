@extends('layouts.app')

@section('content')

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold mb-1">Edit Destinasi</h2>
            <p class="text-muted mb-0">
                Perbarui informasi destinasi.
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

            <ul class="mb-0">

                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>

    @endif


    <form action="{{ route('admin.destinasi.update', $destinasi) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')


        <div class="card border-0 shadow-sm">

            <div class="card-body p-4">

                <div class="row g-3">


                    <div class="col-md-8">

                        <label class="form-label fw-semibold">
                            Nama Destinasi
                        </label>

                        <input type="text"
                               name="nama"
                               class="form-control"
                               value="{{ old('nama', $destinasi->nama) }}"
                               required>

                    </div>


                    <div class="col-md-4">

                        <label class="form-label fw-semibold">
                            Kategori
                        </label>

                        <select name="kategori"
                                class="form-select"
                                required>

                            @foreach([
                                'Wisata Alam',
                                'Wisata Budaya',
                                'Wisata Religi',
                                'Wisata Kuliner'
                            ] as $kategori)

                                <option value="{{ $kategori }}"
                                    {{ old('kategori', $destinasi->kategori) == $kategori ? 'selected' : '' }}>
                                    {{ $kategori }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    <div class="col-md-8">

                        <label class="form-label fw-semibold">
                            Slug
                        </label>

                        <input type="text"
                               name="slug"
                               class="form-control"
                               value="{{ old('slug', $destinasi->slug) }}">

                    </div>


                    <div class="col-md-4">

                        <label class="form-label fw-semibold">
                            Icon
                        </label>

                        <input type="text"
                               name="icon"
                               class="form-control"
                               value="{{ old('icon', $destinasi->icon) }}">

                    </div>


                    <div class="col-md-4">

                        <label class="form-label fw-semibold">
                            Rating
                        </label>

                        <input type="number"
                               name="rating"
                               class="form-control"
                               value="{{ old('rating', $destinasi->rating) }}"
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
                               value="{{ old('ulasan', $destinasi->ulasan) }}"
                               min="0">

                    </div>


                    <div class="col-md-4">

                        <label class="form-label fw-semibold">
                            Harga
                        </label>

                        <input type="text"
                               name="harga"
                               class="form-control"
                               value="{{ old('harga', $destinasi->harga) }}">

                    </div>


                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Jam
                        </label>

                        <input type="text"
                               name="jam"
                               class="form-control"
                               value="{{ old('jam', $destinasi->jam) }}">

                    </div>


                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Durasi
                        </label>

                        <input type="text"
                               name="durasi"
                               class="form-control"
                               value="{{ old('durasi', $destinasi->durasi) }}">

                    </div>


                    <div class="col-12">

                        <label class="form-label fw-semibold">
                            Alamat
                        </label>

                        <textarea name="alamat"
                                  class="form-control"
                                  rows="3"
                                  required>{{ old('alamat', $destinasi->alamat) }}</textarea>

                    </div>


                    <div class="col-12">

                        <label class="form-label fw-semibold">
                            Google Maps
                        </label>

                        <textarea name="maps"
                                  class="form-control"
                                  rows="2">{{ old('maps', $destinasi->maps) }}</textarea>

                    </div>


                    <div class="col-12">

                        <label class="form-label fw-semibold">
                            Deskripsi
                        </label>

                        <textarea name="deskripsi"
                                  class="form-control"
                                  rows="5"
                                  required>{{ old('deskripsi', $destinasi->deskripsi) }}</textarea>

                    </div>


                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Fasilitas
                        </label>

                        <input type="text"
                               name="fasilitas"
                               class="form-control"
                               value="{{ old('fasilitas', is_array($destinasi->fasilitas) ? implode(', ', $destinasi->fasilitas) : '') }}">

                    </div>


                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Galeri Slug
                        </label>

                        <input type="text"
                               name="galeri_slug"
                               class="form-control"
                               value="{{ old('galeri_slug', $destinasi->galeri_slug) }}">

                    </div>


                    <div class="col-12">

                        <label class="form-label fw-semibold">
                            Tips
                        </label>

                        <textarea name="tips"
                                  class="form-control"
                                  rows="3">{{ old('tips', $destinasi->tips) }}</textarea>

                    </div>


                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Foto Baru
                        </label>

                        <input type="file"
                               name="foto"
                               class="form-control"
                               accept=".jpg,.jpeg,.png,.webp">

                    </div>


                    @if($destinasi->foto)

                        <div class="col-md-6">

                            <label class="form-label fw-semibold">
                                Foto Saat Ini
                            </label>

                            <div>

                                <img src="{{ asset('storage/'.$destinasi->foto) }}"
                                     alt="{{ $destinasi->nama }}"
                                     style="width:180px;height:110px;object-fit:cover;border-radius:10px;">

                            </div>

                        </div>

                    @endif


                    <div class="col-12">

                        <div class="form-check">

                            <input type="checkbox"
                                   name="aktif"
                                   value="1"
                                   class="form-check-input"
                                   id="aktif"
                                   {{ old('aktif', $destinasi->aktif) ? 'checked' : '' }}>

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
                    Simpan Perubahan

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