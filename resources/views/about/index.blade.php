@extends('layouts.app')
@section('title', 'Tentang Kami')

@section('content')
@include('partials.page-banner', [
    'title' => 'Tentang Bidang Pariwisata', 'bg' => 'hero-bg-2.jpg',
    'badge' => 'Profil Dinas', 'sub' => 'Mengenal lebih dekat Bidang Pengembangan Pariwisata Disporapar Kota Samarinda.',
    'crumbs' => [['Tentang']],
])

<div style="background:var(--primary);padding:20px 0">
    <div class="container"><div class="row g-3 text-center">
        @foreach([['25+','Tahun Berdiri'],['80+','Destinasi Wisata'],['150+','Event / Tahun'],['500K+','Wisatawan / Tahun']] as $s)
            <div class="col-6 col-md-3"><div style="font-size:1.7rem;font-weight:800;color:var(--accent);line-height:1">{{ $s[0] }}</div><div style="font-size:.78rem;color:rgba(255,255,255,.75)">{{ $s[1] }}</div></div>
        @endforeach
    </div></div>
</div>

<section class="section-pad">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-5" data-aos="fade-right">
                <div class="tentang-img-wrap">
                    <img src="{{ asset('images/tentang/gedung-dinas.jpg') }}" alt="Gedung Disporapar">
                    <div class="tentang-badge"><span class="num">25+</span><span class="txt">Tahun<br>Melayani</span></div>
                </div>
            </div>
            <div class="col-lg-7" data-aos="fade-left">
                <div class="section-eyebrow">Profil Bidang</div>
                <h2 class="section-title">Bidang Pengembangan Pariwisata<br>Disporapar Kota Samarinda</h2>
                <p class="text-muted">Bidang Pengembangan Pariwisata adalah unit kerja di bawah Dinas Pemuda, Olahraga, dan Pariwisata Kota Samarinda yang bertanggung jawab dalam pengembangan, promosi, dan pengelolaan sektor pariwisata.</p>
                <p class="text-muted mb-4">Kami berkomitmen menjadikan Samarinda destinasi unggulan Kalimantan Timur dengan memanfaatkan potensi alam, budaya, dan kearifan lokal Kota Tepian.</p>
                <div class="row g-3">
                    @php $k = config('pariwisata.kontak'); @endphp
                    @foreach([['bi-building','Kantor',$k['alamat']],['bi-telephone','Telepon',$k['telepon']],['bi-envelope','Email',$k['email']],['bi-clock','Jam Kerja',$k['jam']]] as $r)
                        <div class="col-sm-6"><div class="info-item" style="background:var(--light-bg);border:1px solid var(--border);border-radius:12px;padding:14px">
                            <div class="info-icon"><i class="bi {{ $r[0] }}"></i></div>
                            <div><div class="info-label">{{ $r[1] }}</div><div class="info-value" style="font-size:.84rem">{{ $r[2] }}</div></div>
                        </div></div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-pad bg-soft">
    <div class="container">
        <div class="section-title-wrap" data-aos="fade-up"><div class="section-eyebrow">Arah & Tujuan</div><h2 class="section-title">Visi & Misi</h2><div class="section-divider"></div></div>
        <div class="row g-4">
            <div class="col-lg-5" data-aos="fade-right">
                <div style="background:var(--primary);border-radius:var(--radius);padding:36px;height:100%">
                    <div style="font-size:2.2rem;color:var(--accent);margin-bottom:8px"><i class="bi bi-bullseye"></i></div>
                    <h4 style="color:var(--accent);font-weight:800;margin:10px 0 14px">VISI</h4>
                    <p style="color:rgba(255,255,255,.9);line-height:1.8;font-style:italic;margin:0">"Terwujudnya Pariwisata Kota Samarinda yang Berkualitas, Berdaya Saing, dan Berkelanjutan sebagai Destinasi Wisata Unggulan Kalimantan Timur."</p>
                </div>
            </div>
            <div class="col-lg-7" data-aos="fade-left">
                <div class="box" style="height:100%;margin:0">
                    <h4 style="color:var(--primary);font-weight:800;margin-bottom:18px"><i class="bi bi-list-check me-2"></i>MISI</h4>
                    @foreach(['Mengembangkan destinasi wisata alam, budaya, dan buatan yang berkualitas dan berdaya saing tinggi.','Meningkatkan promosi pariwisata Kota Samarinda melalui berbagai media dan event wisata.','Mendorong pertumbuhan ekonomi kreatif berbasis pariwisata dan kearifan lokal.','Meningkatkan kualitas SDM pelaku pariwisata Kota Samarinda.','Membangun kemitraan strategis dengan pelaku industri pariwisata.'] as $i => $m)
                        <div style="display:flex;gap:14px;margin-bottom:13px;align-items:flex-start">
                            <div style="min-width:28px;height:28px;background:var(--accent);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:.78rem;font-weight:800;color:var(--primary-dark)">{{ $i + 1 }}</div>
                            <p style="margin:0;font-size:.92rem">{{ $m }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-pad">
    <div class="container">
        <div class="section-title-wrap" data-aos="fade-up"><div class="section-eyebrow">Fungsi & Peran</div><h2 class="section-title">Tugas Pokok</h2><div class="section-divider"></div></div>
        <div class="row g-4">
            @foreach([['bi-compass','Pengembangan Destinasi','Identifikasi, perencanaan, dan pengembangan potensi destinasi wisata baru yang berkualitas.'],['bi-megaphone','Promosi Pariwisata','Promosi lewat media digital, pameran, festival, dan kerja sama media.'],['bi-palette','Ekonomi Kreatif','Pembinaan UMKM dan industri kreatif berbasis budaya lokal Samarinda.'],['bi-handshake','Kemitraan & Investasi','Fasilitasi investasi dan kemitraan dengan sektor swasta dan komunitas.']] as $i => $t)
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="{{ $i * 80 }}">
                    <div class="box text-center" style="height:100%;margin:0;border-bottom:4px solid transparent;transition:.25s" onmouseover="this.style.borderBottomColor='var(--accent)';this.style.transform='translateY(-5px)'" onmouseout="this.style.borderBottomColor='transparent';this.style.transform=''">
                        <div style="width:64px;height:64px;background:linear-gradient(135deg,var(--primary),var(--primary-light));border-radius:16px;display:flex;align-items:center;justify-content:center;margin:0 auto 14px;font-size:1.6rem;color:#fff"><i class="bi {{ $t[0] }}"></i></div>
                        <h5 style="font-weight:800;color:var(--primary);font-size:.97rem">{{ $t[1] }}</h5>
                        <p style="color:var(--text-soft);font-size:.86rem;margin:0">{{ $t[2] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="section-pad bg-soft">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <img src="{{ asset('images/ekraf/ekraf-utama.jpg') }}" alt="Ekonomi Kreatif" style="width:100%;height:340px;object-fit:cover;border-radius:var(--radius);box-shadow:var(--shadow)">
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <div class="section-eyebrow">Ekonomi Kreatif</div>
                <h2 class="section-title">Menumbuhkan Pelaku Kreatif Lokal</h2>
                <p class="text-muted">Kami membina pengrajin, pelaku UMKM, dan komunitas kreatif agar produk khas Samarinda — tenun, manik, ukiran kayu, hingga kuliner — mampu menembus pasar yang lebih luas dan menjadi daya tarik wisata.</p>
                <a href="{{ route('galeri.album', 'ekraf') }}" class="btn-accent">Lihat Galeri Ekraf <i class="bi bi-arrow-right"></i></a>
            </div>
        </div>
    </div>
</section>

<section class="section-pad">
    <div class="container">
        <div class="section-title-wrap" data-aos="fade-up"><div class="section-eyebrow">Struktur Organisasi</div><h2 class="section-title">Tim Bidang Pariwisata</h2><div class="section-divider"></div></div>
        <div class="row g-4 justify-content-center">
            @foreach($struktur as $i => $s)
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ ($i % 3) * 80 }}">
                    <div class="pejabat-card">
                        @if($s['foto'] && is_file(public_path('images/pejabat/'.$s['foto'])))
                            <img class="pejabat-foto" src="{{ asset('images/pejabat/'.$s['foto']) }}" alt="{{ $s['nama'] }}">
                        @else
                            <div class="pejabat-ph"><i class="bi bi-person-fill"></i></div>
                        @endif
                        <span class="badge-soft blue mb-2" style="text-transform:uppercase;letter-spacing:.05em">{{ $s['jabatan'] }}</span>
                        <h6 style="font-weight:800;color:var(--primary);margin:0">{{ $s['nama'] }}</h6>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
