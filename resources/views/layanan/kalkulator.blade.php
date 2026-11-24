@extends('layouts.app')
@section('title', 'Kalkulator Biaya Wisata')

@section('content')
@include('partials.page-banner', ['title' => 'Kalkulator Biaya Wisata', 'bg' => 'hero-bg-3.jpg', 'badge' => 'Rencanakan Wisata', 'sub' => 'Perkirakan biaya perjalanan Anda ke Samarinda dengan cepat.', 'crumbs' => [['Kalkulator']]])

<section class="section-pad bg-soft">
<div class="container"><div class="row g-4">
    <div class="col-lg-6">
        <div class="box">
            <h4 class="box-title"><i class="bi bi-sliders me-2"></i>Pengaturan Perjalanan</h4>
            <div class="row g-3 mb-3">
                <div class="col-6"><label class="form-label-x"><i class="bi bi-people-fill me-1"></i>Jumlah Orang</label><input type="number" id="orang" class="form-input" value="2" min="1" max="50"></div>
                <div class="col-6"><label class="form-label-x"><i class="bi bi-calendar-range me-1"></i>Jumlah Hari</label><input type="number" id="hari" class="form-input" value="1" min="1" max="30"></div>
            </div>
            <label class="form-label-x"><i class="bi bi-geo-alt-fill me-1"></i>Pilih Destinasi (tarif tiket per orang)</label>
            <div id="destList" style="display:flex;flex-direction:column;gap:8px;margin-bottom:18px">
                @foreach($destinasi as $d)
                    @php
                        preg_match_all('/\d[\d.]*/', $d->harga, $m);
                        $angka = collect($m[0])->map(fn ($x) => (int) str_replace('.', '', $x))->filter()->values();
                        $tarif = $angka->first() ?? 0;
                    @endphp
                    <label style="display:flex;align-items:center;gap:12px;padding:11px 14px;border:1.5px solid var(--border);border-radius:11px;cursor:pointer">
                        <input type="checkbox" data-tarif="{{ $tarif }}" style="width:18px;height:18px;accent-color:var(--primary)">
                        <span style="font-size:1.2rem;color:var(--primary)">@if(str_starts_with($d->icon ?? '', 'bi-'))<i class="bi {{ $d->icon }}"></i>@else<i class="bi bi-geo-alt"></i>@endif</span>
                        <span style="flex:1"><strong style="font-size:.9rem">{{ $d->nama }}</strong><br><small class="text-muted">{{ $d->harga }}</small></span>
                    </label>
                @endforeach
            </div>
            <label class="form-label-x"><i class="bi bi-car-front-fill me-1"></i>Transportasi (per hari)</label>
            <select id="transport" class="form-input mb-3">
                <option value="15000">Angkot / Bus — Rp 15.000</option>
                <option value="75000">Rental Motor — Rp 75.000</option>
                <option value="250000">Rental Mobil — Rp 250.000</option>
                <option value="50000">Grab / Gojek — Rp 50.000</option>
            </select>
            <label class="form-label-x"><i class="bi bi-building me-1"></i>Akomodasi (per malam)</label>
            <select id="inap" class="form-input mb-3">
                <option value="0">Tidak menginap</option>
                <option value="150000">Homestay — Rp 150.000</option>
                <option value="350000">Hotel Bintang 2 — Rp 350.000</option>
                <option value="600000">Hotel Bintang 3 — Rp 600.000</option>
                <option value="1200000">Hotel Bintang 4 — Rp 1.200.000</option>
            </select>
            <label class="form-label-x"><i class="bi bi-moon-stars-fill me-1"></i>Jumlah malam menginap</label>
            <input type="number" id="malam" class="form-input mb-3" value="1" min="0" max="30">
            <label class="form-label-x"><i class="bi bi-cup-hot-fill me-1"></i>Makan per orang per hari</label>
            <input type="number" id="makan" class="form-input" value="50000" min="0" step="5000">
        </div>
    </div>
    <div class="col-lg-6">
        <div style="background:linear-gradient(135deg,var(--primary),var(--primary-light));border-radius:var(--radius);padding:30px;margin-bottom:24px;box-shadow:0 8px 32px rgba(21,101,192,.28)">
            <div style="color:rgba(255,255,255,.8);font-size:.85rem"><i class="bi bi-wallet2 me-1"></i>Estimasi Total Biaya</div>
            <div id="total" style="font-size:2.5rem;font-weight:800;color:#fff;line-height:1.2">Rp 0</div>
            <div id="sub" style="color:rgba(255,255,255,.7);font-size:.85rem"></div>
            <hr style="border-color:rgba(255,255,255,.2)">
            <div id="rincian"></div>
        </div>
        <div class="box">
            <h5 class="box-title" style="font-size:.95rem"><i class="bi bi-lightbulb-fill me-2 text-warning"></i>Tips Hemat</h5>
            @foreach(['Kunjungi saat hari kerja agar lebih sepi dan hemat.','Bawa bekal ke Kebun Raya untuk menghemat biaya makan.','Gunakan angkot untuk destinasi di pusat kota.','Tepian Mahakam gratis dan buka 24 jam.'] as $t)<p style="font-size:.86rem;color:var(--text-soft);margin-bottom:8px"><i class="bi bi-check-circle-fill text-success me-2"></i>{{ $t }}</p>@endforeach
        </div>
        <div class="d-flex gap-2"><a href="{{ route('itinerary.index') }}" class="btn-accent flex-fill justify-content-center"><i class="bi bi-signpost-split"></i> Susun Itinerary</a><button class="btn-accent flex-fill justify-content-center" style="background:var(--text-soft)" onclick="window.print()"><i class="bi bi-printer"></i> Cetak</button></div>
    </div>
</div></div>
</section>
@endsection

@push('scripts')
<script>
var rp = function (n) { return 'Rp ' + Math.round(n).toLocaleString('id-ID'); };
function hitung() {
    var orang = Math.max(1, +document.getElementById('orang').value || 1), hari = Math.max(1, +document.getElementById('hari').value || 1);
    var tiket = 0; document.querySelectorAll('#destList input:checked').forEach(function (c) { tiket += (+c.dataset.tarif) * orang; });
    var makan = (+document.getElementById('makan').value || 0) * orang * hari;
    var trans = (+document.getElementById('transport').value) * hari;
    var malam = Math.max(0, +document.getElementById('malam').value || 0);
    var inap = (+document.getElementById('inap').value) * malam;
    var total = tiket + makan + trans + inap;
    document.getElementById('total').textContent = rp(total);
    document.getElementById('sub').textContent = 'untuk ' + orang + ' orang, ' + hari + ' hari (≈ ' + rp(total / orang) + ' / orang)';
    document.getElementById('rincian').innerHTML = [
        ['<i class="bi bi-ticket-perforated me-1"></i> Tiket masuk', tiket],
        ['<i class="bi bi-cup-hot me-1"></i> Makan', makan],
        ['<i class="bi bi-car-front me-1"></i> Transportasi', trans],
        ['<i class="bi bi-building me-1"></i> Akomodasi (' + malam + ' malam)', inap]
    ].map(function (r) {
        return '<div style="display:flex;justify-content:space-between;color:#fff;font-size:.88rem;margin-bottom:8px"><span style="opacity:.8">' + r[0] + '</span><strong>' + rp(r[1]) + '</strong></div>';
    }).join('');
}
document.querySelectorAll('#orang,#hari,#transport,#inap,#malam,#makan,#destList input').forEach(function (el) { el.addEventListener('input', hitung); el.addEventListener('change', hitung); });
hitung();
</script>
@endpush
