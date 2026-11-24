@extends('layouts.app')
@section('title', 'Destinasi Wisata')

@section('content')
@include('partials.page-banner', [
    'title' => 'Destinasi Wisata Samarinda', 'bg' => 'hero-bg-1.jpg',
    'badge' => 'Destinasi Unggulan', 'sub' => 'Temukan tempat wisata terbaik di Kota Tepian lengkap dengan harga tiket, jam buka, dan lokasi.',
    'crumbs' => [['Destinasi']],
])

<section class="section-pad bg-soft">
    <div class="container">
        <div class="row g-3 mb-4 align-items-center" data-aos="fade-up">
            <div class="col-lg-5">
                <form method="GET" class="search-bar">
                    @if($kategori)<input type="hidden" name="kategori" value="{{ $kategori }}">@endif
                    <input class="form-input" type="text" name="q" value="{{ $q }}" placeholder="Cari destinasi...">
                    <button class="btn-accent" type="submit"><i class="bi bi-search"></i></button>
                </form>
            </div>
            <div class="col-lg-7 d-flex flex-wrap gap-2">
                @foreach($kategoriList as $kat)
                    <a class="chip {{ ($kategori ?: 'Semua') === $kat ? 'active' : '' }}" href="{{ route('destinasi.index', array_filter(['kategori' => $kat === 'Semua' ? null : $kat, 'q' => $q])) }}">{{ $kat }}</a>
                @endforeach
            </div>
        </div>

        <p class="text-muted mb-4" style="font-size:.88rem"><strong>{{ $destinasi->total() }}</strong> destinasi ditemukan</p>

        <div class="row g-4">
            @forelse($destinasi as $i => $d)
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ ($i % 3) * 70 }}">
                    @include('partials.card-destinasi', ['d' => $d])
                </div>
            @empty
                <div class="col-12"><div class="box text-center py-5"><div style="font-size:2.5rem;color:#90A4AE;margin-bottom:8px"><i class="bi bi-search"></i></div><h5 style="color:var(--primary)">Destinasi tidak ditemukan</h5><a href="{{ route('destinasi.index') }}" class="btn-accent mt-2">Tampilkan Semua</a></div></div>
            @endforelse
        </div>

        @if($destinasi->hasPages())<div class="mt-5 d-flex justify-content-center">{{ $destinasi->links() }}</div>@endif
    </div>
</section>
@endsection
