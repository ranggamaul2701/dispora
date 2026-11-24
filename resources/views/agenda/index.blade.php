@extends('layouts.app')
@section('title', 'Agenda Pariwisata')

@section('content')
@include('partials.page-banner', [
    'title' => 'Agenda & Event Wisata', 'bg' => 'hero-bg-3.jpg',
    'badge' => 'Jadwal Kegiatan', 'sub' => 'Rencanakan kunjungan Anda sesuai event dan festival pariwisata Kota Samarinda.',
    'crumbs' => [['Agenda']],
])

<section class="section-pad bg-soft">
    <div class="container">
        <div class="row g-3 mb-4 align-items-center" data-aos="fade-up">
            <div class="col-lg-5">
                <form method="GET" class="search-bar">
                    @if($kategori)<input type="hidden" name="kategori" value="{{ $kategori }}">@endif
                    <input class="form-input" type="text" name="q" value="{{ $q }}" placeholder="Cari agenda atau lokasi...">
                    <button class="btn-accent" type="submit"><i class="bi bi-search"></i></button>
                </form>
            </div>
            <div class="col-lg-7 d-flex flex-wrap gap-2 align-items-center">
                @foreach($kategoriList as $kat)
                    <a class="chip {{ ($kategori ?: 'Semua') === $kat ? 'active' : '' }}" href="{{ route('agenda.index', array_filter(['kategori' => $kat === 'Semua' ? null : $kat, 'q' => $q])) }}">{{ $kat }}</a>
                @endforeach
                <a class="btn-accent ms-lg-auto" href="{{ route('kalender.index') }}"><i class="bi bi-calendar2-check"></i> Tampilan Kalender</a>
            </div>
        </div>

        <div class="row g-4">
            @forelse($agenda as $i => $a)
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ ($i % 3) * 70 }}">
                    <div class="dest-card">
                        <div class="dest-card-thumb">
                            <img src="{{ media_url($a->gambar, 'agenda') }}" alt="{{ $a->nama }}" loading="lazy">
                            <span class="dest-badge">{{ $a->kategori }}</span>
                            <span class="rating-badge" style="background:{{ $a->isPast() ? 'rgba(84,110,122,.9)' : 'rgba(46,125,50,.92)' }}">{{ $a->isPast() ? 'Selesai' : 'Akan datang' }}</span>
                        </div>
                        <div class="card-body-x">
                            <h5>@if(str_starts_with($a->icon ?? '', 'bi-'))<i class="bi {{ $a->icon }} me-1 text-primary"></i>@endif{{ $a->nama }}</h5>
                            <div class="meta-line"><span><i class="bi bi-calendar3"></i> {{ $a->tanggal_mulai->translatedFormat('d M Y') }}@if($a->isMultiDay()) – {{ $a->tanggal_selesai->translatedFormat('d M Y') }}@endif</span></div>
                            @if($a->jam_mulai)<div class="meta-line"><span><i class="bi bi-clock"></i> {{ $a->jam_mulai }} WITA</span></div>@endif
                            <div class="meta-line"><span><i class="bi bi-geo-alt"></i> {{ $a->lokasi }}</span></div>
                            <p class="mt-2">{{ \Illuminate\Support\Str::limit($a->deskripsi, 95) }}</p>
                            <a href="{{ route('agenda.show', $a->id) }}" class="btn-accent w-100">Lihat Detail <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12"><div class="box text-center py-5"><div style="font-size:2.5rem;color:#90A4AE;margin-bottom:8px"><i class="bi bi-calendar-x"></i></div><h5 style="color:var(--primary)">Agenda tidak ditemukan</h5><a href="{{ route('agenda.index') }}" class="btn-accent mt-2">Lihat Semua</a></div></div>
            @endforelse
        </div>
        @if($agenda->hasPages())<div class="mt-5 d-flex justify-content-center">{{ $agenda->links() }}</div>@endif
    </div>
</section>
@endsection
