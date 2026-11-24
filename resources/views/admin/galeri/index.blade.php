@extends('admin.layout')
@section('title', 'Galeri Foto')
@section('content')
@include('admin.partials.head', ['icon' => 'bi-images', 'bg' => 'linear-gradient(135deg,#6A1B9A,#9C27B0)', 'judul' => 'Galeri Foto', 'sub' => 'Upload dan hapus foto di setiap album'])

<div class="dcard mb-4">
    <div class="dcard-h"><div class="dcard-t"><span class="ic" style="background:#F3E5F5"><i class="bi bi-cloud-arrow-up"></i></span> Upload Foto</div></div>
    <div class="dcard-b">
        <form method="POST" action="{{ route('admin.galeri.upload') }}" enctype="multipart/form-data" class="row g-3 align-items-end">
            @csrf
            <div class="col-md-4"><label class="f-label">Album tujuan</label><select class="f-input" name="album" required>@foreach($albums as $a)<option value="{{ $a['slug'] }}" @selected(old('album') === $a['slug'])>{{ $a['nama'] }} ({{ count($a['foto']) }})</option>@endforeach</select></div>
            <div class="col-md-5"><label class="f-label">Pilih foto (boleh lebih dari satu)</label><input type="file" class="f-input" name="foto[]" accept=".jpg,.jpeg,.png,.webp" multiple required></div>
            <div class="col-md-3"><button class="btn-d btn-purple w-100 justify-content-center" type="submit"><i class="bi bi-cloud-upload"></i> Upload</button></div>
        </form>
        <div class="f-hint">Maks 5 MB per foto. Foto akan diberi nama otomatis (foto-1, foto-2, …) dan langsung tampil di website.</div>
    </div>
</div>

<div class="row g-4">
@foreach($albums as $a)
    <div class="col-12">
        <div class="dcard">
            <div class="dcard-h">
                <div class="dcard-t"><span class="ic" style="background:#F3E5F5"><i class="bi {{ str_starts_with($a['icon'], 'bi-') ? $a['icon'] : 'bi-images' }}"></i></span> {{ $a['nama'] }} <span class="pill purple">{{ count($a['foto']) }} foto</span></div>
                <a href="{{ route('galeri.album', $a['slug']) }}" target="_blank" class="pill blue">Lihat di website →</a>
            </div>
            <div class="dcard-b">
                @if(count($a['foto']))
                    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(130px,1fr));gap:12px">
                        @foreach($a['foto'] as $f)
                            <div style="position:relative;border-radius:11px;overflow:hidden;aspect-ratio:1;background:var(--sky)">
                                <img src="{{ $f['url'] }}" alt="" style="width:100%;height:100%;object-fit:cover" loading="lazy">
                                <div style="position:absolute;left:0;right:0;bottom:0;background:linear-gradient(transparent,rgba(0,0,0,.7));padding:16px 6px 5px;color:#fff;font-size:.66rem;text-align:center;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">{{ $f['file'] }}</div>
                                <form method="POST" action="{{ route('admin.galeri.destroy', [$a['slug'], $f['file']]) }}" data-confirm="Hapus foto {{ $f['file'] }} dari album {{ $a['nama'] }}?" style="position:absolute;top:6px;right:6px">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-i bi-del" style="width:28px;height:28px" title="Hapus"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-4" style="color:#90A4AE"><div style="font-size:2rem;color:#90A4AE;margin-bottom:6px"><i class="bi bi-folder2-open"></i></div>Album ini belum memiliki foto.</div>
                @endif
            </div>
        </div>
    </div>
@endforeach
</div>
@endsection
