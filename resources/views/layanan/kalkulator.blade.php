@extends('layouts.app')
@section('title', 'Kalkulator Biaya Wisata Samarinda')

@push('styles')
<style>
/* ── KALKULATOR BIAYA STYLES ─────────────────────────────── */
.calc-preset-card {
    border: 1.5px solid var(--border);
    border-radius: 14px;
    padding: 14px 16px;
    background: #fff;
    cursor: pointer;
    transition: all .2s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}
.calc-preset-card:hover {
    border-color: var(--primary);
    transform: translateY(-3px);
    box-shadow: 0 6px 18px rgba(21,101,192,0.12);
}
.calc-preset-card.active {
    border-color: var(--primary);
    background: #F0F7FF;
    outline: 2px solid var(--primary);
}
.calc-dest-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 10px 14px;
    border: 1.5px solid var(--border);
    border-radius: 12px;
    background: #fff;
    cursor: pointer;
    transition: all .15s ease;
    user-select: none;
}
.calc-dest-item:hover {
    border-color: var(--primary);
    background: #FAFCFE;
}
.calc-dest-item.selected {
    border-color: var(--primary);
    background: #F0F7FF;
}
.calc-dest-item .dest-thumb {
    width: 44px;
    height: 44px;
    border-radius: 9px;
    object-fit: cover;
    flex-shrink: 0;
    background: var(--light-bg);
}
.calc-input-group {
    display: flex;
    align-items: center;
    border: 1.5px solid var(--border);
    border-radius: 10px;
    overflow: hidden;
    background: #fff;
}
.calc-btn-step {
    width: 42px;
    height: 40px;
    background: var(--light-bg);
    border: none;
    color: var(--primary);
    font-size: 1.1rem;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: background .15s;
}
.calc-btn-step:hover {
    background: #DDEBFB;
}
.calc-input-num {
    border: none;
    text-align: center;
    font-weight: 800;
    font-size: 1rem;
    color: var(--primary);
    width: 60px;
    outline: none;
}
.calc-progress-multi {
    height: 12px;
    border-radius: 20px;
    overflow: hidden;
    display: flex;
    background: rgba(255,255,255,0.2);
    margin: 16px 0;
}
.calc-progress-segment {
    height: 100%;
    transition: width .3s ease;
}

/* Print Invoice Style */
@media print {
    header, footer, nav, .page-banner, .btn-d, .wa-float, #splash, .scroll-top {
        display: none !important;
    }
    body {
        background: #fff !important;
        color: #000 !important;
    }
    .print-only {
        display: block !important;
    }
    .no-print {
        display: none !important;
    }
    .calc-summary-box {
        background: #fff !important;
        color: #000 !important;
        border: 2px solid #000 !important;
        box-shadow: none !important;
    }
}
</style>
@endpush

@section('content')
@include('partials.page-banner', [
    'title' => 'Kalkulator Biaya Wisata',
    'bg' => 'hero-bg-3.jpg',
    'badge' => 'Simulasi & Anggaran',
    'sub' => 'Hitung estimasi budget liburan ke Samarinda secara transparan: tiket wisata, penginapan, transportasi, konsumsi, dan oleh-oleh.',
    'crumbs' => [['Kalkulator Biaya']]
])

<section class="section-pad bg-soft">
<div class="container">

    {{-- PAKET REKOMENDASI CEPAT --}}
    <div class="box mb-4 no-print" data-aos="fade-up">
        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
            <div>
                <h5 class="box-title mb-1" style="font-size:1.05rem">
                    <i class="bi bi-magic text-primary me-2"></i>Pilih Paket Rekomendasi Instan (1-Klik)
                </h5>
                <small style="color:var(--text-soft)">Klik salah satu paket di bawah untuk mengisi formulir simulasi secara otomatis, atau atur manual di bawah.</small>
            </div>
            <span class="badge bg-primary-subtle text-primary fw-semibold px-3 py-2" style="font-size:.78rem">
                Otomatis & Fleksibel
            </span>
        </div>

        <div class="row g-3">
            <div class="col-lg-3 col-sm-6">
                <div class="calc-preset-card" onclick="loadPreset('backpacker', this)">
                    <div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span style="font-size:1.5rem;color:var(--primary)"><i class="bi bi-backpack-fill"></i></span>
                            <span class="pill green" style="font-size:.7rem">Super Hemat</span>
                        </div>
                        <h6 style="font-weight:800;color:var(--primary);margin-bottom:4px">Solo Backpacker</h6>
                        <p style="font-size:.78rem;color:var(--text-soft);margin-bottom:8px">1 Orang • 1 Hari • Angkot • Wisata Alam & Gratis</p>
                    </div>
                    <div style="font-size:.84rem;font-weight:800;color:#2E7D32">± Rp 100rb - 150rb</div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6">
                <div class="calc-preset-card" onclick="loadPreset('pasangan', this)">
                    <div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span style="font-size:1.5rem;color:#E65100"><i class="bi bi-heart-fill"></i></span>
                            <span class="pill orange" style="font-size:.7rem">Paling Populer</span>
                        </div>
                        <h6 style="font-weight:800;color:var(--primary);margin-bottom:4px">Liburan Pasangan</h6>
                        <p style="font-size:.78rem;color:var(--text-soft);margin-bottom:8px">2 Orang • 2 Hari 1 Malam • Hotel Bintang 3 • Motor</p>
                    </div>
                    <div style="font-size:.84rem;font-weight:800;color:#E65100">± Rp 500rb / orang</div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6">
                <div class="calc-preset-card" onclick="loadPreset('keluarga', this)">
                    <div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span style="font-size:1.5rem;color:#1565C0"><i class="bi bi-people-fill"></i></span>
                            <span class="pill blue" style="font-size:.7rem">Keluarga</span>
                        </div>
                        <h6 style="font-weight:800;color:var(--primary);margin-bottom:4px">Rombongan Keluarga</h6>
                        <p style="font-size:.78rem;color:var(--text-soft);margin-bottom:8px">4 Orang • 3 Hari 2 Malam • Rental Mobil • Hotel Bintang 4</p>
                    </div>
                    <div style="font-size:.84rem;font-weight:800;color:#1565C0">± Rp 1,1 jt / orang</div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6">
                <div class="calc-preset-card" onclick="loadPreset('eksklusif', this)">
                    <div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span style="font-size:1.5rem;color:#6A1B9A"><i class="bi bi-gem"></i></span>
                            <span class="pill purple" style="font-size:.7rem">Nyaman & Lengkap</span>
                        </div>
                        <h6 style="font-weight:800;color:var(--primary);margin-bottom:4px">Bisnis & Wisata VIP</h6>
                        <p style="font-size:.78rem;color:var(--text-soft);margin-bottom:8px">2 Orang • 2 Hari 1 Malam • Mobil + Supir • Kuliner Premium</p>
                    </div>
                    <div style="font-size:.84rem;font-weight:800;color:#6A1B9A">± Rp 1,5 jt / orang</div>
                </div>
            </div>
        </div>
    </div>

    {{-- FORM SIMULASI & RINGKASAN --}}
    <div class="row g-4">
        {{-- SISI KIRI: INPUT PARAMETER --}}
        <div class="col-lg-7">
            {{-- 1. Parameter Utama --}}
            <div class="box mb-4">
                <h5 class="box-title" style="font-size:1rem"><i class="bi bi-sliders me-2 text-primary"></i>1. Parameter Perjalanan</h5>
                <div class="row g-3">
                    <div class="col-sm-6">
                        <label class="form-label-x"><i class="bi bi-people-fill text-primary me-1"></i> Jumlah Orang</label>
                        <div class="calc-input-group">
                            <button type="button" class="calc-btn-step" onclick="stepVal('orang', -1)">−</button>
                            <input type="number" id="orang" class="form-control calc-input-num flex-fill" value="2" min="1" max="50">
                            <button type="button" class="calc-btn-step" onclick="stepVal('orang', 1)">+</button>
                        </div>
                        <small class="text-muted" style="font-size:.74rem">Tiket dan makan dihitung per orang.</small>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label-x"><i class="bi bi-calendar-range text-primary me-1"></i> Durasi Perjalanan (Hari)</label>
                        <div class="calc-input-group">
                            <button type="button" class="calc-btn-step" onclick="stepVal('hari', -1)">−</button>
                            <input type="number" id="hari" class="form-control calc-input-num flex-fill" value="2" min="1" max="30">
                            <button type="button" class="calc-btn-step" onclick="stepVal('hari', 1)">+</button>
                        </div>
                        <small class="text-muted" style="font-size:.74rem">Malam inap otomatis menyesuaikan.</small>
                    </div>
                </div>
            </div>

            {{-- 2. Akomodasi & Transportasi --}}
            <div class="box mb-4">
                <h5 class="box-title" style="font-size:1rem"><i class="bi bi-truck me-2 text-primary"></i>2. Akomodasi & Transportasi</h5>
                <div class="row g-3">
                    <div class="col-sm-7">
                        <label class="form-label-x"><i class="bi bi-building text-primary me-1"></i> Pilihan Penginapan (per malam)</label>
                        <select id="inap" class="form-input">
                            <option value="0">Tidak Menginap (Pulang Hari) — Rp 0</option>
                            <option value="150000">Homestay / Guest House — Rp 150.000</option>
                            <option value="300000">Hotel Bintang 2 — Rp 300.000</option>
                            <option value="550000" selected>Hotel Bintang 3 (Nyaman) — Rp 550.000</option>
                            <option value="950000">Hotel Bintang 4 (Bisnis / Mewah) — Rp 950.000</option>
                            <option value="1600000">Hotel Bintang 5 / Resort — Rp 1.600.000</option>
                        </select>
                    </div>
                    <div class="col-sm-5">
                        <label class="form-label-x"><i class="bi bi-moon-stars-fill text-primary me-1"></i> Jumlah Malam</label>
                        <div class="calc-input-group">
                            <button type="button" class="calc-btn-step" onclick="stepVal('malam', -1)">−</button>
                            <input type="number" id="malam" class="form-control calc-input-num flex-fill" value="1" min="0" max="30">
                            <button type="button" class="calc-btn-step" onclick="stepVal('malam', 1)">+</button>
                        </div>
                    </div>

                    <div class="col-12">
                        <label class="form-label-x"><i class="bi bi-car-front-fill text-primary me-1"></i> Transportasi Harian di Samarinda</label>
                        <select id="transport" class="form-input">
                            <option value="15000">Angkot / Bus Kota — Rp 15.000 / orang / hari</option>
                            <option value="75000">Sewa Sepeda Motor — Rp 75.000 / unit / hari</option>
                            <option value="250000" selected>Rental Mobil Lepas Kunci — Rp 250.000 / hari</option>
                            <option value="450000">Rental Mobil + Supir & BBM — Rp 450.000 / hari</option>
                            <option value="70000">Taksi Online / Grab / Gojek — Estimasi Rp 70.000 / hari</option>
                            <option value="40000">Kendaraan Pribadi (Bensin & Parkir) — Rp 40.000 / hari</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- 3. Konsumsi & Oleh-oleh Khas --}}
            <div class="box mb-4">
                <h5 class="box-title" style="font-size:1rem"><i class="bi bi-cup-hot-fill me-2 text-primary"></i>3. Konsumsi & Belanja Khas Samarinda</h5>
                <div class="row g-3">
                    <div class="col-sm-6">
                        <label class="form-label-x">Budget Makan (per orang / hari)</label>
                        <select id="makanPreset" class="form-input" onchange="applyMakanPreset(this.value)">
                            <option value="35000">Hemat (Warung Makan / Depot) — Rp 35.000</option>
                            <option value="70000" selected>Standar (Rumah Makan & Cafe) — Rp 70.000</option>
                            <option value="120000">Wisata Kuliner Khas & Seafood — Rp 120.000</option>
                            <option value="custom">Input Manual Lainnya</option>
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label-x">Nominal Makan (Rp / orang / hari)</label>
                        <input type="number" id="makan" class="form-input" value="70000" step="5000" min="0">
                    </div>

                    <div class="col-12">
                        <label class="form-label-x"><i class="bi bi-bag-check-fill text-primary me-1"></i> Budget Belanja Oleh-Oleh Khas (Total Rombongan)</label>
                        <div class="d-flex gap-2 flex-wrap mb-2">
                            <label class="btn btn-sm btn-outline-primary" style="font-size:.78rem;cursor:pointer">
                                <input type="checkbox" id="olehAmplang" value="100000" onchange="hitung()" checked> Amplang Kuku Macan (Rp 100rb)
                            </label>
                            <label class="btn btn-sm btn-outline-primary" style="font-size:.78rem;cursor:pointer">
                                <input type="checkbox" id="olehSarung" value="250000" onchange="hitung()"> Sarung Tenun Samarinda (Rp 250rb)
                            </label>
                            <label class="btn btn-sm btn-outline-primary" style="font-size:.78rem;cursor:pointer">
                                <input type="checkbox" id="olehManik" value="50000" onchange="hitung()"> Souvenir Manik Dayak (Rp 50rb)
                            </label>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="danaDarurat" onchange="hitung()" checked>
                            <label class="form-check-label" for="danaDarurat" style="font-size:.85rem;font-weight:600;color:var(--text-main)">
                                Sertakan Dana Cadangan / Tak Terduga (+10% dari total)
                            </label>
                        </div>
                        <small class="text-muted" style="font-size:.74rem">Sangat disarankan untuk mengantisipasi parkir, jajan spontan, atau keperluan darurat.</small>
                    </div>
                </div>
            </div>

            {{-- 4. Pilihan Destinasi Wisata --}}
            <div class="box mb-4">
                <div class="d-flex justify-content-between align-items-center mb-2 flex-wrap gap-2">
                    <div>
                        <h5 class="box-title mb-0" style="font-size:1rem"><i class="bi bi-ticket-perforated-fill me-2 text-primary"></i>4. Destinasi Wisata yang Dikunjungi</h5>
                        <small style="color:var(--text-soft)">Tarif tiket otomatis dikalikan dengan jumlah orang.</small>
                    </div>
                    <div class="d-flex gap-1">
                        <button type="button" class="btn btn-sm btn-light border py-1 px-2" style="font-size:.75rem" onclick="toggleAllDest(true)">Pilih Semua</button>
                        <button type="button" class="btn btn-sm btn-light border py-1 px-2" style="font-size:.75rem" onclick="toggleAllDest(false)">Reset</button>
                    </div>
                </div>

                <div class="row g-2 mb-3">
                    <div class="col-sm-7">
                        <div style="position:relative">
                            <i class="bi bi-search" style="position:absolute;left:10px;top:50%;transform:translateY(-50%);color:#90A4AE;font-size:.8rem"></i>
                            <input type="text" id="destSearch" oninput="filterDestCards()" placeholder="Cari nama destinasi..."
                                   style="width:100%;padding:6px 10px 6px 30px;border-radius:8px;border:1.5px solid var(--border);font-size:.82rem;outline:none">
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <select id="destCatFilter" onchange="filterDestCards()" class="form-select form-select-sm" style="font-size:.82rem;height:36px">
                            <option value="all">Semua Kategori</option>
                            @foreach($kategoriList as $k)
                                <option value="{{ $k }}">{{ $k }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div id="destList" style="display:flex;flex-direction:column;gap:8px;max-height:360px;overflow-y:auto;padding-right:4px">
                    @foreach($destinasi as $d)
                        <div class="calc-dest-item {{ in_array($d['nama'], ['Tepian Mahakam', 'Islamic Center Samarinda']) ? 'selected' : '' }}"
                             data-cat="{{ $d['kategori'] }}"
                             data-name="{{ strtolower($d['nama']) }}"
                             onclick="toggleDestItem(this)">
                            <input type="checkbox" class="dest-checkbox" data-tarif="{{ $d['tarif'] }}" data-nama="{{ $d['nama'] }}"
                                   style="width:18px;height:18px;accent-color:var(--primary)"
                                   @checked(in_array($d['nama'], ['Tepian Mahakam', 'Islamic Center Samarinda']))>
                            @if($d['gambar'])
                                <img src="{{ $d['gambar'] }}" class="dest-thumb" alt="{{ $d['nama'] }}" onerror="this.src='{{ asset('images/hero/hero-bg-1.jpg') }}'">
                            @else
                                <div class="dest-thumb d-flex align-items-center justify-content-center text-primary" style="font-size:1.3rem">
                                    <i class="bi {{ $d['icon'] }}"></i>
                                </div>
                            @endif
                            <div style="flex:1;min-width:0">
                                <div style="display:flex;justify-content:space-between;align-items:center">
                                    <strong style="font-size:.88rem;color:var(--primary)" class="text-truncate">{{ $d['nama'] }}</strong>
                                    <span class="badge {{ $d['tarif'] == 0 ? 'bg-success' : 'bg-primary' }}" style="font-size:.72rem">
                                        {{ $d['tarif'] == 0 ? 'Gratis' : 'Rp ' . number_format($d['tarif'], 0, ',', '.') }}
                                    </span>
                                </div>
                                <div style="font-size:.74rem;color:var(--text-soft)">
                                    <span class="pill gray py-0 px-2" style="font-size:.68rem">{{ $d['kategori'] }}</span> • <i class="bi bi-clock me-1"></i>{{ $d['durasi'] }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- SISI KANAN: RINGKASAN BIAYA --}}
        <div class="col-lg-5">
            <div style="position:sticky;top:90px">
                {{-- Box Total --}}
                <div class="calc-summary-box" style="background:linear-gradient(135deg,var(--primary-dark),var(--primary) 70%,var(--primary-light));border-radius:18px;padding:26px 24px;color:#fff;box-shadow:0 12px 35px rgba(21,101,192,.28);margin-bottom:20px;position:relative;overflow:hidden">
                    <div style="position:absolute;right:-15px;bottom:-20px;font-size:8rem;opacity:.08;pointer-events:none"><i class="bi bi-wallet2"></i></div>

                    <div style="display:flex;justify-content:space-between;align-items:flex-start">
                        <div>
                            <span style="font-size:.82rem;letter-spacing:.06em;text-transform:uppercase;opacity:.85;font-weight:700">Estimasi Total Biaya</span>
                            <div id="totalBiaya" style="font-size:2.4rem;font-weight:800;line-height:1.2;margin:4px 0">Rp 0</div>
                        </div>
                        <span class="badge bg-light text-primary fw-bold px-3 py-2" id="badgePerOrang" style="font-size:.82rem">
                            Rp 0 / org
                        </span>
                    </div>

                    <div id="subSummary" style="font-size:.82rem;opacity:.88;margin-bottom:12px">
                        Untuk 2 orang, 2 hari (1 malam)
                    </div>

                    {{-- Visual Progress Bar --}}
                    <div class="calc-progress-multi" title="Rasio Pengeluaran">
                        <div id="barInap" class="calc-progress-segment" style="background:#42A5F5;width:30%" title="Akomodasi"></div>
                        <div id="barTrans" class="calc-progress-segment" style="background:#FFA726;width:25%" title="Transportasi"></div>
                        <div id="barMakan" class="calc-progress-segment" style="background:#66BB6A;width:25%" title="Konsumsi"></div>
                        <div id="barTiket" class="calc-progress-segment" style="background:#AB47BC;width:10%" title="Tiket Masuk"></div>
                        <div id="barOleh" class="calc-progress-segment" style="background:#EF5350;width:10%" title="Oleh-oleh"></div>
                    </div>

                    <div style="display:flex;gap:10px;flex-wrap:wrap;font-size:.72rem;opacity:.9;margin-bottom:16px">
                        <span><span style="display:inline-block;width:8px;height:8px;background:#42A5F5;border-radius:2px;margin-right:4px"></span>Penginapan</span>
                        <span><span style="display:inline-block;width:8px;height:8px;background:#FFA726;border-radius:2px;margin-right:4px"></span>Transport</span>
                        <span><span style="display:inline-block;width:8px;height:8px;background:#66BB6A;border-radius:2px;margin-right:4px"></span>Makan</span>
                        <span><span style="display:inline-block;width:8px;height:8px;background:#AB47BC;border-radius:2px;margin-right:4px"></span>Tiket</span>
                        <span><span style="display:inline-block;width:8px;height:8px;background:#EF5350;border-radius:2px;margin-right:4px"></span>Oleh-oleh</span>
                    </div>

                    <hr style="border-color:rgba(255,255,255,0.2);margin:14px 0">

                    {{-- Item Breakdown --}}
                    <div id="rincianBiayaContainer" style="font-size:.85rem">
                        {{-- Diisi secara dinamis oleh JS --}}
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="d-flex flex-column gap-2 no-print">
                    <button class="btn-d btn-blue justify-content-center py-3" onclick="bagikanWhatsApp()" style="font-weight:700">
                        <i class="bi bi-whatsapp"></i> Bagikan Rincian ke WhatsApp
                    </button>
                    <div class="d-flex gap-2">
                        <button class="btn-d btn-light-d flex-fill justify-content-center py-2" onclick="window.print()">
                            <i class="bi bi-printer"></i> Cetak / Simpan PDF
                        </button>
                        <a href="{{ route('itinerary.index') }}" class="btn-d btn-orange flex-fill justify-content-center py-2" title="Susun Jam dan Rute Hariannya">
                            <i class="bi bi-signpost-2-fill"></i> Buka Itinerary
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</section>
@endsection

@push('scripts')
<script>
var rp = function (n) { return 'Rp ' + Math.round(n || 0).toLocaleString('id-ID'); };

function stepVal(id, diff) {
    var el = document.getElementById(id);
    var v = Math.max(+(el.min || 0), Math.min(+(el.max || 999), (+el.value || 0) + diff));
    el.value = v;

    if (id === 'hari') {
        // Otomatis sinkronkan malam inap jika sesuai
        var malamEl = document.getElementById('malam');
        malamEl.value = Math.max(0, v - 1);
    }
    hitung();
}

function applyMakanPreset(val) {
    var makanEl = document.getElementById('makan');
    if (val !== 'custom') {
        makanEl.value = val;
    }
    hitung();
}

function toggleDestItem(div) {
    var chk = div.querySelector('.dest-checkbox');
    // Jika klik langsung di checkbox, biarkan default, jika di card toggle
    if (event.target !== chk) {
        chk.checked = !chk.checked;
    }
    div.classList.toggle('selected', chk.checked);
    hitung();
}

function toggleAllDest(check) {
    document.querySelectorAll('.calc-dest-item').forEach(function(item) {
        var chk = item.querySelector('.dest-checkbox');
        chk.checked = check;
        item.classList.toggle('selected', check);
    });
    hitung();
}

function filterDestCards() {
    var q = (document.getElementById('destSearch').value || '').toLowerCase().trim();
    var cat = document.getElementById('destCatFilter').value;

    document.querySelectorAll('.calc-dest-item').forEach(function(item) {
        var name = item.dataset.name || '';
        var itemCat = item.dataset.cat || '';
        var matchQ = !q || name.includes(q);
        var matchCat = (cat === 'all') || (itemCat === cat);
        item.style.display = (matchQ && matchCat) ? 'flex' : 'none';
    });
}

function loadPreset(type, card) {
    document.querySelectorAll('.calc-preset-card').forEach(function(c) { c.classList.remove('active'); });
    if (card) card.classList.add('active');

    if (type === 'backpacker') {
        document.getElementById('orang').value = 1;
        document.getElementById('hari').value = 1;
        document.getElementById('malam').value = 0;
        document.getElementById('inap').value = '0';
        document.getElementById('transport').value = '15000';
        document.getElementById('makanPreset').value = '35000';
        document.getElementById('makan').value = 35000;
        document.getElementById('olehAmplang').checked = true;
        document.getElementById('olehSarung').checked = false;
        document.getElementById('olehManik').checked = false;
        selectSpecificDest(['Tepian Mahakam', 'Kebun Raya Unmul']);
    } else if (type === 'pasangan') {
        document.getElementById('orang').value = 2;
        document.getElementById('hari').value = 2;
        document.getElementById('malam').value = 1;
        document.getElementById('inap').value = '550000';
        document.getElementById('transport').value = '75000'; // Motor
        document.getElementById('makanPreset').value = '70000';
        document.getElementById('makan').value = 70000;
        document.getElementById('olehAmplang').checked = true;
        document.getElementById('olehSarung').checked = false;
        document.getElementById('olehManik').checked = true;
        selectSpecificDest(['Tepian Mahakam', 'Islamic Center Samarinda', 'Wisata Sungai Mahakam']);
    } else if (type === 'keluarga') {
        document.getElementById('orang').value = 4;
        document.getElementById('hari').value = 3;
        document.getElementById('malam').value = 2;
        document.getElementById('inap').value = '950000'; // Bintang 4
        document.getElementById('transport').value = '250000'; // Mobil
        document.getElementById('makanPreset').value = '70000';
        document.getElementById('makan').value = 70000;
        document.getElementById('olehAmplang').checked = true;
        document.getElementById('olehSarung').checked = true;
        document.getElementById('olehManik').checked = true;
        selectSpecificDest(['Tepian Mahakam', 'Islamic Center Samarinda', 'Kebun Raya Unmul', 'Kampung Kuliner', 'Wisata Sungai Mahakam']);
    } else if (type === 'eksklusif') {
        document.getElementById('orang').value = 2;
        document.getElementById('hari').value = 2;
        document.getElementById('malam').value = 1;
        document.getElementById('inap').value = '950000';
        document.getElementById('transport').value = '450000'; // Supir + BBM
        document.getElementById('makanPreset').value = '120000';
        document.getElementById('makan').value = 120000;
        document.getElementById('olehAmplang').checked = true;
        document.getElementById('olehSarung').checked = true;
        document.getElementById('olehManik').checked = true;
        selectSpecificDest(['Islamic Center Samarinda', 'Wisata Sungai Mahakam', 'Museum Mulawarman']);
    }

    hitung();
}

function selectSpecificDest(names) {
    document.querySelectorAll('.calc-dest-item').forEach(function(item) {
        var chk = item.querySelector('.dest-checkbox');
        var nama = chk.dataset.nama || '';
        var match = names.some(function(n) { return nama.toLowerCase().includes(n.toLowerCase()); });
        chk.checked = match;
        item.classList.toggle('selected', match);
    });
}

function hitung() {
    var orang = Math.max(1, +document.getElementById('orang').value || 1);
    var hari = Math.max(1, +document.getElementById('hari').value || 1);
    var malam = Math.max(0, +document.getElementById('malam').value || 0);

    // 1. Tiket Masuk
    var tiketTotal = 0;
    var destSelectedCount = 0;
    var destNames = [];
    document.querySelectorAll('.dest-checkbox:checked').forEach(function(c) {
        tiketTotal += (+c.dataset.tarif) * orang;
        destSelectedCount++;
        destNames.push(c.dataset.nama);
    });

    // 2. Transport
    var transRate = +document.getElementById('transport').value || 0;
    var transTotal = 0;
    if (transRate === 15000) {
        // Angkot per orang per hari
        transTotal = transRate * orang * hari;
    } else {
        // Sewa unit per hari
        transTotal = transRate * hari;
    }

    // 3. Penginapan
    var inapRate = +document.getElementById('inap').value || 0;
    // Asumsi 1 kamar muat 2 orang
    var kamar = Math.ceil(orang / 2);
    var inapTotal = inapRate * kamar * malam;

    // 4. Makan
    var makanRate = +document.getElementById('makan').value || 0;
    var makanTotal = makanRate * orang * hari;

    // 5. Oleh-oleh
    var olehTotal = 0;
    if (document.getElementById('olehAmplang').checked) olehTotal += 100000;
    if (document.getElementById('olehSarung').checked) olehTotal += 250000;
    if (document.getElementById('olehManik').checked) olehTotal += 50000;

    // Subtotal
    var subtotal = tiketTotal + transTotal + inapTotal + makanTotal + olehTotal;

    // 6. Dana Darurat
    var daruratTotal = 0;
    if (document.getElementById('danaDarurat').checked) {
        daruratTotal = Math.round(subtotal * 0.10);
    }

    var grandTotal = subtotal + daruratTotal;
    var perOrang = Math.round(grandTotal / orang);

    // Tampilkan di UI
    document.getElementById('totalBiaya').textContent = rp(grandTotal);
    document.getElementById('badgePerOrang').textContent = rp(perOrang) + ' / orang';
    document.getElementById('subSummary').textContent = 'Untuk ' + orang + ' orang, ' + hari + ' hari' + (malam > 0 ? ' (' + malam + ' malam)' : ' (tanpa inap)') + ' • ' + destSelectedCount + ' destinasi';

    // Update Progress Bar
    var pInap = grandTotal > 0 ? (inapTotal / grandTotal * 100) : 0;
    var pTrans = grandTotal > 0 ? (transTotal / grandTotal * 100) : 0;
    var pMakan = grandTotal > 0 ? (makanTotal / grandTotal * 100) : 0;
    var pTiket = grandTotal > 0 ? (tiketTotal / grandTotal * 100) : 0;
    var pOleh = grandTotal > 0 ? ((olehTotal + daruratTotal) / grandTotal * 100) : 0;

    document.getElementById('barInap').style.width = pInap + '%';
    document.getElementById('barTrans').style.width = pTrans + '%';
    document.getElementById('barMakan').style.width = pMakan + '%';
    document.getElementById('barTiket').style.width = pTiket + '%';
    document.getElementById('barOleh').style.width = pOleh + '%';

    // Rincian List
    var items = [
        ['<i class="bi bi-building text-info me-1"></i> Penginapan (' + kamar + ' kamar, ' + malam + ' mlm)', inapTotal],
        ['<i class="bi bi-car-front text-warning me-1"></i> Transportasi (' + hari + ' hari)', transTotal],
        ['<i class="bi bi-cup-hot text-success me-1"></i> Konsumsi (' + orang + ' org × ' + hari + ' hr)', makanTotal],
        ['<i class="bi bi-ticket-perforated text-purple me-1"></i> Tiket Destinasi (' + destSelectedCount + ' tempat)', tiketTotal],
        ['<i class="bi bi-bag-check text-danger me-1"></i> Belanja Oleh-Oleh Khas', olehTotal],
    ];
    if (daruratTotal > 0) {
        items.push(['<i class="bi bi-shield-check text-light me-1"></i> Dana Cadangan Tak Terduga (10%)', daruratTotal]);
    }

    var rincianHtml = '';
    items.forEach(function(it) {
        rincianHtml += '<div style="display:flex;justify-content:space-between;padding:7px 0;border-bottom:1px solid rgba(255,255,255,0.12)">'
            + '<span style="opacity:.88">' + it[0] + '</span>'
            + '<strong style="font-weight:700">' + rp(it[1]) + '</strong>'
            + '</div>';
    });
    document.getElementById('rincianBiayaContainer').innerHTML = rincianHtml;
}

function bagikanWhatsApp() {
    var orang = document.getElementById('orang').value;
    var hari = document.getElementById('hari').value;
    var total = document.getElementById('totalBiaya').textContent;
    var perOrg = document.getElementById('badgePerOrang').textContent;

    var destList = [];
    document.querySelectorAll('.dest-checkbox:checked').forEach(function(c) {
        destList.push('- ' + c.dataset.nama);
    });

    var text = '*ESTIMASI BIAYA WISATA SAMARINDA*\n'
        + '-----------------------------------\n'
        + 'Jumlah Orang: ' + orang + ' orang\n'
        + 'Durasi: ' + hari + ' hari\n'
        + 'Destinasi yang dikunjungi:\n' + (destList.length ? destList.join('\n') : '- Belum dipilih') + '\n\n'
        + '*TOTAL ESTIMASI BIAYA: ' + total + '*\n'
        + 'Patungan per orang: ' + perOrg + '\n'
        + '-----------------------------------\n'
        + 'Dihitung via Website Resmi Disporapar Samarinda:\n'
        + window.location.href;

    window.open('https://api.whatsapp.com/send?text=' + encodeURIComponent(text), '_blank');
}

// Event Listeners
document.querySelectorAll('#orang,#hari,#transport,#inap,#malam,#makan').forEach(function(el) {
    el.addEventListener('input', hitung);
    el.addEventListener('change', hitung);
});

// Run initial
hitung();
</script>
@endpush
