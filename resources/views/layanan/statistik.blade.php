@extends('layouts.app')
@section('title', 'Statistik Pariwisata')

@section('content')
@include('partials.page-banner', ['title' => 'Statistik Pariwisata Samarinda', 'bg' => 'hero-bg-3.jpg', 'badge' => 'Data Pariwisata', 'sub' => 'Ringkasan data kunjungan dan perkembangan sektor pariwisata.', 'crumbs' => [['Statistik']]])

<section class="section-pad bg-soft">
<div class="container">
    <div class="alert alert-info" style="border-radius:12px;font-size:.86rem"><i class="bi bi-info-circle me-1"></i> Angka kunjungan di bawah adalah <strong>data contoh</strong>. Ganti dengan data resmi sebelum website dipublikasikan.</div>
    <div class="row g-4 mb-4">
        @foreach([['bi-graph-up-arrow','527.430','Kunjungan Wisatawan','#1565C0'],['bi-geo-alt-fill',$totalDestinasi,'Destinasi Terdaftar','#2E7D32'],['bi-calendar-event',$totalAgenda,'Agenda Event','#E65100'],['bi-people-fill','12.450','Tenaga Kerja Pariwisata','#6A1B9A']] as $i => $k)
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="{{ $i * 70 }}">
                <div class="box" style="border-top:4px solid {{ $k[3] }};margin:0">
                    <div style="font-size:2rem;color:{{ $k[3] }}"><i class="bi {{ $k[0] }}"></i></div>
                    <div style="font-size:1.8rem;font-weight:800;color:{{ $k[3] }};line-height:1.1">{{ $k[1] }}</div>
                    <div style="font-size:.85rem;color:var(--text-soft)">{{ $k[2] }}</div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row g-4">
        <div class="col-lg-7" data-aos="fade-right">
            <div class="box">
                <h4 class="box-title"><i class="bi bi-calendar3 me-2"></i>Kunjungan per Bulan</h4>
                @php $bulan = ['Jan'=>38,'Feb'=>35,'Mar'=>42,'Apr'=>40,'Mei'=>43,'Jun'=>53,'Jul'=>60,'Agu'=>56,'Sep'=>48,'Okt'=>45,'Nov'=>41,'Des'=>70]; $mx = max($bulan); @endphp
                <div style="display:flex;align-items:flex-end;gap:8px;height:240px;padding-top:10px">
                    @foreach($bulan as $b => $v)
                        <div style="flex:1;text-align:center">
                            <div style="font-size:.66rem;color:var(--text-soft)">{{ $v }}rb</div>
                            <div style="height:{{ round($v / $mx * 190) }}px;background:linear-gradient(to top,var(--primary),var(--primary-light));border-radius:8px 8px 3px 3px"></div>
                            <div style="font-size:.7rem;font-weight:700;color:var(--primary);margin-top:5px">{{ $b }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-lg-5" data-aos="fade-left">
            <div class="box">
                <h4 class="box-title"><i class="bi bi-trophy-fill me-2 text-warning"></i>Destinasi Paling Banyak Diulas</h4>
                @php $mxu = max(1, $top->max('ulasan')); @endphp
                @foreach($top as $t)
                    <div style="margin-bottom:14px">
                        <div style="display:flex;justify-content:space-between;font-size:.86rem;font-weight:600;margin-bottom:4px"><span>@if(str_starts_with($t->icon ?? '', 'bi-'))<i class="bi {{ $t->icon }} me-1 text-primary"></i>@endif{{ $t->nama }}</span><span style="color:var(--primary)">{{ number_format($t->ulasan) }}</span></div>
                        <div style="background:var(--border);border-radius:20px;height:8px;overflow:hidden"><div style="background:linear-gradient(90deg,var(--primary),var(--primary-light));height:100%;width:{{ round($t->ulasan / $mxu * 100) }}%"></div></div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
</section>
@endsection
