<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title') — Pariwisata Samarinda</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
<style>
body{background:#E3F2FD;min-height:100vh;display:flex;align-items:center;justify-content:center;padding:24px;position:relative;overflow:hidden}
.blob{position:fixed;border-radius:50%;filter:blur(80px);animation:blob 9s ease-in-out infinite;z-index:0}
.b1{width:480px;height:480px;background:rgba(21,101,192,.18);top:-120px;left:-120px}
.b2{width:400px;height:400px;background:rgba(30,136,229,.15);bottom:-100px;right:-100px;animation-delay:3s}
.b3{width:260px;height:260px;background:rgba(255,193,7,.12);top:45%;left:60%;animation-delay:1.5s}
@keyframes blob{0%,100%{transform:scale(1) translate(0,0)}50%{transform:scale(1.12) translate(24px,-24px)}}
.wrap{position:relative;z-index:1;width:100%;max-width:450px}
.card-auth{background:rgba(255,255,255,.96);border-radius:24px;padding:42px 38px;box-shadow:0 20px 60px rgba(21,101,192,.18);border:1px solid #fff;animation:up .5s cubic-bezier(.34,1.56,.64,1)}
@keyframes up{from{transform:translateY(28px);opacity:0}to{transform:none;opacity:1}}
.logo{width:74px;height:74px;background:linear-gradient(135deg,#1565C0,#1E88E5);border-radius:20px;display:flex;align-items:center;justify-content:center;margin:0 auto 18px;box-shadow:0 8px 24px rgba(21,101,192,.3);font-size:2.2rem;overflow:hidden}
.logo img{width:54px;height:54px;object-fit:contain}
.field{position:relative;margin-bottom:16px}
.field>i.ic{position:absolute;left:14px;top:50%;transform:translateY(-50%);color:#90CAF9}
.field input{padding-left:42px;background:#F8FBFF}
.field input:focus{background:#fff}
.eye{position:absolute;right:12px;top:50%;transform:translateY(-50%);background:none;border:none;color:#90CAF9;cursor:pointer}
.btn-main{width:100%;padding:13px;background:linear-gradient(135deg,#1565C0,#1E88E5);color:#fff;border:none;border-radius:11px;font-weight:700;font-size:.95rem;display:flex;align-items:center;justify-content:center;gap:8px;cursor:pointer;box-shadow:0 4px 16px rgba(21,101,192,.3);transition:.25s}
.btn-main:hover{transform:translateY(-2px);box-shadow:0 8px 24px rgba(21,101,192,.4)}
.btn-main:disabled{opacity:.75;cursor:wait;transform:none}
.btn-alt{width:100%;padding:11px;border:2px solid var(--primary);border-radius:11px;color:var(--primary);font-weight:600;display:flex;align-items:center;justify-content:center;gap:8px;transition:.25s}
.btn-alt:hover{background:var(--primary);color:#fff}
.sep{position:relative;text-align:center;margin:20px 0}
.sep::before{content:'';position:absolute;top:50%;left:0;right:0;height:1px;background:linear-gradient(90deg,transparent,#BBDEFB,transparent)}
.sep span{background:#fff;padding:0 14px;color:#90A4AE;font-size:.82rem;position:relative}
</style>
</head>
<body>
<div class="blob b1"></div><div class="blob b2"></div><div class="blob b3"></div>
<div class="wrap">
    <div class="text-center mb-3">
        <a href="{{ route('home') }}" style="display:inline-flex;align-items:center;gap:6px;padding:8px 16px;background:rgba(255,255,255,.8);border-radius:20px;font-size:.84rem;font-weight:600;color:var(--primary)"><i class="bi bi-arrow-left"></i> Kembali ke Website</a>
    </div>
    <div class="card-auth">
        <div class="text-center mb-4">
            <div class="logo"><img src="{{ asset('images/logo/logo-disporapar.png') }}" alt="Logo" onerror="this.style.display='none'"></div>
            @yield('heading')
        </div>
        @if(session('success'))<div class="alert-error-box" style="background:#E3F2FD;border-color:#90CAF9;color:#0D47A1">{{ session('success') }}</div>@endif
        @if(session('error'))<div class="alert-error-box">{{ session('error') }}</div>@endif
        @if($errors->any())<div class="alert-error-box"><ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif
        @yield('card')
    </div>
    <p class="text-center mt-3" style="font-size:.78rem;color:rgba(21,101,192,.6)">© {{ date('Y') }} Disporapar Kota Samarinda</p>
</div>
<script>
function toggleEye(id, btn){ var i = document.getElementById(id); i.type = i.type === 'password' ? 'text' : 'password'; btn.firstElementChild.className = i.type === 'password' ? 'bi bi-eye' : 'bi bi-eye-slash'; }
document.querySelectorAll('form').forEach(function(f){ f.addEventListener('submit', function(){ var b = f.querySelector('.btn-main'); if(b){ b.disabled = true; b.innerHTML = 'Memproses...'; } }); });
</script>
</body>
</html>
