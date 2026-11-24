@extends('layouts.app')
@section('title', 'Berita Pariwisata')

@section('content')
@include('partials.page-banner', [
    'title' => 'Berita & Informasi Pariwisata', 'bg' => 'hero-bg-2.jpg',
    'badge' => 'Informasi Terkini', 'sub' => 'Kabar terbaru seputar destinasi, event, dan program pariwisata Kota Samarinda.',
    'crumbs' => [['Berita']],
])

<section class="section-pad bg-soft">
    <div class="container">
        <div class="row g-3 mb-4 align-items-center" data-aos="fade-up">
            <div class="col-lg-5">
                <form method="GET" class="search-bar">
                    @if($kategori)<input type="hidden" name="kategori" value="{{ $kategori }}">@endif
                    <input class="form-input" type="text" name="q" value="{{ $q }}" placeholder="Cari berita...">
                    <button class="btn-accent" type="submit"><i class="bi bi-search"></i></button>
                </form>
            </div>
            <div class="col-lg-7 d-flex flex-wrap gap-2">
                @foreach($kategoriList as $kat)
                    <a class="chip {{ ($kategori ?: 'Semua') === $kat ? 'active' : '' }}" href="{{ route('berita.index', array_filter(['kategori' => $kat === 'Semua' ? null : $kat, 'q' => $q])) }}">{{ $kat }}</a>
                @endforeach
            </div>
        </div>

        <div class="row g-4">
            @forelse($berita as $i => $b)
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ ($i % 3) * 70 }}">@include('partials.card-berita', ['b' => $b])</div>
            @empty
                <div class="col-12"><div class="box text-center py-5"><div style="font-size:2.5rem;color:#90A4AE;margin-bottom:8px"><i class="bi bi-inbox"></i></div><h5 style="color:var(--primary)">Berita tidak ditemukan</h5><a href="{{ route('berita.index') }}" class="btn-accent mt-2">Lihat Semua</a></div></div>
            @endforelse
        </div>
        @if($berita->hasPages())<div class="mt-5 d-flex justify-content-center">{{ $berita->links() }}</div>@endif
    </div>
</section>
@endsection
