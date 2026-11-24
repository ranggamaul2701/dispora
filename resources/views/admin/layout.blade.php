<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title', 'Dashboard') — Admin Pariwisata</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<style>
:root{--primary:#1565C0;--primary-dark:#0D47A1;--primary-light:#1E88E5;--accent:#FFC107;--sky:#E3F2FD;--light-bg:#F0F7FF;--border:#BBDEFB;--text-main:#0D1B2A;--text-soft:#546E7A;--sb:252px;--top:62px;--shadow:0 2px 14px rgba(21,101,192,.09)}
*,*::before,*::after{box-sizing:border-box}
body{font-family:'Inter','Segoe UI',sans-serif;background:var(--light-bg);color:var(--text-main);margin:0;line-height:1.55}
::-webkit-scrollbar{width:7px;height:7px}::-webkit-scrollbar-thumb{background:#BBDEFB;border-radius:4px}
a{text-decoration:none;color:var(--primary)}

.sidebar{position:fixed;inset:0 auto 0 0;width:var(--sb);background:linear-gradient(180deg,#0D47A1,#1565C0 60%,#1976D2);z-index:200;display:flex;flex-direction:column;box-shadow:4px 0 24px rgba(13,71,161,.25);transition:left .3s}
.sb-logo{padding:18px 20px;border-bottom:1px solid rgba(255,255,255,.12);display:flex;align-items:center;gap:12px}
.sb-logo-icon{width:42px;height:42px;background:rgba(255,255,255,.16);border:1px solid rgba(255,255,255,.2);border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.3rem;overflow:hidden}
.sb-logo-icon img{width:30px;height:30px;object-fit:contain}
.sb-logo .t1{color:#fff;font-weight:800;font-size:.92rem;display:block;line-height:1.2}
.sb-logo .t2{color:var(--accent);font-size:.66rem;font-weight:700;letter-spacing:.07em;text-transform:uppercase}
.sb-nav{flex:1;overflow-y:auto;padding:10px 0}
.sb-label{display:block;color:rgba(255,255,255,.38);font-size:.64rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;padding:12px 20px 4px}
.sb-link{display:flex;align-items:center;gap:11px;padding:10px 20px;color:rgba(255,255,255,.76);font-size:.87rem;font-weight:500;border-left:3px solid transparent;transition:.2s}
.sb-link:hover{color:#fff;background:rgba(255,255,255,.08)}
.sb-link.active{color:#fff;background:rgba(255,255,255,.13);border-left-color:var(--accent)}
.sb-link i{width:20px;text-align:center}
.sb-badge{margin-left:auto;background:var(--accent);color:var(--primary-dark);font-size:.64rem;font-weight:800;padding:1px 8px;border-radius:10px}
.sb-badge.red{background:#E53935;color:#fff}
.sb-foot{padding:14px 18px;border-top:1px solid rgba(255,255,255,.12)}

.topbar{position:fixed;top:0;left:var(--sb);right:0;height:var(--top);background:rgba(255,255,255,.96);backdrop-filter:blur(10px);border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;padding:0 24px;z-index:100}
.main{margin-left:var(--sb);padding-top:var(--top);min-height:100vh}
.content{padding:24px;animation:fadeUp .35s ease}
@keyframes fadeUp{from{opacity:0;transform:translateY(12px)}to{opacity:1;transform:none}}

.alert-dash{padding:13px 18px;border-radius:12px;margin-bottom:20px;display:flex;gap:12px;align-items:flex-start;font-size:.88rem;font-weight:600;animation:fadeUp .3s ease}
.alert-dash.ok{background:#E8F5E9;color:#2E7D32;border:1px solid #A5D6A7;border-left:4px solid #2E7D32}
.alert-dash.err{background:#FFEBEE;color:#C62828;border:1px solid #FFCDD2;border-left:4px solid #C62828}

.dcard{background:#fff;border-radius:14px;box-shadow:var(--shadow);overflow:hidden}
.dcard-h{padding:14px 20px;border-bottom:1px solid var(--sky);display:flex;align-items:center;justify-content:space-between;gap:10px;flex-wrap:wrap}
.dcard-t{display:flex;align-items:center;gap:10px;font-weight:800;color:var(--primary);font-size:.95rem}
.dcard-t .ic{width:30px;height:30px;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:.9rem;background:var(--sky)}
.dcard-b{padding:20px}
.page-head{display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap;margin-bottom:22px}
.page-head h1{font-size:1.25rem;font-weight:800;color:var(--primary);margin:0;line-height:1.2}
.page-head p{margin:0;font-size:.82rem;color:var(--text-soft)}
.ph-ic{width:42px;height:42px;border-radius:11px;display:flex;align-items:center;justify-content:center;font-size:1.2rem;flex-shrink:0}

.dtable{width:100%;border-collapse:collapse}
.dtable th{background:#F8FBFF;padding:11px 16px;font-size:.74rem;font-weight:700;color:var(--text-soft);text-align:left;text-transform:uppercase;letter-spacing:.05em;white-space:nowrap}
.dtable td{padding:13px 16px;border-bottom:1px solid #EEF5FF;font-size:.87rem;vertical-align:middle}
.dtable tr:last-child td{border-bottom:none}
.dtable tbody tr:hover td{background:#F8FBFF}
.thumb{width:60px;height:46px;border-radius:9px;object-fit:cover;background:var(--sky);display:block}

.btn-d{padding:9px 18px;border-radius:9px;font-size:.85rem;font-weight:700;cursor:pointer;border:none;display:inline-flex;align-items:center;gap:7px;transition:.2s;font-family:inherit;color:#fff}
.btn-d:hover{transform:translateY(-2px);color:#fff}
.btn-blue{background:linear-gradient(135deg,var(--primary),var(--primary-light));box-shadow:0 3px 12px rgba(21,101,192,.3)}
.btn-green{background:linear-gradient(135deg,#2E7D32,#43A047);box-shadow:0 3px 12px rgba(46,125,50,.3)}
.btn-orange{background:linear-gradient(135deg,#E65100,#FF7043);box-shadow:0 3px 12px rgba(230,81,0,.3)}
.btn-purple{background:linear-gradient(135deg,#6A1B9A,#9C27B0);box-shadow:0 3px 12px rgba(106,27,154,.3)}
.btn-red{background:linear-gradient(135deg,#C62828,#E53935);box-shadow:0 3px 12px rgba(198,40,40,.3)}
.btn-light-d{background:#fff;color:var(--text-soft);border:1.5px solid var(--border)}
.btn-light-d:hover{background:var(--light-bg);color:var(--primary)}
.btn-i{width:33px;height:33px;border-radius:8px;border:none;display:inline-flex;align-items:center;justify-content:center;cursor:pointer;font-size:.86rem;transition:.2s}
.btn-i:hover{transform:scale(1.12)}
.bi-edit{background:#E3F2FD;color:var(--primary)}.bi-edit:hover{background:var(--primary);color:#fff}
.bi-del{background:#FFEBEE;color:#C62828}.bi-del:hover{background:#C62828;color:#fff}
.bi-view{background:#E0F2F1;color:#00796B}.bi-view:hover{background:#00796B;color:#fff}
.pill{display:inline-block;padding:3px 11px;border-radius:20px;font-size:.72rem;font-weight:700}
.pill.blue{background:var(--sky);color:var(--primary)}.pill.green{background:#E8F5E9;color:#2E7D32}.pill.red{background:#FFEBEE;color:#C62828}.pill.gray{background:#ECEFF1;color:#546E7A}.pill.amber{background:#FFF8E1;color:#B26A00}.pill.purple{background:#F3E5F5;color:#6A1B9A}

.f-label{font-size:.82rem;font-weight:700;color:var(--primary);display:block;margin-bottom:6px}
.f-input{width:100%;padding:10px 14px;border:1.5px solid var(--border);border-radius:9px;font-size:.9rem;outline:none;font-family:inherit;background:#F8FBFF;color:var(--text-main);transition:.2s}
.f-input:focus{border-color:var(--primary);background:#fff;box-shadow:0 0 0 3px rgba(21,101,192,.12)}
.f-input.is-invalid{border-color:#C62828;background:#FFF5F5}
.f-hint{font-size:.74rem;color:var(--text-soft);margin-top:5px}
.f-err{color:#C62828;font-size:.78rem;margin-top:4px}
.switch-box{display:flex;align-items:center;gap:12px;padding:12px 14px;background:#F8FBFF;border:1.5px solid var(--sky);border-radius:11px;cursor:pointer}
.switch-box input{width:18px;height:18px;accent-color:var(--primary)}
.img-prev{width:100%;height:170px;object-fit:cover;border-radius:11px;border:2px solid var(--sky);display:block;margin-bottom:12px;background:var(--sky)}
.search-d{position:relative}
.search-d i{position:absolute;left:12px;top:50%;transform:translateY(-50%);color:#90CAF9;font-size:.85rem}
.search-d input{padding:8px 14px 8px 34px;border:1.5px solid var(--border);border-radius:20px;font-size:.84rem;outline:none;background:var(--sky);width:210px;font-family:inherit;transition:.22s}
.search-d input:focus{background:#fff;border-color:var(--primary);width:250px;box-shadow:0 0 0 3px rgba(21,101,192,.1)}

.modal-ov{position:fixed;inset:0;background:rgba(13,71,161,.42);backdrop-filter:blur(4px);z-index:9000;display:none;align-items:center;justify-content:center;padding:20px}
.modal-ov.show{display:flex}
.modal-bx{background:#fff;border-radius:18px;width:100%;max-width:420px;padding:30px;text-align:center;box-shadow:0 20px 60px rgba(13,71,161,.28);animation:pop .3s cubic-bezier(.34,1.56,.64,1)}
@keyframes pop{from{transform:scale(.85);opacity:0}to{transform:none;opacity:1}}

.pagination{gap:6px;margin:0;flex-wrap:wrap;justify-content:center}
.page-link{border-radius:8px!important;border:1.5px solid var(--border);color:var(--primary);font-weight:600;font-size:.83rem;padding:6px 13px}
.page-link:hover{background:var(--primary);color:#fff;border-color:var(--primary)}
.page-item.active .page-link{background:var(--primary);border-color:var(--primary);color:#fff}

@media(max-width:991px){.sidebar{left:calc(-1*var(--sb))}.sidebar.open{left:0}.topbar{left:0}.main{margin-left:0}.search-d input{width:140px}}
</style>
@stack('styles')
</head>
<body>

<aside class="sidebar" id="sidebar">
    <a href="{{ route('admin.dashboard') }}" class="sb-logo">
        <div class="sb-logo-icon"><img src="{{ asset('images/logo/logo-disporapar.png') }}" alt="" onerror="this.style.display='none'"></div>
        <div><span class="t1">Pariwisata Admin</span><span class="t2">Disporapar Samarinda</span></div>
    </a>
    <nav class="sb-nav">
        <span class="sb-label">Utama</span>
        <a href="{{ route('admin.dashboard') }}" class="sb-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i class="bi bi-speedometer2"></i> Dashboard</a>

        <span class="sb-label">Kelola Konten</span>
        <a href="{{ route('admin.destinasi.index') }}" class="sb-link {{ request()->routeIs('admin.destinasi.*') ? 'active' : '' }}"><i class="bi bi-geo-alt-fill"></i> Destinasi Wisata <span class="sb-badge">{{ $cnt['destinasi'] }}</span></a>
        <a href="{{ route('admin.berita.index') }}" class="sb-link {{ request()->routeIs('admin.berita.*') ? 'active' : '' }}"><i class="bi bi-newspaper"></i> Berita <span class="sb-badge">{{ $cnt['berita'] }}</span></a>
        <a href="{{ route('admin.agenda.index') }}" class="sb-link {{ request()->routeIs('admin.agenda.*') ? 'active' : '' }}"><i class="bi bi-calendar-event"></i> Agenda & Event <span class="sb-badge">{{ $cnt['agenda'] }}</span></a>
        <a href="{{ route('admin.galeri.index') }}" class="sb-link {{ request()->routeIs('admin.galeri.*') ? 'active' : '' }}"><i class="bi bi-images"></i> Galeri Foto</a>

        <span class="sb-label">Manajemen</span>
        <a href="{{ route('admin.pesan.index') }}" class="sb-link {{ request()->routeIs('admin.pesan.*') ? 'active' : '' }}"><i class="bi bi-envelope-fill"></i> Pesan Masuk @if($cnt['pesan'])<span class="sb-badge red">{{ $cnt['pesan'] }}</span>@endif</a>
        <a href="{{ route('admin.users.index') }}" class="sb-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}"><i class="bi bi-people-fill"></i> Pengguna <span class="sb-badge">{{ $cnt['users'] }}</span></a>

        <span class="sb-label">Lainnya</span>
        <a href="{{ route('home') }}" target="_blank" class="sb-link"><i class="bi bi-globe"></i> Lihat Website</a>
    </nav>
    <div class="sb-foot">
        <div style="display:flex;align-items:center;gap:10px;padding:10px;background:rgba(255,255,255,.09);border-radius:11px;margin-bottom:10px">
            <div style="width:34px;height:34px;border-radius:50%;background:var(--accent);display:flex;align-items:center;justify-content:center;color:var(--primary-dark);font-weight:800">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
            <div style="min-width:0"><div style="color:#fff;font-weight:700;font-size:.84rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">{{ Auth::user()->name }}</div><div style="color:var(--accent);font-size:.68rem;font-weight:700"><i class="bi bi-shield-check me-1"></i>Administrator</div></div>
        </div>
        <form method="POST" action="{{ route('logout') }}">@csrf
            <button type="submit" style="width:100%;background:rgba(255,255,255,.1);border:1px solid rgba(255,255,255,.2);color:#fff;padding:9px;border-radius:9px;font-size:.84rem;cursor:pointer;display:flex;align-items:center;gap:8px;justify-content:center;font-family:inherit"><i class="bi bi-box-arrow-right"></i> Logout</button>
        </form>
    </div>
</aside>

<div class="topbar">
    <div style="display:flex;align-items:center;gap:12px">
        <button class="d-lg-none" onclick="document.getElementById('sidebar').classList.toggle('open')" style="background:none;border:none;font-size:1.4rem;color:var(--primary);cursor:pointer" aria-label="Menu"><i class="bi bi-list"></i></button>
        <div><div style="font-weight:800;color:var(--primary);font-size:.95rem;line-height:1.2">@yield('title', 'Dashboard')</div><div style="font-size:.72rem;color:var(--text-soft)">{{ now()->translatedFormat('l, d F Y') }}</div></div>
    </div>
    <div style="display:flex;align-items:center;gap:10px">
        <form class="search-d" method="GET" action="{{ route('admin.dashboard') }}">
            <i class="bi bi-search"></i><input type="text" name="search" value="{{ request('search') }}" placeholder="Cari di dashboard..." autocomplete="off">
        </form>
        <a href="{{ route('admin.pesan.index') }}" title="Pesan masuk" style="position:relative;width:38px;height:38px;border-radius:10px;background:var(--sky);border:1.5px solid var(--border);display:flex;align-items:center;justify-content:center;color:var(--primary)">
            <i class="bi bi-bell"></i>@if($cnt['pesan'])<span style="position:absolute;top:3px;right:3px;width:9px;height:9px;background:#E53935;border-radius:50%;border:2px solid #fff"></span>@endif
        </a>
    </div>
</div>

<main class="main">
    <div class="content">
        @if(session('success'))<div class="alert-dash ok"><i class="bi bi-check-circle-fill"></i><span>{{ session('success') }}</span></div>@endif
        @if(session('error'))<div class="alert-dash err"><i class="bi bi-exclamation-circle-fill"></i><span>{{ session('error') }}</span></div>@endif
        @if($errors->any())
            <div class="alert-dash err"><i class="bi bi-exclamation-circle-fill"></i><div><div>Terdapat kesalahan pada data:</div><ul style="margin:6px 0 0;padding-left:18px;font-weight:500">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div></div>
        @endif
        @yield('content')
    </div>
</main>

{{-- Modal konfirmasi hapus --}}
<div class="modal-ov" id="confirmModal">
    <div class="modal-bx">
        <div style="font-size:2.8rem;color:#E53935;margin-bottom:6px"><i class="bi bi-exclamation-triangle"></i></div>
        <h5 style="font-weight:800;color:#C62828;margin:8px 0">Hapus Data?</h5>
        <p id="confirmText" style="color:var(--text-soft);font-size:.9rem;margin-bottom:22px"></p>
        <div style="display:flex;gap:10px;justify-content:center">
            <button type="button" class="btn-d btn-light-d" id="confirmNo"><i class="bi bi-x-circle"></i> Batal</button>
            <button type="button" class="btn-d btn-red" id="confirmYes"><i class="bi bi-trash-fill"></i> Ya, Hapus</button>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
(function () {
    var modal = document.getElementById('confirmModal'), pending = null;
    document.addEventListener('submit', function (e) {
        var f = e.target;
        if (!f.dataset || !f.dataset.confirm || f.dataset.ok) return;
        e.preventDefault(); pending = f;
        document.getElementById('confirmText').textContent = f.dataset.confirm;
        modal.classList.add('show');
    });
    document.getElementById('confirmNo').onclick = function () { modal.classList.remove('show'); pending = null; };
    document.getElementById('confirmYes').onclick = function () { if (pending) { pending.dataset.ok = '1'; pending.submit(); } };
    modal.addEventListener('click', function (e) { if (e.target === modal) modal.classList.remove('show'); });
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape') modal.classList.remove('show'); });
    setTimeout(function () { document.querySelectorAll('.alert-dash.ok').forEach(function (a) { a.style.transition = 'opacity .5s'; a.style.opacity = 0; setTimeout(function () { a.remove(); }, 500); }); }, 5000);
})();
</script>
@stack('scripts')
</body>
</html>
