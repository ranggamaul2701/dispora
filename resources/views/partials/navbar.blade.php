<nav class="navbar navbar-expand-lg navbar-disporapar">
    <div class="container">
        <a class="navbar-brand navbar-brand-wrap" href="{{ route('home') }}">
            <div class="navbar-brand-logo">
                <img src="{{ asset('images/logo/logo-disporapar.png') }}" alt="Logo"
                     onerror="this.style.display='none'">
            </div>
            <div class="navbar-brand-text">
                <span class="nama-dinas">Pariwisata Samarinda</span>
                <span class="kota">Bidang Pengembangan Pariwisata</span>
            </div>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain" aria-label="Menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navMain">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-0">
                <li class="nav-item"><a class="nav-link nav-link-custom {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a></li>
                <li class="nav-item"><a class="nav-link nav-link-custom {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">Tentang</a></li>
                <li class="nav-item"><a class="nav-link nav-link-custom {{ request()->routeIs('destinasi.*') ? 'active' : '' }}" href="{{ route('destinasi.index') }}">Destinasi</a></li>
                <li class="nav-item"><a class="nav-link nav-link-custom {{ request()->routeIs('berita.*') ? 'active' : '' }}" href="{{ route('berita.index') }}">Berita</a></li>
                <li class="nav-item"><a class="nav-link nav-link-custom {{ request()->routeIs('galeri.*') ? 'active' : '' }}" href="{{ route('galeri.index') }}">Galeri</a></li>
                <li class="nav-item"><a class="nav-link nav-link-custom {{ request()->routeIs('agenda.*') ? 'active' : '' }}" href="{{ route('agenda.index') }}">Agenda</a></li>

                <li class="nav-item dropdown">
                    <a class="nav-link nav-link-custom dropdown-toggle {{ request()->routeIs('peta.*','statistik.*','kalkulator.*','kalender.*','itinerary.*') ? 'active' : '' }}"
                       href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Layanan</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('peta.index') }}"><i class="bi bi-map me-2"></i>Peta Wisata</a></li>
                        <li><a class="dropdown-item" href="{{ route('kalender.index') }}"><i class="bi bi-calendar2-check me-2"></i>Kalender Event</a></li>
                        <li><a class="dropdown-item" href="{{ route('kalkulator.index') }}"><i class="bi bi-calculator me-2"></i>Kalkulator Biaya</a></li>
                        <li><a class="dropdown-item" href="{{ route('itinerary.index') }}"><i class="bi bi-signpost-split me-2"></i>Itinerary Builder</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('statistik.index') }}"><i class="bi bi-bar-chart me-2"></i>Statistik Pariwisata</a></li>
                    </ul>
                </li>

                <li class="nav-item ms-lg-2 my-2 my-lg-0">
                    <a class="nav-search" href="{{ route('search') }}" title="Cari" aria-label="Cari"><i class="bi bi-search"></i></a>
                </li>

                <li class="nav-item ms-lg-2">
                    @auth
                        <div class="dropdown">
                            <button class="btn-primary-custom dropdown-toggle" data-bs-toggle="dropdown"
                                    style="background:rgba(255,255,255,.14);color:#fff;border:1.5px solid rgba(255,255,255,.3);padding:8px 16px;font-size:.85rem">
                                <span style="width:24px;height:24px;background:var(--accent);border-radius:50%;display:inline-flex;align-items:center;justify-content:center;color:var(--primary-dark);font-weight:800;font-size:.75rem">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </span>
                                {{ \Illuminate\Support\Str::limit(Auth::user()->name, 12) }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li class="px-3 py-2" style="border-bottom:1px solid var(--border)">
                                    <div style="font-weight:800;color:var(--primary);font-size:.9rem">{{ Auth::user()->name }}</div>
                                    <div style="font-size:.74rem;color:var(--text-soft)">{{ Auth::user()->email }}</div>
                                    <span class="badge-soft {{ Auth::user()->isAdmin() ? 'blue' : 'gray' }} mt-1"><i class="bi {{ Auth::user()->isAdmin() ? 'bi-shield-check' : 'bi-person' }} me-1"></i>{{ Auth::user()->isAdmin() ? 'Administrator' : 'Tamu' }}</span>
                                </li>
                                @if(Auth::user()->isAdmin())
                                    <li><a class="dropdown-item mt-1" href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2 me-2"></i>Dashboard Admin</a></li>
                                @endif
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item" style="color:#C62828"><i class="bi bi-box-arrow-right me-2"></i>Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <a href="{{ route('kontak.index') }}" class="btn-primary-custom" style="padding:9px 20px;font-size:.85rem">
                            <i class="bi bi-telephone-fill"></i> Kontak
                        </a>
                    @endauth
                </li>
            </ul>
        </div>
    </div>
</nav>
