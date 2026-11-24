@php $k = config('pariwisata.kontak'); @endphp
<footer class="footer-main">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-4">
                <div class="footer-brand">
                    <span class="nama-dinas">Bidang Pengembangan Pariwisata</span>
                    <span class="kota">Disporapar Kota Samarinda</span>
                    <p>Mendorong pertumbuhan sektor pariwisata Kota Samarinda melalui pengembangan destinasi unggulan, promosi wisata, dan pemberdayaan pelaku ekonomi kreatif berbasis kearifan lokal.</p>
                </div>
                <div class="footer-sosmed">
                    <a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                    <a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                    <a href="#" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
                    <a href="#" aria-label="X"><i class="bi bi-twitter-x"></i></a>
                </div>
            </div>
            <div class="col-lg-2 col-6">
                <h6 class="footer-heading">Navigasi</h6>
                <ul class="footer-links">
                    <li><a href="{{ route('home') }}">Beranda</a></li>
                    <li><a href="{{ route('about') }}">Tentang</a></li>
                    <li><a href="{{ route('destinasi.index') }}">Destinasi</a></li>
                    <li><a href="{{ route('berita.index') }}">Berita</a></li>
                    <li><a href="{{ route('galeri.index') }}">Galeri</a></li>
                    <li><a href="{{ route('agenda.index') }}">Agenda</a></li>
                    <li><a href="{{ route('kontak.index') }}">Kontak</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-6">
                <h6 class="footer-heading">Layanan</h6>
                <ul class="footer-links">
                    <li><a href="{{ route('peta.index') }}">Peta Wisata</a></li>
                    <li><a href="{{ route('kalender.index') }}">Kalender Event</a></li>
                    <li><a href="{{ route('kalkulator.index') }}">Kalkulator Biaya</a></li>
                    <li><a href="{{ route('itinerary.index') }}">Itinerary Builder</a></li>
                    <li><a href="{{ route('statistik.index') }}">Statistik</a></li>
                </ul>
            </div>
            <div class="col-lg-4">
                <h6 class="footer-heading">Kontak Kami</h6>
                <div class="footer-kontak-item"><i class="bi bi-geo-alt-fill"></i><span>{{ $k['alamat'] }}</span></div>
                <div class="footer-kontak-item"><i class="bi bi-telephone-fill"></i><span>{{ $k['telepon'] }}</span></div>
                <div class="footer-kontak-item"><i class="bi bi-envelope-fill"></i><span>{{ $k['email'] }}</span></div>
                <div class="footer-kontak-item"><i class="bi bi-clock-fill"></i><span>{{ $k['jam'] }}</span></div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>&copy; {{ date('Y') }} <span>Bidang Pengembangan Pariwisata — Disporapar Kota Samarinda</span>. Hak cipta dilindungi.</div>
            @guest
                <a href="{{ route('login') }}" class="text-white-50 text-decoration-none" style="font-size:.76rem" title="Khusus Pengelola / Petugas">
                    <i class="bi bi-shield-lock me-1"></i>Login Petugas
                </a>
            @else
                <a href="{{ route('admin.dashboard') }}" class="text-white-50 text-decoration-none" style="font-size:.76rem">
                    <i class="bi bi-speedometer2 me-1"></i>Panel Admin
                </a>
            @endguest
        </div>
    </div>
</footer>
