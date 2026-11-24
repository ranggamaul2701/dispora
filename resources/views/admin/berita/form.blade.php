@extends('admin.layout')
@section('title', $item ? 'Edit Berita' : 'Tambah Berita')
@section('content')
@include('admin.partials.head', ['icon' => 'bi-newspaper', 'bg' => 'linear-gradient(135deg,#2E7D32,#43A047)', 'judul' => $item ? 'Edit Berita' : 'Tambah Berita Baru', 'sub' => $item ? 'Perbarui berita yang sudah ada' : 'Tulis berita baru untuk website', 'kembali' => route('admin.berita.index')])

<form method="POST" enctype="multipart/form-data" action="{{ $item ? route('admin.berita.update', $item) : route('admin.berita.store') }}">
    @csrf @if($item) @method('PUT') @endif
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="dcard">
                <div class="dcard-h"><div class="dcard-t"><span class="ic" style="background:#E8F5E9"><i class="bi bi-pencil-square"></i></span> Konten Berita</div></div>
                <div class="dcard-b d-flex flex-column gap-3">
                    <div><label class="f-label">Judul Berita *</label><input class="f-input @error('judul') is-invalid @enderror" name="judul" value="{{ old('judul', $item?->judul) }}" required></div>
                    <div><label class="f-label">Ringkasan * <small style="font-weight:500;color:var(--text-soft)">(tampil di daftar berita, maks 500 karakter)</small></label><textarea class="f-input @error('ringkasan') is-invalid @enderror" rows="3" name="ringkasan" maxlength="500" required>{{ old('ringkasan', $item?->ringkasan) }}</textarea></div>
                    <div><label class="f-label">Isi Berita *</label><textarea class="f-input @error('konten') is-invalid @enderror" rows="14" name="konten" required>{{ old('konten', $item?->konten) }}</textarea><div class="f-hint">Tag HTML seperti &lt;p&gt;, &lt;strong&gt;, &lt;ul&gt;, &lt;li&gt; boleh digunakan.</div></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="dcard mb-4">
                <div class="dcard-h"><div class="dcard-t"><span class="ic" style="background:#E8F5E9"><i class="bi bi-gear-fill"></i></span> Pengaturan</div></div>
                <div class="dcard-b d-flex flex-column gap-3">
                    <div><label class="f-label">Kategori *</label><select class="f-input" name="kategori" required>@foreach(config('pariwisata.kategori_berita') as $k)<option value="{{ $k }}" @selected(old('kategori', $item?->kategori) === $k)>{{ $k }}</option>@endforeach</select></div>
                    <div class="row g-2">
                        <div class="col-4"><label class="f-label">Ikon</label><input class="f-input text-center" name="icon" value="{{ old('icon', $item?->icon ?? 'bi-newspaper') }}"></div>
                        <div class="col-8"><label class="f-label">Views</label><input type="number" min="0" class="f-input" name="views" value="{{ old('views', $item?->views ?? 0) }}"></div>
                    </div>
                    <label class="switch-box"><input type="hidden" name="is_published" value="0"><input type="checkbox" name="is_published" value="1" @checked(old('is_published', $item?->is_published ?? true))><div><div style="font-weight:700;color:var(--primary);font-size:.88rem">Terbitkan berita</div><small style="color:var(--text-soft)">Matikan untuk menyimpan sebagai draft</small></div></label>
                </div>
            </div>
            <div class="dcard mb-4">
                <div class="dcard-h"><div class="dcard-t"><span class="ic" style="background:#E8F5E9"><i class="bi bi-image"></i></span> Gambar Berita</div></div>
                <div class="dcard-b">
                    <div style="position:relative;border-radius:11px;overflow:hidden;border:2px solid var(--sky);background:#EBF3FC;margin-bottom:12px;min-height:160px;display:flex;align-items:center;justify-content:center">
                        <img class="img-prev" id="prev"
                             src="{{ $item?->gambar ? media_url($item->gambar, 'berita') : '' }}"
                             alt="Gambar Berita"
                             style="margin-bottom:0;border:none;background:transparent;width:100%;height:180px;object-fit:cover;{{ $item?->gambar ? 'display:block' : 'display:none' }}"
                             onerror="this.style.display='none';document.getElementById('no-prev-placeholder').style.display='flex'">
                        <div id="no-prev-placeholder" style="{{ $item?->gambar ? 'display:none;' : 'display:flex;' }}flex-direction:column;align-items:center;justify-content:center;padding:30px 15px;color:var(--text-soft)">
                            <i class="bi bi-image" style="font-size:2.5rem;color:#90CAF9;display:block;margin-bottom:6px"></i>
                            <span style="font-size:.85rem;font-weight:600">Belum ada gambar berita</span>
                        </div>
                    </div>
                    <label class="f-label mb-1">Upload / Ganti Gambar</label>
                    <input type="file" class="f-input" name="foto" accept=".jpg,.jpeg,.png,.webp" onchange="prevImg(this)">
                    <div class="f-hint">JPG / PNG / WebP, maks 5 MB.</div>
                </div>
            </div>
            <div class="d-grid gap-2">
                <button class="btn-d btn-green justify-content-center" style="padding:13px" type="submit"><i class="bi bi-check-circle-fill"></i> {{ $item ? 'Simpan Perubahan' : 'Simpan Berita' }}</button>
                <a href="{{ route('admin.berita.index') }}" class="btn-d btn-light-d justify-content-center"><i class="bi bi-x-circle"></i> Batal</a>
            </div>
        </div>
    </div>
</form>
@endsection
@push('scripts')<script>function prevImg(i){ if(i.files&&i.files[0]){ var r=new FileReader(); r.onload=function(e){ var p=document.getElementById('prev'); p.src=e.target.result; p.style.display='block'; var ph=document.getElementById('no-prev-placeholder'); if(ph) ph.style.display='none'; }; r.readAsDataURL(i.files[0]); } }</script>@endpush
