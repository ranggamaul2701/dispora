@extends('layouts.app')
@section('title', 'Itinerary Builder — Susun Rencana Liburan Samarinda')

@push('styles')
<style>
/* ── ITINERARY BUILDER STYLES ────────────────────────────── */
.itin-dest-card {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 10px 12px;
    border: 1.5px solid var(--border);
    border-radius: 12px;
    background: #fff;
    margin-bottom: 8px;
    cursor: pointer;
    transition: all .2s ease;
}
.itin-dest-card:hover {
    border-color: var(--primary);
    background: #F8FBFF;
    transform: translateX(3px);
}
.itin-dest-card .thumb {
    width: 48px;
    height: 48px;
    border-radius: 10px;
    object-fit: cover;
    flex-shrink: 0;
    background: var(--light-bg);
}
.itin-day-tab {
    padding: 10px 18px;
    border-radius: 12px;
    border: 1.5px solid var(--border);
    background: #fff;
    color: var(--text-main);
    font-weight: 700;
    font-size: .86rem;
    cursor: pointer;
    transition: all .2s;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    white-space: nowrap;
}
.itin-day-tab.active {
    background: var(--primary);
    color: #fff;
    border-color: var(--primary);
    box-shadow: 0 4px 14px rgba(21,101,192,0.25);
}
.itin-timeline-item {
    display: flex;
    gap: 12px;
    padding: 14px;
    background: #fff;
    border: 1.5px solid var(--border);
    border-radius: 14px;
    margin-bottom: 10px;
    position: relative;
    transition: all .2s ease;
}
.itin-timeline-item:hover {
    border-color: var(--primary);
    box-shadow: 0 4px 14px rgba(0,0,0,0.05);
}
.itin-time-picker {
    border: 1.5px solid var(--border);
    border-radius: 8px;
    padding: 4px 8px;
    font-size: .84rem;
    font-weight: 700;
    color: var(--primary);
    background: #F8FBFF;
    outline: none;
    width: 82px;
}
.itin-order-btn {
    width: 28px;
    height: 28px;
    border-radius: 6px;
    border: 1px solid var(--border);
    background: #fff;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: .75rem;
    color: var(--text-soft);
    cursor: pointer;
    transition: all .15s;
}
.itin-order-btn:hover {
    background: var(--primary);
    color: #fff;
    border-color: var(--primary);
}
.itin-preset-pill {
    padding: 8px 14px;
    border-radius: 10px;
    background: #fff;
    border: 1.5px solid var(--border);
    font-size: .82rem;
    font-weight: 700;
    color: var(--primary);
    cursor: pointer;
    transition: all .2s;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}
.itin-preset-pill:hover {
    background: var(--sky);
    border-color: var(--primary);
    transform: translateY(-2px);
}

/* Print Styles */
@media print {
    header, footer, nav, .page-banner, .btn-d, .wa-float, #splash, .scroll-top, .no-print {
        display: none !important;
    }
    body {
        background: #fff !important;
        color: #000 !important;
    }
    .print-only {
        display: block !important;
    }
    .itin-print-header {
        display: block !important;
        border-bottom: 2px solid #000;
        padding-bottom: 12px;
        margin-bottom: 20px;
    }
    .itin-timeline-item {
        border: 1px solid #ccc !important;
        page-break-inside: avoid;
    }
}
.print-only {
    display: none;
}
</style>
@endpush

@section('content')
@include('partials.page-banner', [
    'title' => 'Itinerary Builder',
    'bg' => 'hero-bg-1.jpg',
    'badge' => 'Perencana Perjalanan',
    'sub' => 'Susun jadwal wisata per hari di Samarinda, atur jam dan rute, lalu ekspor ke Google Maps atau bagikan ke WhatsApp.',
    'crumbs' => [['Itinerary Builder']]
])

<section class="section-pad bg-soft">
<div class="container">

    {{-- KOP CETAK (PRINT ONLY) --}}
    <div class="itin-print-header print-only">
        <div style="display:flex;align-items:center;gap:16px">
            <img src="{{ asset('images/logo/logo-disporapar.png') }}" style="height:60px" alt="Logo">
            <div>
                <h3 style="margin:0;font-weight:800;font-size:1.3rem">Rencana Perjalanan Wisata Kota Samarinda</h3>
                <p style="margin:0;font-size:.85rem;color:#555">Dinas Kepemudaan, Olahraga dan Pariwisata Kota Samarinda</p>
                <div id="printTripInfo" style="font-size:.82rem;font-weight:600;margin-top:4px"></div>
            </div>
        </div>
    </div>

    {{-- REKOMENDASI PRESET ITINERARY (NO-PRINT) --}}
    <div class="box mb-4 no-print" data-aos="fade-up">
        <div class="d-flex justify-content-between align-items-center mb-2 flex-wrap gap-2">
            <div>
                <h5 class="box-title mb-1" style="font-size:1rem"><i class="bi bi-compass-fill text-primary me-2"></i>Rekomendasi Paket Rencana Wisata (1-Klik Siap Pakai)</h5>
                <small style="color:var(--text-soft)">Pilih template siap pakai di bawah, atau susun rencana Anda sendiri dari awal.</small>
            </div>
            <div id="saveStatus" style="font-size:.76rem;font-weight:700;color:#2E7D32;background:#E8F5E9;padding:4px 10px;border-radius:20px">
                <i class="bi bi-cloud-check-fill me-1"></i> Tersimpan Otomatis
            </div>
        </div>

        <div class="d-flex gap-2 flex-wrap pt-1">
            <div class="itin-preset-pill" onclick="loadSampleTrip('1hari')">
                <i class="bi bi-sun-fill text-warning"></i> 1 Hari: Pesona Sungai & Heritage Kota
            </div>
            <div class="itin-preset-pill" onclick="loadSampleTrip('2hari')">
                <i class="bi bi-tree-fill text-success"></i> 2 Hari: Budaya Dayak & Alam Hijau
            </div>
            <div class="itin-preset-pill" onclick="loadSampleTrip('3hari')">
                <i class="bi bi-stars text-primary"></i> 3 Hari: Jelajah Komplit Kota Tepian
            </div>
        </div>
    </div>

    {{-- FORM DATA PERJALANAN & KONTROL HARI --}}
    <div class="row g-4">
        {{-- KOLOM KIRI: KATALOG DESTINASI (NO-PRINT) --}}
        <div class="col-lg-4 no-print">
            <div class="box" style="position:sticky;top:90px">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h5 class="box-title mb-0" style="font-size:.95rem"><i class="bi bi-geo-alt-fill text-primary me-2"></i>Pilih Destinasi</h5>
                    <span class="badge bg-primary-subtle text-primary" style="font-size:.74rem" id="destCountBadge">{{ count($destinasi) }} wisata</span>
                </div>
                <p class="text-muted" style="font-size:.78rem;margin-bottom:12px">
                    Klik tanda <strong>(+)</strong> untuk memasukkan destinasi ke <span id="activeDayText" class="fw-bold text-primary">Hari 1</span>.
                </p>

                {{-- Filter & Search --}}
                <div class="mb-2">
                    <div style="position:relative">
                        <i class="bi bi-search" style="position:absolute;left:10px;top:50%;transform:translateY(-50%);color:#90A4AE;font-size:.78rem"></i>
                        <input type="text" id="itinSearch" oninput="filterItinDest()" placeholder="Cari nama wisata..."
                               style="width:100%;padding:6px 10px 6px 30px;border-radius:8px;border:1.5px solid var(--border);font-size:.82rem;outline:none">
                    </div>
                </div>
                <div class="d-flex gap-1 flex-wrap mb-3" id="itinCatFilterChips">
                    <button class="btn btn-sm btn-primary py-0 px-2 active-chip" style="font-size:.72rem" data-cat="all" onclick="filterItinCat('all', this)">Semua</button>
                    @foreach($kategoriList as $k)
                        <button class="btn btn-sm btn-outline-secondary py-0 px-2" style="font-size:.72rem" data-cat="{{ $k }}" onclick="filterItinCat('{{ $k }}', this)">{{ $k }}</button>
                    @endforeach
                </div>

                {{-- Daftar Destinasi --}}
                <div id="itinDestList" style="max-height:480px;overflow-y:auto;padding-right:4px">
                    @foreach($destinasi as $d)
                        <div class="itin-dest-card"
                             data-cat="{{ $d['kategori'] }}"
                             data-name="{{ strtolower($d['nama']) }}"
                             data-json="{{ json_encode($d) }}"
                             onclick="tambahDestinasi(JSON.parse(this.dataset.json))">
                            @if($d['gambar'])
                                <img src="{{ $d['gambar'] }}" class="thumb" alt="{{ $d['nama'] }}" onerror="this.src='{{ asset('images/hero/hero-bg-1.jpg') }}'">
                            @else
                                <div class="thumb d-flex align-items-center justify-content-center text-primary" style="font-size:1.3rem">
                                    <i class="bi {{ $d['icon'] }}"></i>
                                </div>
                            @endif
                            <div style="flex:1;min-width:0">
                                <div style="font-weight:800;color:var(--primary);font-size:.86rem;line-height:1.25" class="text-truncate">{{ $d['nama'] }}</div>
                                <div style="font-size:.72rem;color:var(--text-soft);margin-top:2px">
                                    <span class="pill gray py-0 px-1" style="font-size:.66rem">{{ $d['kategori'] }}</span> • <span>{{ $d['harga'] }}</span>
                                </div>
                            </div>
                            <button type="button" class="btn btn-sm btn-primary rounded-circle p-0 d-flex align-items-center justify-content-center" style="width:28px;height:28px;flex-shrink:0" title="Tambah ke hari aktif">
                                <i class="bi bi-plus-lg"></i>
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- KOLOM KANAN: ITINERARY BUILDER --}}
        <div class="col-lg-8">
            {{-- Header Perjalanan --}}
            <div class="box mb-3 no-print">
                <div class="row g-3 align-items-end">
                    <div class="col-md-5">
                        <label class="form-label-x">Nama Rencana Perjalanan</label>
                        <input id="tripNama" class="form-input" value="Liburan Seru Samarinda" oninput="saveAndRender()">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label-x">Tanggal Mulai</label>
                        <input id="tripTgl" type="date" class="form-input" onchange="saveAndRender()">
                    </div>
                    <div class="col-md-4 d-flex gap-2">
                        <button class="btn-d btn-blue flex-fill justify-content-center py-2" onclick="bagikanItinWA()" title="Kirim ke WhatsApp">
                            <i class="bi bi-whatsapp"></i> Bagikan
                        </button>
                        <button class="btn-d btn-light-d py-2 px-3" onclick="window.print()" title="Cetak Rencana">
                            <i class="bi bi-printer"></i>
                        </button>
                        <button class="btn-d btn-light-d py-2 px-3 text-danger" onclick="resetSemua()" title="Kosongkan Rencana">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Tab Hari --}}
            <div class="d-flex align-items-center gap-2 mb-3 flex-wrap no-print">
                <div id="dayTabsContainer" class="d-flex gap-2 flex-wrap">
                    {{-- Diisi secara dinamis oleh JS --}}
                </div>
                <button type="button" class="btn btn-sm btn-outline-primary fw-bold px-3 py-2" style="border-radius:12px;font-size:.82rem" onclick="tambahHariBaru()">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Hari
                </button>
            </div>

            {{-- Summary Bar Hari Ini --}}
            <div class="box mb-3 p-3" style="background:#FAFCFE;border-color:var(--border)">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <div class="d-flex align-items-center gap-3 flex-wrap" style="font-size:.84rem">
                        <span><strong id="barHariJudul" style="color:var(--primary);font-size:.95rem">Hari 1</strong></span>
                        <span class="text-muted">•</span>
                        <span><i class="bi bi-geo-alt text-primary me-1"></i><strong id="barDestCount">0</strong> Destinasi</span>
                        <span class="text-muted">•</span>
                        <span><i class="bi bi-clock text-warning me-1"></i>Estimasi: <strong id="barDurasi">0 Jam</strong></span>
                    </div>
                    <div class="d-flex gap-2">
                        <button id="btnGoogleMapsRoute" class="btn btn-sm btn-success fw-bold px-3 py-1" style="font-size:.8rem;border-radius:8px" onclick="bukaRuteGoogleMaps()">
                            <i class="bi bi-map-fill me-1"></i> Buka Rute di Google Maps
                        </button>
                    </div>
                </div>
            </div>

            {{-- Timeline / Agenda List Hari Aktif --}}
            <div id="timelineContainer">
                {{-- Diisi dinamis --}}
            </div>

            <div class="no-print mt-3 text-center">
                <button class="btn btn-outline-primary border-dashed w-100 py-3 fw-bold" style="border-radius:14px;background:#F8FBFF" onclick="scrollKeKatalog()">
                    <i class="bi bi-plus-lg me-1"></i> Tambah Destinasi Lagi ke Hari Ini
                </button>
            </div>
        </div>
    </div>

</div>
</section>
@endsection

@push('scripts')
<script>
// Data Master Destinasi
var masterDestinasi = @json($destinasi);

// Struktur Data Itinerary
// plan = [ [ { id, nama, icon, jam, durasi, harga, alamat, catatan } ], ... ]
var plan = [[]];
var aktifHari = 0; // index 0 = Hari 1

// Inisialisasi Tanggal
var tripTglEl = document.getElementById('tripTgl');
if (tripTglEl && !tripTglEl.value) {
    tripTglEl.value = new Date().toISOString().slice(0, 10);
}

// LocalStorage Key
var STORAGE_KEY = 'disporapar_samarinda_itinerary_v2';

function escHtml(s) {
    if (!s) return '';
    var d = document.createElement('div');
    d.textContent = s;
    return d.innerHTML;
}

function loadSavedPlan() {
    try {
        var raw = localStorage.getItem(STORAGE_KEY);
        if (raw) {
            var data = JSON.parse(raw);
            if (data && Array.isArray(data.plan) && data.plan.length > 0) {
                plan = data.plan;
                aktifHari = Math.min(data.aktifHari || 0, plan.length - 1);
                if (data.tripNama) document.getElementById('tripNama').value = data.tripNama;
                if (data.tripTgl) document.getElementById('tripTgl').value = data.tripTgl;
            }
        }
    } catch (e) {
        console.warn('Gagal memuat local storage', e);
    }
}

function saveToStorage() {
    try {
        var data = {
            tripNama: document.getElementById('tripNama').value,
            tripTgl: document.getElementById('tripTgl').value,
            plan: plan,
            aktifHari: aktifHari
        };
        localStorage.setItem(STORAGE_KEY, JSON.stringify(data));
        var saveEl = document.getElementById('saveStatus');
        if (saveEl) {
            saveEl.innerHTML = '<i class="bi bi-cloud-check-fill me-1"></i> Tersimpan';
        }
    } catch (e) {
        console.warn('Gagal menyimpan local storage', e);
    }
}

function saveAndRender() {
    saveToStorage();
    renderAll();
}

function scrollKeKatalog() {
    var el = document.getElementById('itinDestList');
    if (el) el.scrollIntoView({ behavior: 'smooth' });
}

// ── MANAJEMEN DESTINASI DI HARI ───────────────────────────
function tambahDestinasi(dest) {
    if (!plan[aktifHari]) plan[aktifHari] = [];

    // Cek apakah sudah ada di hari ini
    var exists = plan[aktifHari].some(function(x) { return x.nama === dest.nama; });
    if (exists) {
        alert(dest.nama + ' sudah ada di daftar Hari ' + (aktifHari + 1));
        return;
    }

    // Default jam berurutan
    var defaultJams = ['08:00', '10:30', '13:00', '15:30', '18:00', '20:00'];
    var jam = defaultJams[plan[aktifHari].length] || '16:00';

    plan[aktifHari].push({
        id: dest.id,
        nama: dest.nama,
        kategori: dest.kategori,
        icon: dest.icon || 'bi-geo-alt',
        harga: dest.harga || 'Gratis',
        durasi: dest.durasi || '1 - 2 Jam',
        alamat: dest.alamat || dest.nama + ', Samarinda',
        jam: jam,
        catatan: ''
    });

    saveAndRender();
}

function hapusDestinasi(idx) {
    if (!plan[aktifHari]) return;
    plan[aktifHari].splice(idx, 1);
    saveAndRender();
}

function geserUrutan(idx, diff) {
    var target = idx + diff;
    if (target < 0 || target >= plan[aktifHari].length) return;
    var temp = plan[aktifHari][idx];
    plan[aktifHari][idx] = plan[aktifHari][target];
    plan[aktifHari][target] = temp;
    saveAndRender();
}

function updateJam(idx, val) {
    if (plan[aktifHari] && plan[aktifHari][idx]) {
        plan[aktifHari][idx].jam = val;
        saveToStorage();
    }
}

function updateCatatan(idx, val) {
    if (plan[aktifHari] && plan[aktifHari][idx]) {
        plan[aktifHari][idx].catatan = val;
        saveToStorage();
    }
}

// ── MANAJEMEN TAB HARI ─────────────────────────────────────
function setAktifHari(idx) {
    aktifHari = idx;
    document.getElementById('activeDayText').textContent = 'Hari ' + (idx + 1);
    saveAndRender();
}

function tambahHariBaru() {
    if (plan.length >= 7) {
        alert('Maksimal penyusunan adalah 7 hari.');
        return;
    }
    plan.push([]);
    aktifHari = plan.length - 1;
    saveAndRender();
}

function hapusHari(idx) {
    if (plan.length <= 1) {
        alert('Minimal harus ada 1 hari.');
        return;
    }
    if (confirm('Hapus seluruh rencana di Hari ' + (idx + 1) + '?')) {
        plan.splice(idx, 1);
        aktifHari = Math.min(aktifHari, plan.length - 1);
        saveAndRender();
    }
}

function resetSemua() {
    if (confirm('Kosongkan seluruh rencana perjalanan yang sudah disusun?')) {
        plan = [[]];
        aktifHari = 0;
        localStorage.removeItem(STORAGE_KEY);
        saveAndRender();
    }
}

// ── PRESET SAMPLE TRIPS ───────────────────────────────────
function loadSampleTrip(type) {
    if (type === '1hari') {
        document.getElementById('tripNama').value = '1 Hari: Pesona Sungai & Heritage Samarinda';
        plan = [[
            { nama: 'Islamic Center Samarinda', kategori: 'Wisata Religi', icon: 'bi-building', harga: 'Gratis', durasi: '1 - 2 Jam', alamat: 'Teluk Lerong Ulu, Sungai Kunjang', jam: '08:30', catatan: 'Foto arsitektur megah & menara pemandangan' },
            { nama: 'Kampung Kuliner', kategori: 'Kuliner', icon: 'bi-cup-hot', harga: 'Mulai 15K', durasi: '1 Jam', alamat: 'Jl. Ahmad Dahlan, Samarinda', jam: '12:00', catatan: 'Makan siang Nasi Bekepor khas Kutai' },
            { nama: 'Wisata Sungai Mahakam', kategori: 'Wisata Air', icon: 'bi-compass', harga: 'Rp 50.000', durasi: '2 Jam', alamat: 'Dermaga Pasar Pagi, Samarinda', jam: '15:30', catatan: 'Naik kapal wisata menyusuri Sungai Mahakam' },
            { nama: 'Tepian Mahakam', kategori: 'Wisata Alam', icon: 'bi-water', harga: 'Gratis', durasi: '2 Jam', alamat: 'Jl. Gajah Mada, Samarinda', jam: '18:00', catatan: 'Menikmati sunset & kuliner malam di pinggir sungai' }
        ]];
        aktifHari = 0;
    } else if (type === '2hari') {
        document.getElementById('tripNama').value = '2 Hari: Eksplorasi Budaya & Alam Tropis';
        plan = [
            [
                { nama: 'Islamic Center Samarinda', kategori: 'Wisata Religi', icon: 'bi-building', harga: 'Gratis', durasi: '1.5 Jam', alamat: 'Sungai Kunjang', jam: '09:00', catatan: 'Kunjungan pagi sebelum terik' },
                { nama: 'Tepian Mahakam', kategori: 'Wisata Alam', icon: 'bi-water', harga: 'Gratis', durasi: '2 Jam', alamat: 'Jl. Gajah Mada', jam: '16:00', catatan: 'Santai sore & ngopi di Tepian' }
            ],
            [
                { nama: 'Kebun Raya Unmul', kategori: 'Wisata Alam', icon: 'bi-tree', harga: 'Rp 10.000', durasi: '2 - 3 Jam', alamat: 'Lempake, Samarinda Utara', jam: '09:30', catatan: 'Keliling danau & museum kayu' },
                { nama: 'Kampung Kuliner', kategori: 'Kuliner', icon: 'bi-cup-hot', harga: 'Mulai 15K', durasi: '1.5 Jam', alamat: 'Pasar Pagi', jam: '13:00', catatan: 'Beli oleh-oleh Amplang Kuku Macan' }
            ]
        ];
        aktifHari = 0;
    } else if (type === '3hari') {
        document.getElementById('tripNama').value = '3 Hari: Jelajah Lengkap Samarinda Kota Tepian';
        plan = [
            [
                { nama: 'Islamic Center Samarinda', kategori: 'Wisata Religi', icon: 'bi-building', harga: 'Gratis', durasi: '1.5 Jam', alamat: 'Sungai Kunjang', jam: '09:00', catatan: 'Masjid termegah di Asia Tenggara' },
                { nama: 'Tepian Mahakam', kategori: 'Wisata Alam', icon: 'bi-water', harga: 'Gratis', durasi: '2 Jam', alamat: 'Jl. Gajah Mada', jam: '16:30', catatan: 'Sunset Sungai Mahakam' }
            ],
            [
                { nama: 'Kebun Raya Unmul', kategori: 'Wisata Alam', icon: 'bi-tree', harga: 'Rp 10.000', durasi: '3 Jam', alamat: 'Lempake', jam: '09:00', catatan: 'Eksplorasi flora tropis Kalimantan' },
                { nama: 'Wisata Sungai Mahakam', kategori: 'Wisata Air', icon: 'bi-compass', harga: 'Rp 50.000', durasi: '2 Jam', alamat: 'Dermaga Samarinda', jam: '15:30', catatan: 'Kapal pesiar wisata Mahakam' }
            ],
            [
                { nama: 'Museum Mulawarman', kategori: 'Wisata Budaya', icon: 'bi-bank', harga: 'Rp 5.000', durasi: '2 Jam', alamat: 'Tenggarong / Samarinda Seberang', jam: '10:00', catatan: 'Peninggalan Kesultanan Kutai Kartanegara' },
                { nama: 'Kampung Kuliner', kategori: 'Kuliner', icon: 'bi-cup-hot', harga: 'Mulai 15K', durasi: '2 Jam', alamat: 'Pusat Kota', jam: '13:30', catatan: 'Belanja Sarung Samarinda & souvenir' }
            ]
        ];
        aktifHari = 0;
    }
    saveAndRender();
}

// ── BUKA RUTE GOOGLE MAPS ─────────────────────────────────
function bukaRuteGoogleMaps() {
    var items = plan[aktifHari] || [];
    if (items.length < 1) {
        alert('Tambahkan minimal 1 destinasi pada hari ini untuk membuka rute Google Maps.');
        return;
    }

    var places = items.map(function(it) {
        return encodeURIComponent(it.nama + ', Samarinda');
    });

    // Format: https://www.google.com/maps/dir/Destinasi1/Destinasi2/Destinasi3
    var url = 'https://www.google.com/maps/dir/' + places.join('/');
    window.open(url, '_blank');
}

// ── BAGIKAN KE WHATSAPP ───────────────────────────────────
function bagikanItinWA() {
    var judul = document.getElementById('tripNama').value || 'Itinerary Wisata Samarinda';
    var tgl = document.getElementById('tripTgl').value;

    var text = '🗺️ *' + judul.toUpperCase() + '*\n';
    if (tgl) text += '📅 Mulai Tanggal: ' + tgl + '\n';
    text += '------------------------------------\n\n';

    plan.forEach(function(items, i) {
        text += '📍 *HARI ' + (i + 1) + '* (' + items.length + ' Destinasi):\n';
        if (items.length) {
            items.forEach(function(it) {
                text += '  ⏰ ' + it.jam + ' — ' + it.nama + ' (' + it.harga + ')\n';
                if (it.catatan) text += '     Catatan: ' + it.catatan + '\n';
            });
        } else {
            text += '  (Belum ada jadwal)\n';
        }
        text += '\n';
    });

    text += '------------------------------------\nDisusun via Website Resmi Disporapar Samarinda:\n' + window.location.href;

    window.open('https://api.whatsapp.com/send?text=' + encodeURIComponent(text), '_blank');
}

// ── FILTER KATALOG KIRI ───────────────────────────────────
var activeItinCat = 'all';
function filterItinCat(cat, btn) {
    activeItinCat = cat;
    document.querySelectorAll('#itinCatFilterChips button').forEach(function(b) {
        b.className = 'btn btn-sm btn-outline-secondary py-0 px-2';
    });
    if (btn) btn.className = 'btn btn-sm btn-primary py-0 px-2';
    filterItinDest();
}

function filterItinDest() {
    var q = (document.getElementById('itinSearch').value || '').toLowerCase().trim();
    var cards = document.querySelectorAll('.itin-dest-card');
    var visible = 0;

    cards.forEach(function(c) {
        var name = c.dataset.name || '';
        var cat = c.dataset.cat || '';
        var matchQ = !q || name.includes(q);
        var matchCat = (activeItinCat === 'all') || (cat === activeItinCat);
        if (matchQ && matchCat) {
            c.style.display = 'flex';
            visible++;
        } else {
            c.style.display = 'none';
        }
    });

    document.getElementById('destCountBadge').textContent = visible + ' wisata';
}

// ── RENDER ENGINE ─────────────────────────────────────────
function renderAll() {
    renderTabs();
    renderTimeline();
    renderSummaryBar();
}

function renderTabs() {
    var cont = document.getElementById('dayTabsContainer');
    cont.innerHTML = '';

    plan.forEach(function(items, i) {
        var btn = document.createElement('div');
        btn.className = 'itin-day-tab' + (i === aktifHari ? ' active' : '');
        btn.innerHTML = '<span>Hari ' + (i + 1) + '</span>'
            + '<span class="badge ' + (i === aktifHari ? 'bg-light text-primary' : 'bg-primary-subtle text-primary') + '" style="font-size:.72rem">' + items.length + '</span>'
            + (plan.length > 1 ? '<i class="bi bi-x-circle ms-1" style="font-size:.85rem;opacity:.7" title="Hapus Hari" onclick="event.stopPropagation();hapusHari(' + i + ')"></i>' : '');

        btn.onclick = function() { setAktifHari(i); };
        cont.appendChild(btn);
    });

    document.getElementById('activeDayText').textContent = 'Hari ' + (aktifHari + 1);
}

function renderSummaryBar() {
    var items = plan[aktifHari] || [];
    document.getElementById('barHariJudul').textContent = 'Jadwal Hari ' + (aktifHari + 1);
    document.getElementById('barDestCount').textContent = items.length;

    // Estimasi hitungan durasi (ambil angka durasi jika ada)
    var totalJam = 0;
    items.forEach(function(it) {
        var match = (it.durasi || '').match(/(\d+)/);
        totalJam += match ? +match[1] : 1.5;
    });
    document.getElementById('barDurasi').textContent = (totalJam > 0 ? totalJam + ' Jam' : '0 Jam');

    // Update Print Info
    var pInfo = document.getElementById('printTripInfo');
    if (pInfo) {
        pInfo.textContent = document.getElementById('tripNama').value + ' • Tanggal: ' + document.getElementById('tripTgl').value + ' • Total ' + plan.length + ' Hari';
    }
}

function renderTimeline() {
    var cont = document.getElementById('timelineContainer');
    var items = plan[aktifHari] || [];

    if (!items.length) {
        cont.innerHTML = '<div class="box text-center py-5" style="border:2px dashed var(--border);border-radius:18px">'
            + '<i class="bi bi-signpost-split" style="font-size:3rem;color:#90A4AE;display:block;margin-bottom:12px"></i>'
            + '<h6 style="font-weight:700;color:var(--text-main);margin-bottom:6px">Hari ' + (aktifHari + 1) + ' masih kosong</h6>'
            + '<p style="font-size:.85rem;color:var(--text-soft);max-width:380px;margin:0 auto 16px">Pilih destinasi dari daftar di sebelah kiri untuk menyusun rute dan jadwal kegiatan hari ini.</p>'
            + '<button class="btn-d btn-blue py-2 px-3" style="font-size:.82rem" onclick="scrollKeKatalog()"><i class="bi bi-plus-circle me-1"></i> Pilih Dari Katalog</button>'
            + '</div>';
        return;
    }

    var html = '';
    items.forEach(function(it, idx) {
        var iconClass = (it.icon && it.icon.startsWith('bi-')) ? it.icon : 'bi-geo-alt';

        html += '<div class="itin-timeline-item">'
            + '<div class="d-flex flex-column align-items-center gap-1" style="flex-shrink:0">'
                + '<input type="time" class="itin-time-picker" value="' + it.jam + '" onchange="updateJam(' + idx + ', this.value)" title="Ubah jam">'
                + '<div class="d-flex flex-column gap-1 mt-1 no-print">'
                    + (idx > 0 ? '<button class="itin-order-btn" onclick="geserUrutan(' + idx + ', -1)" title="Geser ke atas"><i class="bi bi-chevron-up"></i></button>' : '')
                    + (idx < items.length - 1 ? '<button class="itin-order-btn" onclick="geserUrutan(' + idx + ', 1)" title="Geser ke bawah"><i class="bi bi-chevron-down"></i></button>' : '')
                + '</div>'
            + '</div>'

            + '<div style="flex:1;min-width:0">'
                + '<div class="d-flex justify-content-between align-items-start gap-2 mb-1">'
                    + '<div>'
                        + '<span class="pill blue py-0 px-2 mb-1" style="font-size:.7rem">' + escHtml(it.kategori || 'Destinasi') + '</span>'
                        + '<h6 style="font-weight:800;color:var(--primary);margin:2px 0 0;font-size:1rem">' + escHtml(it.nama) + '</h6>'
                    + '</div>'
                    + '<button class="btn btn-sm btn-link text-danger p-0 no-print" onclick="hapusDestinasi(' + idx + ')" title="Hapus dari jadwal">'
                        + '<i class="bi bi-trash" style="font-size:1.1rem"></i>'
                    + '</button>'
                + '</div>'

                + '<div style="font-size:.78rem;color:var(--text-soft);margin-bottom:8px">'
                    + '<span><i class="bi bi-ticket-perforated text-success me-1"></i>' + escHtml(it.harga) + '</span> • '
                    + '<span><i class="bi bi-clock text-warning me-1"></i>' + escHtml(it.durasi) + '</span> • '
                    + '<span><i class="bi bi-geo-alt text-danger me-1"></i>' + escHtml(it.alamat) + '</span>'
                + '</div>'

                + '<div class="no-print">'
                    + '<input type="text" class="form-control form-control-sm" style="font-size:.78rem;border-radius:8px;background:#F8FBFF" '
                        + 'placeholder="Tambahkan catatan perjalanan (mis: bawa kamera, beli tiket online)..." '
                        + 'value="' + escHtml(it.catatan || '') + '" oninput="updateCatatan(' + idx + ', this.value)">'
                + '</div>'
                + (it.catatan ? '<div class="print-only mt-1" style="font-size:.8rem;color:#444"><strong>Catatan:</strong> ' + escHtml(it.catatan) + '</div>' : '')
            + '</div>'
        + '</div>';
    });

    cont.innerHTML = html;
}

// Inisialisasi saat halaman dimuat
loadSavedPlan();
renderAll();
</script>
@endpush
