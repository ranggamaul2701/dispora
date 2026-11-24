@extends('admin.layout')
@section('title', $item ? 'Edit Destinasi' : 'Tambah Destinasi')
@section('content')
@include('admin.partials.head', ['icon' => 'bi-geo-alt-fill', 'bg' => 'linear-gradient(135deg,#1565C0,#1E88E5)', 'judul' => $item ? 'Edit Destinasi' : 'Tambah Destinasi Baru', 'sub' => $item ? 'Perbarui informasi destinasi wisata' : 'Tambahkan destinasi wisata baru ke website', 'kembali' => route('admin.destinasi.index')])

<form method="POST" enctype="multipart/form-data" action="{{ $item ? route('admin.destinasi.update', $item) : route('admin.destinasi.store') }}">
    @csrf @if($item) @method('PUT') @endif
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="dcard mb-4">
                <div class="dcard-h"><div class="dcard-t"><span class="ic"><i class="bi bi-card-checklist"></i></span> Informasi Dasar</div></div>
                <div class="dcard-b"><div class="row g-3">
                    <div class="col-md-8"><label class="f-label">Nama Destinasi *</label><input class="f-input @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama', $item?->nama) }}" required></div>
                    <div class="col-md-4"><label class="f-label">Kategori *</label>
                        <select class="f-input" name="kategori" required>@foreach(config('pariwisata.kategori_destinasi') as $k)<option value="{{ $k }}" @selected(old('kategori', $item?->kategori) === $k)>{{ $k }}</option>@endforeach</select></div>
                    <div class="col-12"><label class="f-label">Alamat *</label><textarea class="f-input" rows="2" name="alamat" required>{{ old('alamat', $item?->alamat) }}</textarea></div>
                    <div class="col-12"><label class="f-label">Deskripsi *</label><textarea class="f-input" rows="6" name="deskripsi" required>{{ old('deskripsi', $item?->deskripsi) }}</textarea></div>
                    <div class="col-12"><label class="f-label">Tips Berkunjung</label><textarea class="f-input" rows="3" name="tips">{{ old('tips', $item?->tips) }}</textarea></div>
                    <div class="col-12"><label class="f-label">Fasilitas</label><input class="f-input" name="fasilitas" value="{{ old('fasilitas', is_array($item?->fasilitas) ? implode(', ', $item->fasilitas) : '') }}" placeholder="Parkir, Toilet, Spot Foto"><div class="f-hint">Pisahkan dengan koma.</div></div>
                    <div class="col-12"><label class="f-label">Link Embed Google Maps (opsional)</label><textarea class="f-input" rows="2" name="maps" placeholder="https://www.google.com/maps/embed?pb=...">{{ old('maps', $item?->maps) }}</textarea><div class="f-hint">Kosongkan agar peta dibuat otomatis dari nama destinasi.</div></div>
                </div></div>
            </div>

            {{-- GALERI FOTO KHUSUS WISATA --}}
            <div class="dcard mb-4">
                <div class="dcard-h">
                    <div class="dcard-t"><span class="ic"><i class="bi bi-camera"></i></span> Foto-Foto Galeri Khusus Wisata Ini</div>
                </div>
                <div class="dcard-b">
                    <p style="font-size:.86rem;color:var(--text-soft);margin-bottom:14px">
                        Unggah foto-foto suasana atau spot menarik yang khusus untuk destinasi <strong>{{ $item?->nama ?? 'ini' }}</strong>. Foto ini akan tampil di galeri foto halaman detail wisata.
                    </p>

                    @if($item && !empty($item->foto_tambahan) && count($item->foto_tambahan) > 0)
                        <div class="mb-3">
                            <label class="f-label mb-2">Foto Yang Sudah Tersimpan (Centang untuk menghapus):</label>
                            <div class="row g-2">
                                @foreach($item->foto_tambahan as $idx => $ft)
                                    <div class="col-6 col-sm-4 col-md-3">
                                        <div style="position:relative;border-radius:10px;overflow:hidden;border:1.5px solid var(--border);background:#fff">
                                            <img src="{{ media_url($ft, 'destinasi') }}" alt="Foto Wisata" style="width:100%;height:110px;object-fit:cover;display:block" onerror="this.src='{{ asset('images/no-image.png') }}'">
                                            <label style="display:flex;align-items:center;gap:6px;background:rgba(255,255,255,.94);padding:6px 8px;font-size:.75rem;cursor:pointer;color:#C62828;font-weight:600;margin:0;border-top:1px solid #ECEFF1">
                                                <input type="checkbox" name="hapus_foto_tambahan[]" value="{{ $ft }}" style="accent-color:#C62828">
                                                Hapus foto
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div style="background:#F8FBFF;border:2px dashed #90CAF9;border-radius:12px;padding:20px;text-align:center">
                        <i class="bi bi-images" style="font-size:2rem;color:var(--primary);display:block;margin-bottom:8px"></i>
                        <label class="f-label mb-1" style="font-size:.92rem;color:var(--primary);cursor:pointer">Pilih Foto-Foto Tambahan</label>
                        <div style="font-size:.8rem;color:var(--text-soft);margin-bottom:12px">Bisa pilih banyak foto sekaligus (tekan Ctrl atau Shift saat memilih file)</div>
                        <input type="file" class="f-input" name="foto_tambahan[]" accept=".jpg,.jpeg,.png,.webp" multiple onchange="prevMulti(this)" style="max-width:380px;margin:0 auto">
                        <div class="f-hint mt-2">Format: JPG, PNG, WebP (maks 5 MB per foto).</div>
                        <div id="multiPrevContainer" class="row g-2 mt-3" style="display:none"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            {{-- FOTO UTAMA / COVER --}}
            <div class="dcard mb-4">
                <div class="dcard-h"><div class="dcard-t"><span class="ic"><i class="bi bi-image"></i></span> Foto Utama (Sampul)</div></div>
                <div class="dcard-b">
                    <div style="position:relative;border-radius:11px;overflow:hidden;border:2px solid var(--sky);background:#EBF3FC;margin-bottom:12px;min-height:160px;display:flex;align-items:center;justify-content:center">
                        <img class="img-prev" id="prev"
                             src="{{ $item?->gambar ? media_url($item->gambar, 'destinasi') : '' }}"
                             alt="Foto Sampul"
                             style="margin-bottom:0;border:none;background:transparent;width:100%;height:180px;object-fit:cover;{{ $item?->gambar ? 'display:block' : 'display:none' }}"
                             onerror="this.style.display='none';document.getElementById('no-prev-placeholder').style.display='flex'">
                        <div id="no-prev-placeholder" style="{{ $item?->gambar ? 'display:none;' : 'display:flex;' }}flex-direction:column;align-items:center;justify-content:center;padding:30px 15px;color:var(--text-soft)">
                            <i class="bi bi-image" style="font-size:2.5rem;color:#90CAF9;display:block;margin-bottom:6px"></i>
                            <span style="font-size:.85rem;font-weight:600">Belum ada foto sampul</span>
                        </div>
                    </div>
                    <label class="f-label mb-1">Ganti / Upload Foto Sampul</label>
                    <input type="file" class="f-input" name="foto" accept=".jpg,.jpeg,.png,.webp" onchange="prevImg(this)">
                    <div class="f-hint">JPG / PNG / WebP, maks 5 MB. Ditampilkan sebagai thumbnail dan banner utama.</div>
                </div>
            </div>

            <div class="dcard mb-4">
                <div class="dcard-h"><div class="dcard-t"><span class="ic"><i class="bi bi-info-circle-fill"></i></span> Info Kunjungan</div></div>
                <div class="dcard-b d-flex flex-column gap-3">
                    <div><label class="f-label">Harga Tiket *</label><input class="f-input" name="harga" value="{{ old('harga', $item?->harga ?? 'Gratis') }}" required></div>
                    <div><label class="f-label">Jam Buka *</label><input class="f-input" name="jam" value="{{ old('jam', $item?->jam ?? '08.00 - 17.00 WITA') }}" required></div>
                    <div><label class="f-label">Estimasi Durasi *</label><input class="f-input" name="durasi" value="{{ old('durasi', $item?->durasi ?? '1 - 2 Jam') }}" required></div>
                    <div class="row g-2">
                        <div class="col-6"><label class="f-label"><i class="bi bi-star-fill text-warning me-1"></i> Rating (0–5)</label><input type="number" step="0.1" min="0" max="5" class="f-input" name="rating" value="{{ old('rating', $item?->rating ?? 0) }}"></div>
                        <div class="col-6"><label class="f-label"><i class="bi bi-chat-left-text me-1"></i> Ulasan</label><input type="number" min="0" class="f-input" name="ulasan" value="{{ old('ulasan', $item?->ulasan ?? 0) }}"></div>
                    </div>
                    <div class="row g-2">
                        <div class="col-4"><label class="f-label">Ikon</label><input class="f-input text-center" name="icon" value="{{ old('icon', $item?->icon ?? 'bi-geo-alt') }}"></div>
                        <div class="col-8"><label class="f-label">Album Galeri (Opsional)</label>
                            <select class="f-input" name="galeri_slug"><option value="">— tanpa album —</option>@foreach(config('pariwisata.albums') as $s => $m)<option value="{{ $s }}" @selected(old('galeri_slug', $item?->galeri_slug) === $s)>{{ $m['nama'] }}</option>@endforeach</select></div>
                    </div>
                    <label class="switch-box"><input type="hidden" name="is_published" value="0"><input type="checkbox" name="is_published" value="1" @checked(old('is_published', $item?->is_published ?? true))><div><div style="font-weight:700;color:var(--primary);font-size:.88rem">Tampilkan di website</div><small style="color:var(--text-soft)">Nonaktifkan untuk menyembunyikan</small></div></label>
                </div>
            </div>
            <div class="d-grid gap-2">
                <button class="btn-d btn-blue justify-content-center" style="padding:13px" type="submit"><i class="bi bi-check-circle-fill"></i> {{ $item ? 'Simpan Perubahan' : 'Tambah Destinasi' }}</button>
                <a href="{{ route('admin.destinasi.index') }}" class="btn-d btn-light-d justify-content-center"><i class="bi bi-x-circle"></i> Batal</a>
            </div>
        </div>
    </div>
</form>
@endsection
@push('scripts')
<script>
function prevImg(i){
    if(i.files && i.files[0]){
        var r = new FileReader();
        r.onload = function(e){
            var prev = document.getElementById('prev');
            prev.src = e.target.result;
            prev.style.display = 'block';
            var ph = document.getElementById('no-prev-placeholder');
            if(ph) ph.style.display = 'none';
        };
        r.readAsDataURL(i.files[0]);
    }
}

function prevMulti(input){
    var cont = document.getElementById('multiPrevContainer');
    cont.innerHTML = '';
    if(input.files && input.files.length > 0){
        cont.style.display = 'flex';
        Array.from(input.files).forEach(function(file){
            var reader = new FileReader();
            reader.onload = function(e){
                var col = document.createElement('div');
                col.className = 'col-6 col-sm-4 col-md-3';
                col.innerHTML = '<div style="border-radius:8px;overflow:hidden;border:1px solid #90CAF9;background:#fff">' +
                    '<img src="' + e.target.result + '" style="width:100%;height:85px;object-fit:cover;display:block">' +
                    '<div style="font-size:.72rem;padding:4px 6px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;color:#555">' + file.name + '</div>' +
                    '</div>';
                cont.appendChild(col);
            };
            reader.readAsDataURL(file);
        });
    } else {
        cont.style.display = 'none';
    }
}
</script>
@endpush
