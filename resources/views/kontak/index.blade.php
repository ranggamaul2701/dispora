@extends('layouts.app')
@section('title', 'Kontak')

@section('content')
@include('partials.page-banner', [
    'title' => 'Hubungi Kami', 'bg' => 'hero-bg-3.jpg',
    'badge' => 'Layanan Informasi', 'sub' => 'Punya pertanyaan seputar wisata, event, atau kerja sama? Kami siap membantu.',
    'crumbs' => [['Kontak']],
])

@php $k = config('pariwisata.kontak'); @endphp
<section class="section-pad bg-soft">
<div class="container"><div class="row g-5">
    <div class="col-lg-5" data-aos="fade-right">
        <div class="section-eyebrow">Kontak</div>
        <h2 class="section-title" style="font-size:1.6rem">Bidang Pengembangan Pariwisata</h2>
        <div class="section-divider" style="margin:12px 0 24px"></div>
        @foreach([['bi-geo-alt-fill','Alamat',$k['alamat']],['bi-telephone-fill','Telepon',$k['telepon']],['bi-whatsapp','WhatsApp','+'.$k['wa']],['bi-envelope-fill','Email',$k['email']],['bi-clock-fill','Jam Layanan',$k['jam']]] as $r)
            <div class="info-item mb-3"><div class="info-icon" style="background:linear-gradient(135deg,var(--primary),var(--primary-light));color:#fff;border:none"><i class="bi {{ $r[0] }}"></i></div><div><div class="info-label">{{ $r[1] }}</div><div class="info-value">{{ $r[2] }}</div></div></div>
        @endforeach
    </div>
    <div class="col-lg-7" data-aos="fade-left">
        <div class="box" style="padding:32px">
            <h4 style="font-weight:800;color:var(--primary)">Kirim Pesan</h4>
            <p class="text-muted" style="font-size:.88rem">Pesan Anda akan diterima admin dan dibalas dalam 1–2 hari kerja.</p>
            @if($errors->any())<div class="alert-error-box"><ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif
            <form method="POST" action="{{ route('kontak.send') }}">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6"><label class="form-label-x">Nama Lengkap *</label><input class="form-input @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}" required></div>
                    <div class="col-md-6"><label class="form-label-x">Email *</label><input type="email" class="form-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required></div>
                    <div class="col-12"><label class="form-label-x">Subjek *</label><input class="form-input @error('subjek') is-invalid @enderror" name="subjek" value="{{ old('subjek') }}" required></div>
                    <div class="col-12"><label class="form-label-x">Pesan *</label><textarea rows="5" class="form-input @error('isi') is-invalid @enderror" name="isi" required style="resize:vertical">{{ old('isi') }}</textarea></div>
                    <div class="col-12"><button class="btn-primary-custom w-100" style="justify-content:center;padding:13px" type="submit"><i class="bi bi-send-fill"></i> Kirim Pesan</button></div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="mt-5" data-aos="fade-up">
    <h4 style="font-weight:800;color:var(--primary);margin-bottom:16px">Lokasi Kantor</h4>
    <div style="border-radius:var(--radius);overflow:hidden;box-shadow:var(--shadow)">
        <iframe src="https://www.google.com/maps?q={{ urlencode('Dinas Pemuda Olahraga dan Pariwisata Kota Samarinda') }}&output=embed" width="100%" height="380" style="border:0;display:block" allowfullscreen loading="lazy"></iframe>
    </div>
</div>
</div>
</section>
@endsection
