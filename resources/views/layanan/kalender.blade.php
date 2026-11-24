@extends('layouts.app')
@section('title', 'Kalender Event')

@section('content')
@include('partials.page-banner', ['title' => 'Kalender Event Wisata', 'bg' => 'hero-bg-3.jpg', 'badge' => 'Jadwal Event', 'sub' => 'Lihat jadwal event dan festival per bulan.', 'crumbs' => [['Kalender']]])

<section class="section-pad bg-soft">
<div class="container"><div class="row g-4">
    <div class="col-lg-8">
        <div class="box">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <button class="btn-accent" onclick="gantiBulan(-1)" aria-label="Bulan sebelumnya">‹</button>
                <h5 id="calTitle" style="font-weight:800;color:var(--primary);margin:0"></h5>
                <button class="btn-accent" onclick="gantiBulan(1)" aria-label="Bulan berikutnya">›</button>
            </div>
            <div style="display:grid;grid-template-columns:repeat(7,1fr);gap:5px;margin-bottom:6px">
                @foreach(['Min','Sen','Sel','Rab','Kam','Jum','Sab'] as $h)<div style="text-align:center;font-size:.74rem;font-weight:700;color:var(--text-soft)">{{ $h }}</div>@endforeach
            </div>
            <div id="calGrid" style="display:grid;grid-template-columns:repeat(7,1fr);gap:5px"></div>
            <button class="chip mt-3" onclick="keHariIni()">Hari ini</button>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="box">
            <h5 class="box-title" id="sideTitle" style="font-size:.95rem"></h5>
            <div id="sideList"></div>
        </div>
    </div>
</div></div>
</section>
@endsection

@push('scripts')
<script>
var events = @json($events), bulanNama = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
var cur = new Date(); cur.setDate(1);
var iso = function (d) { return d.getFullYear() + '-' + String(d.getMonth() + 1).padStart(2, '0') + '-' + String(d.getDate()).padStart(2, '0'); };
function gantiBulan(n) { cur.setMonth(cur.getMonth() + n); render(); }
function keHariIni() { cur = new Date(); cur.setDate(1); render(); }
function esc(s) { var d = document.createElement('div'); d.textContent = s == null ? '' : s; return d.innerHTML; }
function render() {
    var y = cur.getFullYear(), m = cur.getMonth(), first = new Date(y, m, 1).getDay(), last = new Date(y, m + 1, 0).getDate(), today = iso(new Date());
    document.getElementById('calTitle').textContent = bulanNama[m] + ' ' + y;
    document.getElementById('sideTitle').textContent = 'Event ' + bulanNama[m];
    var g = document.getElementById('calGrid'); g.innerHTML = '';
    for (var i = 0; i < first; i++) g.appendChild(document.createElement('div'));
    for (var d = 1; d <= last; d++) {
        var ds = y + '-' + String(m + 1).padStart(2, '0') + '-' + String(d).padStart(2, '0');
        var ev = events.filter(function (e) { return ds >= e.mulai && ds <= e.selesai; });
        var c = document.createElement('div');
        c.style.cssText = 'height:48px;border-radius:9px;display:flex;flex-direction:column;align-items:center;justify-content:center;font-size:.83rem;font-weight:600;' + (ds === today ? 'background:var(--primary);color:#fff;' : '') + (ev.length ? 'cursor:pointer;background:' + (ds === today ? 'var(--primary)' : 'var(--sky)') + ';' : '');
        c.innerHTML = '<span>' + d + '</span>' + (ev.length ? '<span style="width:6px;height:6px;border-radius:50%;background:var(--accent);margin-top:2px"></span>' : '');
        if (ev.length) c.onclick = (function (e) { return function () { window.location = e[0].url; }; })(ev);
        g.appendChild(c);
    }
    var bulan = events.filter(function (e) { return e.mulai.slice(0, 7) <= y + '-' + String(m + 1).padStart(2, '0') && e.selesai.slice(0, 7) >= y + '-' + String(m + 1).padStart(2, '0'); });
    document.getElementById('sideList').innerHTML = bulan.length ? bulan.map(function (e) {
        var icHtml = e.icon && e.icon.startsWith('bi-') ? '<i class="bi ' + esc(e.icon) + ' me-1"></i>' : '<i class="bi bi-calendar-event me-1"></i>';
        return '<a href="' + esc(e.url) + '" style="display:block;padding:11px;border:1.5px solid var(--border);border-radius:11px;margin-bottom:9px;color:inherit"><div style="font-weight:800;color:var(--primary);font-size:.86rem">' + icHtml + ' ' + esc(e.nama) + '</div><div style="font-size:.76rem;color:var(--text-soft)"><i class="bi bi-calendar3 me-1 text-primary"></i>' + esc(e.mulai) + (e.mulai !== e.selesai ? ' → ' + esc(e.selesai) : '') + '</div><div style="font-size:.76rem;color:var(--text-soft)"><i class="bi bi-geo-alt me-1 text-primary"></i>' + esc(e.lokasi) + '</div></a>';
    }).join('') : '<div class="text-muted text-center py-4" style="font-size:.88rem">Tidak ada event bulan ini</div>';
}
render();
</script>
@endpush
