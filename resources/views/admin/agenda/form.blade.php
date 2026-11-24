@extends('admin.layout')
@section('title', $item ? 'Edit Agenda' : 'Tambah Agenda')
@section('content')
@include('admin.partials.head', ['icon' => 'bi-calendar-event', 'bg' => 'linear-gradient(135deg,#E65100,#FF7043)', 'judul' => $item ? 'Edit Agenda' : 'Tambah Agenda Baru', 'sub' => $item ? 'Perbarui informasi agenda' : 'Tambahkan agenda atau event baru', 'kembali' => route('admin.agenda.index')])

<form method="POST" enctype="multipart/form-data" action="{{ $item ? route('admin.agenda.update', $item) : route('admin.agenda.store') }}">
    @csrf @if($item) @method('PUT') @endif
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="dcard">
                <div class="dcard-h"><div class="dcard-t"><span class="ic" style="background:#FBE9E7"><i class="bi bi-card-checklist"></i></span> Detail Agenda</div></div>
                <div class="dcard-b"><div class="row g-3">
                    <div class="col-md-10"><label class="f-label">Nama Agenda *</label><input class="f-input" name="nama" value="{{ old('nama', $item?->nama) }}" required></div>
                    <div class="col-md-2"><label class="f-label">Ikon</label><input class="f-input text-center" name="icon" value="{{ old('icon', $item?->icon ?? 'bi-calendar-event') }}"></div>
                    <div class="col-12"><label class="f-label">Lokasi *</label><input class="f-input" name="lokasi" value="{{ old('lokasi', $item?->lokasi) }}" required></div>
                    <div class="col-md-4"><label class="f-label">Tanggal Mulai *</label><input type="date" class="f-input" name="tanggal_mulai" value="{{ old('tanggal_mulai', $item?->tanggal_mulai?->format('Y-m-d')) }}" required></div>
                    <div class="col-md-4"><label class="f-label">Tanggal Selesai</label><input type="date" class="f-input" name="tanggal_selesai" value="{{ old('tanggal_selesai', $item?->tanggal_selesai?->format('Y-m-d')) }}"><div class="f-hint">Kosongkan jika 1 hari.</div></div>
                    <div class="col-md-4"><label class="f-label">Jam Mulai</label><input class="f-input" name="jam_mulai" value="{{ old('jam_mulai', $item?->jam_mulai ?? '08.00') }}" placeholder="08.00"></div>
                    <div class="col-12"><label class="f-label">Deskripsi *</label><textarea class="f-input" rows="6" name="deskripsi" required>{{ old('deskripsi', $item?->deskripsi) }}</textarea></div>
                    <div class="col-md-6"><label class="f-label">Penyelenggara</label><input class="f-input" name="penyelenggara" value="{{ old('penyelenggara', $item?->penyelenggara) }}"></div>
                    <div class="col-md-6"><label class="f-label">Kontak</label><input class="f-input" name="kontak" value="{{ old('kontak', $item?->kontak) }}"></div>
                </div></div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="dcard mb-4">
                <div class="dcard-h"><div class="dcard-t"><span class="ic" style="background:#FBE9E7"><i class="bi bi-camera"></i></span> Foto Agenda</div></div>
                <div class="dcard-b">
                    <div style="position:relative;border-radius:11px;overflow:hidden;border:2px solid var(--sky);background:#EBF3FC;margin-bottom:12px;min-height:160px;display:flex;align-items:center;justify-content:center">
                        <img class="img-prev" id="prev"
                             src="{{ $item?->gambar ? media_url($item->gambar, 'agenda') : '' }}"
                             alt="Foto Agenda"
                             style="margin-bottom:0;border:none;background:transparent;width:100%;height:180px;object-fit:cover;{{ $item?->gambar ? 'display:block' : 'display:none' }}"
                             onerror="this.style.display='none';document.getElementById('no-prev-placeholder').style.display='flex'">
                        <div id="no-prev-placeholder" style="{{ $item?->gambar ? 'display:none;' : 'display:flex;' }}flex-direction:column;align-items:center;justify-content:center;padding:30px 15px;color:var(--text-soft)">
                            <i class="bi bi-camera" style="font-size:2.5rem;color:#FFAB91;display:block;margin-bottom:6px"></i>
                            <span style="font-size:.85rem;font-weight:600">Belum ada foto agenda</span>
                        </div>
                    </div>
                    <label class="f-label mb-1">Upload / Ganti Foto</label>
                    <input type="file" class="f-input" name="foto" accept=".jpg,.jpeg,.png,.webp" onchange="prevImg(this)">
                    <div class="f-hint">JPG / PNG / WebP, maks 5 MB.</div>
                </div>
            </div>
            <div class="dcard mb-4">
                <div class="dcard-h"><div class="dcard-t"><span class="ic" style="background:#FBE9E7"><i class="bi bi-gear-fill"></i></span> Pengaturan</div></div>
                <div class="dcard-b d-flex flex-column gap-3">
                    <div><label class="f-label">Kategori *</label><select class="f-input" name="kategori" required>@foreach(config('pariwisata.kategori_agenda') as $k)<option value="{{ $k }}" @selected(old('kategori', $item?->kategori) === $k)>{{ $k }}</option>@endforeach</select></div>
                    <label class="switch-box"><input type="hidden" name="is_published" value="0"><input type="checkbox" name="is_published" value="1" @checked(old('is_published', $item?->is_published ?? true))><div><div style="font-weight:700;color:var(--primary);font-size:.88rem">Tampilkan di website</div><small style="color:var(--text-soft)">Matikan untuk menyimpan sebagai draft</small></div></label>
                </div>
            </div>
            <div class="d-grid gap-2">
                <button class="btn-d btn-orange justify-content-center" style="padding:13px" type="submit"><i class="bi bi-check-circle-fill"></i> {{ $item ? 'Simpan Perubahan' : 'Tambah Agenda' }}</button>
                <a href="{{ route('admin.agenda.index') }}" class="btn-d btn-light-d justify-content-center"><i class="bi bi-x-circle"></i> Batal</a>
            </div>
        </div>
    </div>
</form>
@endsection
@push('scripts')<script>function prevImg(i){ if(i.files&&i.files[0]){ var r=new FileReader(); r.onload=function(e){ var p=document.getElementById('prev'); p.src=e.target.result; p.style.display='block'; var ph=document.getElementById('no-prev-placeholder'); if(ph) ph.style.display='none'; }; r.readAsDataURL(i.files[0]); } }</script>@endpush
