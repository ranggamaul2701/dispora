@extends('layouts.app')
@section('title', $q !== '' ? 'Pencarian: ' . $q : 'Pencarian')

@section('content')
@include('partials.page-banner', [
    'title' => 'Pencarian', 'bg' => 'hero-bg-1.jpg',
    'sub' => $q !== '' ? 'Hasil untuk "' . $q . '"' : 'Cari destinasi, berita, dan agenda sekaligus.',
    'extra' => view('search.form', ['q' => $q])->render(),
    'crumbs' => [['Pencarian']],
])

<section class="section-pad bg-soft">
<div class="container">
@php $total = $destinasi->count() + $berita->count() + $agenda->count(); @endphp

@if($q === '')
    <div class="text-center py-4">
        <div style="font-size:3rem;color:var(--primary);margin-bottom:12px"><i class="bi bi-search"></i></div>
        <h5 style="color:var(--primary);font-weight:800">Ketik kata kunci untuk mulai mencari</h5>
        <p class="text-muted">Pencarian populer:</p>
        @foreach(['Mahakam','Islamic Center','Kebun Raya','Festival','Kuliner','Museum'] as $s)<a class="chip" href="{{ route('search', ['q' => $s]) }}">{{ $s }}</a> @endforeach
    </div>
@elseif($total === 0)
    <div class="box text-center py-5"><div style="font-size:3rem;color:#90A4AE;margin-bottom:12px"><i class="bi bi-search"></i></div><h5 style="color:var(--primary);font-weight:800">Tidak ada hasil untuk "{{ $q }}"</h5><p class="text-muted mb-0">Coba kata kunci lain, misalnya "Mahakam", "Festival", atau "Kuliner".</p></div>
@else
    <p class="mb-4"><strong style="color:var(--primary)">{{ $total }}</strong> hasil ditemukan untuk <strong>"{{ $q }}"</strong></p>

    @if($destinasi->count())
        <h5 class="box-title"><i class="bi bi-geo-alt-fill me-2 text-primary"></i>Destinasi ({{ $destinasi->count() }})</h5>
        <div class="row g-4 mb-5">@foreach($destinasi as $d)<div class="col-lg-4 col-md-6">@include('partials.card-destinasi', ['d' => $d])</div>@endforeach</div>
    @endif
    @if($berita->count())
        <h5 class="box-title"><i class="bi bi-newspaper me-2 text-success"></i>Berita ({{ $berita->count() }})</h5>
        <div class="row g-4 mb-5">@foreach($berita as $b)<div class="col-lg-4 col-md-6">@include('partials.card-berita', ['b' => $b])</div>@endforeach</div>
    @endif
    @if($agenda->count())
        <h5 class="box-title"><i class="bi bi-calendar-event me-2 text-warning"></i>Agenda ({{ $agenda->count() }})</h5>
        <div class="row">@foreach($agenda as $a)<div class="col-lg-6">
            <a href="{{ route('agenda.show', $a->id) }}" class="event-card">
                <div class="event-date-box"><span class="day">{{ $a->tanggal_mulai->format('d') }}</span><span class="month">{{ $a->tanggal_mulai->translatedFormat('M') }}</span></div>
                <div class="event-info"><h6>{{ $a->nama }}</h6><div class="event-meta"><i class="bi bi-geo-alt"></i> {{ $a->lokasi }}</div></div>
            </a></div>@endforeach</div>
    @endif
@endif
</div>
</section>
@endsection
