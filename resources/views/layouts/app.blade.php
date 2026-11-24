<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('meta', 'Website resmi Bidang Pengembangan Pariwisata Disporapar Kota Samarinda')">
    <title>@yield('title', 'Pariwisata Samarinda') — Disporapar Kota Samarinda</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body>

{{-- SPLASH --}}
<div id="splash">
    <div id="splash-logo">
        <div class="splash-icon">
            <img src="{{ asset('images/logo/logo-disporapar.png') }}" alt="Logo"
                 onerror="this.style.display='none'">
        </div>
        <h2 style="color:#fff;font-weight:800;font-size:1.4rem;margin:0 0 4px">Pariwisata Samarinda</h2>
        <p style="color:rgba(255,255,255,.7);font-size:.85rem;margin:0">Bidang Pengembangan Pariwisata</p>
        <p style="color:rgba(255,255,255,.5);font-size:.75rem;margin:0">Disporapar Kota Samarinda</p>
    </div>
    <div class="splash-bar"><div id="splash-bar"></div></div>
    <p id="splash-text" style="color:rgba(255,255,255,.55);font-size:.72rem;letter-spacing:.12em;margin-top:10px">MEMUAT...</p>
</div>

@include('partials.navbar')

@if(session('success'))
    <div class="flash flash-success"><i class="bi bi-check-circle-fill"></i><span>{{ session('success') }}</span></div>
@endif
@if(session('error'))
    <div class="flash flash-error"><i class="bi bi-exclamation-circle-fill"></i><span>{{ session('error') }}</span></div>
@endif

<main>@yield('content')</main>

@include('partials.footer')

{{-- WhatsApp --}}
<a class="wa-float" target="_blank" rel="noopener" title="Chat WhatsApp"
   href="https://wa.me/{{ config('pariwisata.kontak.wa') }}?text={{ rawurlencode('Halo, saya ingin bertanya tentang wisata Samarinda') }}">
    <i class="bi bi-whatsapp" style="color:#fff;font-size:1.6rem"></i>
</a>

@include('partials.chatbot')

<button class="scroll-top" id="scrollTop" aria-label="Kembali ke atas"><i class="bi bi-arrow-up"></i></button>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/chatbot.js') }}"></script>
@stack('scripts')
</body>
</html>
