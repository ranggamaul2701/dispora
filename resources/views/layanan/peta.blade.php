@extends('layouts.app')
@section('title', 'Peta Wisata')

@section('content')
@include('partials.page-banner', ['title' => 'Peta Wisata Samarinda', 'bg' => 'hero-bg-1.jpg', 'badge' => 'Navigasi Wisata', 'sub' => 'Pilih destinasi di daftar untuk melihat lokasinya di peta.', 'crumbs' => [['Peta Wisata']]])

<section class="section-pad bg-soft">
<div class="container"><div class="row g-4">
    <div class="col-lg-8" data-aos="fade-right">
        <div style="border-radius:var(--radius);overflow:hidden;box-shadow:var(--shadow);background:#fff">
            <iframe id="mapFrame" src="https://www.google.com/maps?q=Samarinda&output=embed" width="100%" height="540" style="border:0;display:block" allowfullscreen loading="lazy"></iframe>
        </div>
    </div>
    <div class="col-lg-4" data-aos="fade-left">
        <div class="box" style="padding:0;overflow:hidden;margin:0">
            <div style="background:var(--primary);color:#fff;padding:16px 20px;font-weight:800"><i class="bi bi-geo-alt-fill me-2"></i>Destinasi Wisata ({{ $destinasi->count() }})</div>
            <div style="max-height:484px;overflow-y:auto;padding:12px">
                @foreach($destinasi as $d)
                    <div class="peta-item" data-q="{{ $d->nama }} {{ $d->alamat }}" style="display:flex;gap:12px;padding:11px;border:1.5px solid var(--border);border-radius:12px;margin-bottom:9px;cursor:pointer;transition:.2s;align-items:center">
                        <img src="{{ media_url($d->gambar, 'destinasi') }}" alt="" style="width:52px;height:52px;object-fit:cover;border-radius:10px">
                        <div style="flex:1;min-width:0">
                            <div style="font-weight:800;color:var(--primary);font-size:.88rem;line-height:1.3">{{ $d->nama }}</div>
                            <div style="font-size:.74rem;color:var(--text-soft)">{{ $d->kategori }} • {{ $d->harga }}</div>
                        </div>
                        <a href="{{ route('destinasi.show', $d->slug) }}" title="Detail" onclick="event.stopPropagation()" style="color:var(--accent-dark)"><i class="bi bi-box-arrow-up-right"></i></a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div></div>
</section>
@endsection

@push('scripts')
<script>
document.querySelectorAll('.peta-item').forEach(function (el) {
    el.addEventListener('click', function () {
        document.querySelectorAll('.peta-item').forEach(function (x) { x.style.background = '#fff'; x.style.borderColor = 'var(--border)'; });
        el.style.background = 'var(--sky)'; el.style.borderColor = 'var(--primary)';
        document.getElementById('mapFrame').src = 'https://www.google.com/maps?q=' + encodeURIComponent(el.dataset.q + ' Samarinda') + '&output=embed';
    });
});
</script>
@endpush
