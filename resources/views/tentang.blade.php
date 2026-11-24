@extends('layouts.app')

@section('title', 'Tentang Kami')

@section('content')

{{-- PAGE BANNER --}}
@include('partials.page-banner', [
    'title' => 'Tentang Kami',
    'breadcrumb' => 'Tentang'
])


{{-- =========================================================
    PENGEMBANGAN PARIWISATA
========================================================= --}}
<section class="tourism-intro py-5">
    <div class="container py-lg-4">

        <div class="row align-items-center g-5">

            <div class="col-lg-6" data-aos="fade-right">

                <span class="section-badge">
                    TIM PENGEMBANGAN PARIWISATA
                </span>

                <h1 class="display-5 fw-bold mt-3 mb-4">
                    Mengembangkan Potensi Pariwisata
                    <span class="text-green">Kota Samarinda</span>
                </h1>

                <p class="lead text-muted mb-4">
                    Tim Pengembangan Pariwisata merupakan bagian yang berperan
                    dalam mendukung pengembangan potensi pariwisata Kota Samarinda
                    melalui pengelolaan destinasi, promosi, penyediaan informasi,
                    serta pengembangan kerja sama di bidang pariwisata.
                </p>

                <p class="text-muted mb-4">
                    Melalui berbagai kegiatan dan program, pengembangan pariwisata
                    diarahkan untuk meningkatkan daya tarik destinasi serta
                    memberikan informasi yang mudah diakses oleh masyarakat,
                    wisatawan, dan pihak yang berkepentingan.
                </p>

                <a href="#tugas-pariwisata"
                   class="btn btn-green rounded-pill px-4 py-3">
                    Lihat Peran Kami
                    <i class="bi bi-arrow-down ms-2"></i>
                </a>

            </div>

            <div class="col-lg-6" data-aos="fade-left">

                <div class="tourism-image-wrapper">

                    <img
                        src="{{ asset('images/tentang/gedung-dinas.jpg') }}"
                        alt="Pengembangan Pariwisata Kota Samarinda"
                        class="img-fluid tourism-main-image"
                    >

                    <div class="tourism-floating-card">

                        <div class="floating-icon">
                            <i class="bi bi-geo-alt-fill"></i>
                        </div>

                        <div>
                            <small>Pengembangan</small>
                            <strong>Pariwisata Samarinda</strong>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
</section>


{{-- =========================================================
    PROFIL
========================================================= --}}
<section class="py-5 bg-light-custom">

    <div class="container">

        <div class="row align-items-center g-5">

            <div class="col-lg-6" data-aos="fade-right">

                <span class="section-badge">
                    PROFIL
                </span>

                <h2 class="fw-bold mt-3 mb-4">
                    Bidang Pengembangan Pariwisata
                    Disporapar Kota Samarinda
                </h2>

                <p class="text-muted">
                    Pengembangan pariwisata menjadi salah satu bagian penting
                    dalam mendukung kemajuan sektor pariwisata Kota Samarinda.
                    Berbagai potensi wisata yang dimiliki perlu dikelola,
                    dikembangkan, dan dipromosikan agar dapat memberikan manfaat
                    bagi masyarakat dan daerah.
                </p>

                <p class="text-muted">
                    Dalam pelaksanaannya, pengembangan pariwisata mencakup
                    berbagai kegiatan yang berkaitan dengan destinasi,
                    promosi, informasi pariwisata, serta hubungan dengan
                    berbagai pihak yang terlibat dalam sektor pariwisata.
                </p>

            </div>

            <div class="col-lg-6" data-aos="fade-left">

                <div class="info-card-grid">

                    <div class="info-card">
                        <div class="info-icon">
                            <i class="bi bi-geo-alt"></i>
                        </div>

                        <div>
                            <h6>Alamat</h6>
                            <p>Kota Samarinda, Kalimantan Timur</p>
                        </div>
                    </div>

                    <div class="info-card">
                        <div class="info-icon">
                            <i class="bi bi-telephone"></i>
                        </div>

                        <div>
                            <h6>Telepon</h6>
                            <p>(0541) 123-456</p>
                        </div>
                    </div>

                    <div class="info-card">
                        <div class="info-icon">
                            <i class="bi bi-envelope"></i>
                        </div>

                        <div>
                            <h6>Email</h6>
                            <p>pariwisata@disporapar-samarinda.go.id</p>
                        </div>
                    </div>

                    <div class="info-card">
                        <div class="info-icon">
                            <i class="bi bi-clock"></i>
                        </div>

                        <div>
                            <h6>Jam Kerja</h6>
                            <p>Senin - Jumat</p>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


{{-- =========================================================
    KEGIATAN PARIWISATA
========================================================= --}}
<section class="py-5">

    <div class="container">

        <div class="text-center mb-5" data-aos="fade-up">

            <span class="section-badge">
                KEGIATAN
            </span>

            <h2 class="fw-bold mt-3">
                Kegiatan Pengembangan Pariwisata
            </h2>

            <p class="text-muted mx-auto section-description">
                Berbagai kegiatan dilakukan sebagai bagian dari upaya
                mendukung pengembangan dan promosi pariwisata Kota Samarinda.
            </p>

        </div>

        <div class="row g-4">

            <div class="col-md-6" data-aos="fade-up">

                <div class="activity-card">

                    <img
                        src="{{ asset('images/tentang/kegiatan-1.jpg') }}"
                        alt="Kegiatan Pariwisata"
                        class="img-fluid"
                    >

                    <div class="activity-content">

                        <span>Kegiatan Pariwisata</span>

                        <h5>
                            Pengembangan dan Promosi Destinasi
                        </h5>

                        <p>
                            Kegiatan yang mendukung pengenalan dan pengembangan
                            berbagai potensi destinasi wisata di Kota Samarinda.
                        </p>

                    </div>

                </div>

            </div>


            <div class="col-md-6"
                 data-aos="fade-up"
                 data-aos-delay="100">

                <div class="activity-card">

                    <img
                        src="{{ asset('images/tentang/kegiatan-2.jpg') }}"
                        alt="Kegiatan Pariwisata"
                        class="img-fluid"
                    >

                    <div class="activity-content">

                        <span>Informasi Pariwisata</span>

                        <h5>
                            Dokumentasi dan Informasi Wisata
                        </h5>

                        <p>
                            Penyediaan informasi dan dokumentasi yang dapat
                            membantu masyarakat dan wisatawan mengenal
                            potensi pariwisata Samarinda.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


{{-- =========================================================
    VISI MISI
========================================================= --}}
<section class="py-5 bg-light-custom">

    <div class="container">

        <div class="row g-4">

            <div class="col-lg-5" data-aos="fade-right">

                <div class="vision-card h-100">

                    <div class="vision-icon">
                        <i class="bi bi-eye"></i>
                    </div>

                    <span>VISI</span>

                    <h3>
                        Pariwisata yang Berkembang dan Berdaya Saing
                    </h3>

                    <p>
                        Mendukung pengembangan sektor pariwisata yang mampu
                        memberikan nilai tambah bagi daerah dan masyarakat.
                    </p>

                </div>

            </div>


            <div class="col-lg-7" data-aos="fade-left">

                <div class="mission-card h-100">

                    <div class="mission-icon">
                        <i class="bi bi-bullseye"></i>
                    </div>

                    <span>MISI</span>

                    <h3>
                        Mendorong Pengembangan Potensi Pariwisata
                    </h3>

                    <ul>

                        <li>
                            <i class="bi bi-check-circle-fill"></i>
                            Mengembangkan potensi destinasi pariwisata.
                        </li>

                        <li>
                            <i class="bi bi-check-circle-fill"></i>
                            Meningkatkan promosi dan informasi pariwisata.
                        </li>

                        <li>
                            <i class="bi bi-check-circle-fill"></i>
                            Mendorong kerja sama dengan berbagai pihak.
                        </li>

                        <li>
                            <i class="bi bi-check-circle-fill"></i>
                            Mendukung pertumbuhan sektor pariwisata daerah.
                        </li>

                    </ul>

                </div>

            </div>

        </div>

    </div>

</section>


{{-- =========================================================
    TUGAS PARIWISATA
========================================================= --}}
<section id="tugas-pariwisata" class="py-5">

    <div class="container">

        <div class="text-center mb-5" data-aos="fade-up">

            <span class="section-badge">
                PERAN & TUGAS
            </span>

            <h2 class="fw-bold mt-3">
                Pengembangan Pariwisata
            </h2>

            <p class="text-muted mx-auto section-description">
                Beberapa aspek yang menjadi bagian dari pengembangan
                pariwisata dan mendukung pertumbuhan sektor pariwisata daerah.
            </p>

        </div>


        <div class="row g-4">

            <div class="col-md-6 col-lg-3" data-aos="fade-up">

                <div class="task-card">

                    <div class="task-icon">
                        <i class="bi bi-geo-alt-fill"></i>
                    </div>

                    <h5>Pengembangan Destinasi</h5>

                    <p>
                        Mendukung pengembangan dan pengenalan berbagai
                        potensi destinasi wisata.
                    </p>

                </div>

            </div>


            <div class="col-md-6 col-lg-3"
                 data-aos="fade-up"
                 data-aos-delay="100">

                <div class="task-card">

                    <div class="task-icon">
                        <i class="bi bi-megaphone-fill"></i>
                    </div>

                    <h5>Promosi Pariwisata</h5>

                    <p>
                        Mendukung kegiatan promosi untuk meningkatkan
                        daya tarik pariwisata.
                    </p>

                </div>

            </div>


            <div class="col-md-6 col-lg-3"
                 data-aos="fade-up"
                 data-aos-delay="200">

                <div class="task-card">

                    <div class="task-icon">
                        <i class="bi bi-info-circle-fill"></i>
                    </div>

                    <h5>Informasi Wisata</h5>

                    <p>
                        Menyediakan informasi mengenai destinasi,
                        agenda, dan kegiatan pariwisata.
                    </p>

                </div>

            </div>


            <div class="col-md-6 col-lg-3"
                 data-aos="fade-up"
                 data-aos-delay="300">

                <div class="task-card">

                    <div class="task-icon">
                        <i class="bi bi-people-fill"></i>
                    </div>

                    <h5>Kemitraan</h5>

                    <p>
                        Mendukung kolaborasi dan hubungan dengan berbagai
                        pihak di sektor pariwisata.
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>


{{-- =========================================================
    EKONOMI KREATIF
========================================================= --}}
<section class="ekraf-section py-5 position-relative overflow-hidden">

    <div class="container py-lg-5">

        <div class="row align-items-center g-5">

            <div class="col-lg-6" data-aos="fade-right">

                <span class="section-badge">
                    EKONOMI KREATIF
                </span>

                <h2 class="display-5 fw-bold mt-3 mb-4">
                    Mengembangkan Potensi
                    <span class="text-green">
                        Ekonomi Kreatif
                    </span>
                    Kota Samarinda
                </h2>

                <p class="lead text-muted mb-4">
                    Ekonomi kreatif merupakan bagian penting dalam mendukung
                    perkembangan pariwisata dan perekonomian daerah melalui
                    kreativitas, inovasi, serta potensi yang dimiliki oleh masyarakat.
                </p>

                <p class="text-muted mb-4">
                    Potensi ekonomi kreatif dapat berkembang melalui berbagai
                    bidang seperti kuliner, kriya, fesyen, seni, desain,
                    fotografi, musik, dan berbagai bentuk karya kreatif lainnya.
                </p>

                <a href="#potensi-ekraf"
                   class="btn btn-green rounded-pill px-4 py-3">

                    Jelajahi Potensi Ekraf
                    <i class="bi bi-arrow-down ms-2"></i>

                </a>

            </div>


            <div class="col-lg-6" data-aos="fade-left">

                <div class="ekraf-image-wrapper">

                    <img
                        src="{{ asset('images/ekraf/ekraf-utama.jpg') }}"
                        alt="Ekonomi Kreatif Kota Samarinda"
                        class="img-fluid ekraf-main-image"
                    >

                    <div class="ekraf-floating-card">

                        <div class="ekraf-floating-icon">
                            <i class="bi bi-lightbulb-fill"></i>
                        </div>

                        <div>
                            <small>Potensi Kreatif</small>
                            <strong>Samarinda</strong>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


{{-- =========================================================
    POTENSI EKRAF
========================================================= --}}
<section id="potensi-ekraf" class="py-5 bg-light-custom">

    <div class="container">

        <div class="text-center mb-5" data-aos="fade-up">

            <span class="section-badge">
                POTENSI EKRAF
            </span>

            <h2 class="fw-bold mt-3">
                Potensi Ekonomi Kreatif Kota Samarinda
            </h2>

            <p class="text-muted mx-auto section-description">
                Kreativitas masyarakat dapat menjadi potensi yang mendukung
                perkembangan ekonomi daerah sekaligus memperkuat daya tarik
                pariwisata Kota Samarinda.
            </p>

        </div>


        <div class="row g-4">

            <div class="col-md-6 col-lg-4" data-aos="fade-up">

                <div class="ekraf-card">

                    <div class="ekraf-card-icon">
                        <i class="bi bi-cup-hot-fill"></i>
                    </div>

                    <h5>Kuliner</h5>

                    <p>
                        Berbagai produk makanan dan minuman kreatif
                        yang menjadi bagian dari potensi usaha masyarakat.
                    </p>

                </div>

            </div>


            <div class="col-md-6 col-lg-4"
                 data-aos="fade-up"
                 data-aos-delay="100">

                <div class="ekraf-card">

                    <div class="ekraf-card-icon">
                        <i class="bi bi-gem"></i>
                    </div>

                    <h5>Kriya</h5>

                    <p>
                        Produk kerajinan yang mengandalkan kreativitas,
                        keterampilan, dan nilai budaya.
                    </p>

                </div>

            </div>


            <div class="col-md-6 col-lg-4"
                 data-aos="fade-up"
                 data-aos-delay="200">

                <div class="ekraf-card">

                    <div class="ekraf-card-icon">
                        <i class="bi bi-bag-heart-fill"></i>
                    </div>

                    <h5>Fesyen</h5>

                    <p>
                        Kreativitas dalam menghasilkan produk fesyen
                        dengan karakter dan identitas lokal.
                    </p>

                </div>

            </div>


            <div class="col-md-6 col-lg-4" data-aos="fade-up">

                <div class="ekraf-card">

                    <div class="ekraf-card-icon">
                        <i class="bi bi-palette-fill"></i>
                    </div>

                    <h5>Seni & Pertunjukan</h5>

                    <p>
                        Berbagai karya seni dan pertunjukan yang dapat
                        menjadi bagian dari daya tarik daerah.
                    </p>

                </div>

            </div>


            <div class="col-md-6 col-lg-4"
                 data-aos="fade-up"
                 data-aos-delay="100">

                <div class="ekraf-card">

                    <div class="ekraf-card-icon">
                        <i class="bi bi-vector-pen"></i>
                    </div>

                    <h5>Desain & Fotografi</h5>

                    <p>
                        Kreativitas visual melalui desain, fotografi,
                        dokumentasi, dan karya komunikasi visual.
                    </p>

                </div>

            </div>


            <div class="col-md-6 col-lg-4"
                 data-aos="fade-up"
                 data-aos-delay="200">

                <div class="ekraf-card">

                    <div class="ekraf-card-icon">
                        <i class="bi bi-music-note-beamed"></i>
                    </div>

                    <h5>Musik & Konten Kreatif</h5>

                    <p>
                        Karya musik dan konten digital yang berkembang
                        melalui kreativitas serta pemanfaatan teknologi.
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>


{{-- =========================================================
    KEPALA BIDANG EKONOMI KREATIF
========================================================= --}}
<section class="py-5">

    <div class="container">

        <div class="text-center mb-5" data-aos="fade-up">

            <span class="section-badge">
                PENGELOLA EKONOMI KREATIF
            </span>

            <h2 class="fw-bold mt-3">
                Agnes Gering Belawing, SP
                NIP. 197408032002122006
            </h2>

            <p class="text-muted mx-auto section-description">
                Pimpinan yang mendukung pelaksanaan pengembangan ekonomi
                kreatif di Kota Samarinda.
            </p>

        </div>


        <div class="row justify-content-center">

            <div class="col-md-6 col-lg-4"
                 data-aos="fade-up">

                <div class="ekraf-leader-card">

                    {{-- FOTO PEJABAT --}}
                    <div class="ekraf-leader-image">

                        <img
                            src="{{ asset('images/ekraf/kepala-bidang-ekraf.jpg') }}"
                            alt="Kepala Bidang Ekonomi Kreatif"
                            class="img-fluid"
                        >

                    </div>


                    {{-- INFORMASI PEJABAT --}}
                    <div class="ekraf-leader-content">

                        <span>
                            KEPALA BIDANG
                        </span>

                        <h4>
                              Agnes Gering Belawing, SP
                        </h4>

                        <p>
                            Pengembangan Ekonomi Kreatif
                            Kota Samarinda
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


{{-- =========================================================
    STRUKTUR ORGANISASI
========================================================= --}}
<section class="py-5">

    <div class="container">

        <div class="text-center mb-5" data-aos="fade-up">

            <span class="section-badge">
                STRUKTUR ORGANISASI
            </span>

            <h2 class="fw-bold mt-3">
                Struktur Organisasi
            </h2>

            <p class="text-muted mx-auto section-description">
                Struktur organisasi yang mendukung pelaksanaan tugas
                dan kegiatan pada bidang terkait.
            </p>

        </div>


        <div class="row g-4 justify-content-center">

            @foreach ($strukturOrganisasi as $i => $item)

                <div class="col-sm-6 col-md-4 col-lg-3"
                     data-aos="fade-up"
                     data-aos-delay="{{ $i * 80 }}">

                    <div class="person-card">

                        <div class="person-image">

                            <img
                                src="{{ asset('images/pejabat/' . ($item['foto'] ?? 'pejabat.jpg')) }}"
                                alt="{{ $item['nama'] ?? 'Pejabat' }}"
                                class="img-fluid"
                            >

                        </div>

                        <div class="person-content">

                            <span>
                                {{ $item['jabatan'] ?? 'Jabatan' }}
                            </span>

                            <h5>
                                {{ $item['nama'] ?? 'Diana P Juliadi, S.E., M.Si' }}
                            </h5>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    </div>

</section>


{{-- =========================================================
    CSS
========================================================= --}}
<style>

.text-green {
    color: #198754;
}

.bg-light-custom {
    background: #f7f9f8;
}

.section-badge {
    display: inline-flex;
    align-items: center;
    padding: 8px 16px;
    border-radius: 50px;
    background: rgba(25, 135, 84, .10);
    color: #198754;
    font-size: .75rem;
    font-weight: 700;
    letter-spacing: 1.2px;
}

.section-description {
    max-width: 650px;
}

.btn-green {
    background: #198754;
    color: #fff;
    border: none;
    transition: .3s;
}

.btn-green:hover {
    background: #146c43;
    color: #fff;
    transform: translateY(-2px);
}


/* =========================
   TOURISM
========================= */

.tourism-intro,
.ekraf-section {
    background: #fff;
}

.tourism-image-wrapper,
.ekraf-image-wrapper {
    position: relative;
    padding: 15px;
}

.tourism-main-image,
.ekraf-main-image {
    width: 100%;
    height: 480px;
    object-fit: cover;
    border-radius: 28px;
    box-shadow: 0 20px 50px rgba(0,0,0,.12);
}

.tourism-floating-card {
    position: absolute;
    left: 0;
    bottom: 35px;

    display: flex;
    align-items: center;
    gap: 14px;

    background: #fff;
    padding: 15px 20px;

    border-radius: 18px;

    box-shadow: 0 15px 40px rgba(0,0,0,.12);
}

.tourism-floating-card small,
.ekraf-floating-card small {
    display: block;
    color: #777;
    font-size: .75rem;
}

.tourism-floating-card strong,
.ekraf-floating-card strong {
    display: block;
    font-size: .95rem;
}

.floating-icon,
.ekraf-floating-icon {
    width: 45px;
    height: 45px;

    border-radius: 14px;

    display: flex;
    align-items: center;
    justify-content: center;

    background: #198754;
    color: #fff;

    font-size: 1.2rem;
}


/* =========================
   INFO
========================= */

.info-card-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 18px;
}

.info-card {
    display: flex;
    align-items: flex-start;
    gap: 14px;

    padding: 22px;

    background: #fff;

    border-radius: 18px;
    border: 1px solid #eee;

    transition: .3s;
}

.info-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 30px rgba(0,0,0,.07);
}

.info-icon {
    min-width: 42px;
    height: 42px;

    border-radius: 12px;

    display: flex;
    align-items: center;
    justify-content: center;

    background: rgba(25,135,84,.10);
    color: #198754;
}

.info-card h6 {
    margin-bottom: 5px;
    font-weight: 700;
}

.info-card p {
    margin: 0;
    color: #777;
    font-size: .9rem;
}


/* =========================
   ACTIVITY
========================= */

.activity-card {
    overflow: hidden;

    background: #fff;

    border-radius: 24px;
    border: 1px solid #eee;

    transition: .3s;
}

.activity-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 18px 45px rgba(0,0,0,.10);
}

.activity-card img {
    width: 100%;
    height: 300px;
    object-fit: cover;
}

.activity-content {
    padding: 25px;
}

.activity-content span {
    color: #198754;
    font-size: .75rem;
    font-weight: 700;
    letter-spacing: .8px;
}

.activity-content h5 {
    margin-top: 10px;
    font-weight: 700;
}

.activity-content p {
    color: #777;
    margin-bottom: 0;
}


/* =========================
   VISI MISI
========================= */

.vision-card,
.mission-card {
    padding: 40px;

    border-radius: 25px;

    background: #fff;

    border: 1px solid #eee;
}

.vision-card span,
.mission-card span {
    color: #198754;
    font-size: .75rem;
    font-weight: 700;
    letter-spacing: 1px;
}

.vision-icon,
.mission-icon {
    width: 55px;
    height: 55px;

    border-radius: 16px;

    display: flex;
    align-items: center;
    justify-content: center;

    background: rgba(25,135,84,.10);
    color: #198754;

    font-size: 1.4rem;

    margin-bottom: 20px;
}

.vision-card h3,
.mission-card h3 {
    margin-top: 10px;
    margin-bottom: 18px;
    font-weight: 700;
}

.vision-card p {
    color: #777;
    margin-bottom: 0;
}

.mission-card ul {
    padding: 0;
    margin: 0;
    list-style: none;
}

.mission-card li {
    display: flex;
    gap: 10px;
    margin-bottom: 13px;
    color: #666;
}

.mission-card li i {
    color: #198754;
    margin-top: 4px;
}


/* =========================
   TASK
========================= */

.task-card {
    height: 100%;

    padding: 30px 25px;

    border-radius: 22px;

    background: #fff;

    border: 1px solid #eee;

    transition: .3s;
}

.task-card:hover {
    transform: translateY(-7px);
    box-shadow: 0 18px 40px rgba(0,0,0,.08);
}

.task-icon {
    width: 55px;
    height: 55px;

    display: flex;
    align-items: center;
    justify-content: center;

    background: rgba(25,135,84,.10);

    color: #198754;

    border-radius: 16px;

    font-size: 1.3rem;

    margin-bottom: 22px;
}

.task-card h5 {
    font-weight: 700;
    margin-bottom: 12px;
}

.task-card p {
    color: #777;
    margin-bottom: 0;
}


/* =========================
   EKRAF
========================= */

.ekraf-floating-card {
    position: absolute;
    right: 0;
    bottom: 35px;

    display: flex;
    align-items: center;
    gap: 14px;

    background: #fff;

    padding: 15px 22px;

    border-radius: 18px;

    box-shadow: 0 15px 40px rgba(0,0,0,.12);
}

.ekraf-floating-icon {
    width: 45px;
    height: 45px;
}

.ekraf-card {
    height: 100%;

    padding: 30px;

    background: #fff;

    border-radius: 22px;

    border: 1px solid #eee;

    transition: .3s;
}

.ekraf-card:hover {
    transform: translateY(-7px);
    box-shadow: 0 18px 40px rgba(0,0,0,.08);
}

.ekraf-card-icon {
    width: 55px;
    height: 55px;

    border-radius: 16px;

    display: flex;
    align-items: center;
    justify-content: center;

    background: rgba(25,135,84,.10);

    color: #198754;

    font-size: 1.3rem;

    margin-bottom: 20px;
}

.ekraf-card h5 {
    font-weight: 700;
    margin-bottom: 12px;
}

.ekraf-card p {
    color: #777;
    margin-bottom: 0;
}


/* =========================================================
   FOTO KEPALA BIDANG EKONOMI KREATIF
========================================================= */

.ekraf-leader-card {
    overflow: hidden;

    background: #fff;

    border-radius: 26px;

    border: 1px solid #eee;

    box-shadow: 0 15px 40px rgba(0,0,0,.06);

    transition: .3s;
}

.ekraf-leader-card:hover {
    transform: translateY(-7px);

    box-shadow: 0 20px 50px rgba(0,0,0,.10);
}

.ekraf-leader-image {
    background: #f2f4f3;
    padding: 15px;
}

.ekraf-leader-image img {
    display: block;

    width: 100%;
    height: 420px;

    object-fit: cover;
    object-position: center;

    border-radius: 20px;
}

.ekraf-leader-content {
    padding: 25px;
    text-align: center;
}

.ekraf-leader-content span {
    color: #198754;

    font-size: .75rem;

    font-weight: 700;

    letter-spacing: 1px;
}

.ekraf-leader-content h4 {
    margin-top: 10px;
    margin-bottom: 8px;

    font-weight: 700;
}

.ekraf-leader-content p {
    margin: 0;
    color: #777;
}


/* =========================
   STRUKTUR
========================= */

.person-card {
    overflow: hidden;

    background: #fff;

    border-radius: 22px;

    border: 1px solid #eee;

    transition: .3s;
}

.person-card:hover {
    transform: translateY(-6px);

    box-shadow: 0 18px 40px rgba(0,0,0,.08);
}

.person-image {
    background: #f2f4f3;
}

.person-image img {
    width: 100%;
    height: 280px;

    object-fit: cover;
}

.person-content {
    padding: 20px;
    text-align: center;
}

.person-content span {
    color: #198754;

    font-size: .75rem;

    font-weight: 700;

    text-transform: uppercase;
}

.person-content h5 {
    margin-top: 8px;
    margin-bottom: 0;

    font-weight: 700;
}


/* =========================
   RESPONSIVE
========================= */

@media (max-width: 991px) {

    .tourism-main-image,
    .ekraf-main-image {
        height: 400px;
    }

}


@media (max-width: 767px) {

    .info-card-grid {
        grid-template-columns: 1fr;
    }

    .tourism-main-image,
    .ekraf-main-image {
        height: 330px;
    }

    .tourism-floating-card,
    .ekraf-floating-card {
        left: 25px;
        right: 25px;
        bottom: 25px;
    }

    .vision-card,
    .mission-card {
        padding: 30px;
    }

    .ekraf-leader-image img {
        height: 350px;
    }

}

</style>

@endsection