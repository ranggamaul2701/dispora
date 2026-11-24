@extends('layouts.app')
@section('title', 'Kalender Event Wisata Samarinda')

@push('styles')
<style>
/* ── KALENDER EVENT STYLES ───────────────────────────────── */
.cal-wrapper {
    background: #fff;
    border-radius: 18px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.06);
    border: 1px solid var(--border);
    overflow: hidden;
}
.cal-top-bar {
    padding: 20px 24px;
    background: #fff;
    border-bottom: 1px solid var(--border);
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 14px;
}
.cal-nav-btn {
    width: 38px;
    height: 38px;
    border-radius: 10px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: var(--light-bg);
    border: 1px solid var(--border);
    color: var(--primary);
    font-size: 1.1rem;
    transition: all .2s ease;
}
.cal-nav-btn:hover {
    background: var(--primary);
    color: #fff;
    border-color: var(--primary);
}
.cal-month-title {
    font-size: 1.35rem;
    font-weight: 800;
    color: var(--primary);
    margin: 0;
    letter-spacing: -0.01em;
}
.cal-filter-bar {
    padding: 14px 24px;
    background: #FAFCFE;
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
}
.cal-cat-chip {
    padding: 6px 14px;
    border-radius: 20px;
    font-size: .8rem;
    font-weight: 600;
    border: 1.5px solid var(--border);
    background: #fff;
    color: var(--text-soft);
    cursor: pointer;
    transition: all .2s;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}
.cal-cat-chip.active {
    background: var(--primary);
    color: #fff;
    border-color: var(--primary);
    box-shadow: 0 4px 12px rgba(21,101,192,0.25);
}
.cal-view-switch {
    display: inline-flex;
    background: #EBF3FC;
    padding: 3px;
    border-radius: 10px;
}
.cal-view-btn {
    padding: 6px 14px;
    border-radius: 8px;
    font-size: .8rem;
    font-weight: 700;
    border: none;
    background: transparent;
    color: var(--primary);
    cursor: pointer;
    transition: all .2s;
}
.cal-view-btn.active {
    background: #fff;
    color: var(--primary);
    box-shadow: 0 2px 6px rgba(0,0,0,0.08);
}

/* Grid Kalender */
.cal-grid-header {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    background: #F4F8FC;
    border-bottom: 1px solid var(--border);
}
.cal-grid-header-cell {
    text-align: center;
    padding: 12px 6px;
    font-size: .8rem;
    font-weight: 700;
    color: var(--text-soft);
    text-transform: uppercase;
    letter-spacing: .06em;
}
.cal-grid-header-cell.weekend {
    color: #E53935;
}
.cal-grid-body {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    background: #ECEFF1;
    gap: 1px;
}
.cal-cell {
    background: #fff;
    min-height: 105px;
    padding: 8px 6px;
    position: relative;
    cursor: pointer;
    transition: background .15s ease;
    display: flex;
    flex-direction: column;
}
.cal-cell:hover {
    background: #F8FBFF;
}
.cal-cell.other-month {
    background: #FAFAFA;
    opacity: 0.45;
}
.cal-cell.is-today {
    background: #F0F7FF;
}
.cal-cell.is-selected {
    outline: 2.5px solid var(--primary);
    outline-offset: -2.5px;
    background: #EBF4FF !important;
    z-index: 2;
}
.cal-cell-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 4px;
}
.cal-cell-num {
    font-size: .88rem;
    font-weight: 700;
    width: 26px;
    height: 26px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text-main);
}
.cal-cell.is-today .cal-cell-num {
    background: var(--primary);
    color: #fff;
    font-weight: 800;
}
.cal-cell.weekend .cal-cell-num {
    color: #D32F2F;
}
.cal-cell.is-today.weekend .cal-cell-num {
    color: #fff;
}
.cal-event-pill {
    padding: 3px 6px;
    border-radius: 6px;
    font-size: .72rem;
    font-weight: 700;
    margin-bottom: 3px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    border-left: 3px solid var(--primary);
    background: #E8F1FC;
    color: var(--primary);
    transition: transform .15s;
    line-height: 1.25;
}
.cal-event-pill:hover {
    transform: scale(1.02);
}
.cal-event-pill.budaya { border-left-color: #8E24AA; background: #F3E5F5; color: #6A1B9A; }
.cal-event-pill.festival { border-left-color: #E65100; background: #FFF3E0; color: #E65100; }
.cal-event-pill.olahraga { border-left-color: #2E7D32; background: #E8F5E9; color: #1B5E20; }
.cal-event-pill.religi { border-left-color: #00897B; background: #E0F2F1; color: #00695C; }
.cal-event-pill.kuliner { border-left-color: #C2185B; background: #FCE4EC; color: #880E4F; }

/* Mobile dots */
.cal-dots-container {
    display: none;
    gap: 3px;
    margin-top: auto;
    justify-content: center;
}
.cal-dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: var(--primary);
}

/* Sidebar List */
.cal-side-header {
    padding: 18px 20px;
    border-bottom: 1px solid var(--border);
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #fff;
    border-radius: 18px 18px 0 0;
}
.cal-side-card {
    background: #fff;
    border-radius: 14px;
    border: 1.5px solid var(--border);
    padding: 16px;
    margin-bottom: 12px;
    transition: all .25s ease;
    position: relative;
    overflow: hidden;
}
.cal-side-card:hover {
    border-color: var(--primary);
    box-shadow: 0 6px 18px rgba(21,101,192,0.12);
    transform: translateY(-2px);
}
.cal-side-card.active-match {
    border-color: var(--accent);
    background: #FFFAF0;
}
.cal-side-card .card-thumb {
    width: 68px;
    height: 68px;
    border-radius: 10px;
    object-fit: cover;
    flex-shrink: 0;
    background: var(--light-bg);
}

/* Responsive */
@media (max-width: 991px) {
    .cal-cell {
        min-height: 70px;
        padding: 4px 2px;
    }
    .cal-event-pill {
        display: none;
    }
    .cal-dots-container {
        display: flex;
    }
}
</style>
@endpush

@section('content')
@include('partials.page-banner', [
    'title' => 'Kalender Event Pariwisata',
    'bg' => 'hero-bg-3.jpg',
    'badge' => 'Jadwal & Agenda',
    'sub' => 'Temukan festival budaya, pagelaran seni, konser, dan agenda pariwisata Kota Samarinda sepanjang tahun.',
    'crumbs' => [['Kalender Event']]
])

<section class="section-pad bg-soft">
<div class="container">

    {{-- TOP HIGHLIGHT BANNER --}}
    <div class="row g-4 mb-4">
        <div class="col-lg-12">
            <div style="background:linear-gradient(135deg,var(--primary-dark),var(--primary) 65%,var(--primary-light));border-radius:18px;padding:24px 30px;color:#fff;box-shadow:0 8px 25px rgba(21,101,192,.22);position:relative;overflow:hidden">
                <div style="position:absolute;right:-20px;bottom:-30px;font-size:10rem;opacity:.07;pointer-events:none"><i class="bi bi-calendar-event"></i></div>
                <div class="row align-items-center g-3">
                    <div class="col-md-8">
                        <div style="display:inline-flex;align-items:center;gap:8px;background:rgba(255,255,255,.16);padding:4px 12px;border-radius:20px;font-size:.78rem;font-weight:700;margin-bottom:10px">
                            <i class="bi bi-bell-fill text-warning"></i> Info Pariwisata Samarinda
                        </div>
                        <h3 style="font-weight:800;margin-bottom:6px;font-size:1.45rem">Jangan Lewatkan Kemeriahan Kota Tepian!</h3>
                        <p style="margin:0;opacity:.88;font-size:.9rem;max-width:620px">
                            Pilih tanggal di kalender untuk melihat event hari tersebut, simpan agenda ke Google Calendar Anda, atau bagikan jadwalnya ke teman dan keluarga.
                        </p>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <a href="{{ route('agenda.index') }}" class="btn-d" style="background:var(--accent);color:var(--primary-dark);font-weight:700">
                            <i class="bi bi-list-stars"></i> Semua Daftar Agenda
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MAIN CALENDAR & SIDEBAR --}}
    <div class="row g-4">
        {{-- KOLOM KALENDER --}}
        <div class="col-xl-8 col-lg-7">
            <div class="cal-wrapper">
                {{-- TOP CONTROLS --}}
                <div class="cal-top-bar">
                    <div class="d-flex align-items-center gap-2">
                        <button class="cal-nav-btn" onclick="gantiBulan(-1)" title="Bulan Sebelumnya"><i class="bi bi-chevron-left"></i></button>
                        <h4 class="cal-month-title" id="calTitle">November 2026</h4>
                        <button class="cal-nav-btn" onclick="gantiBulan(1)" title="Bulan Berikutnya"><i class="bi bi-chevron-right"></i></button>
                    </div>
                    <div class="d-flex align-items-center gap-2 flex-wrap">
                        <button class="btn-d btn-light-d py-1 px-3" style="font-size:.82rem" onclick="keHariIni()">
                            <i class="bi bi-calendar-check text-primary"></i> Hari Ini
                        </button>
                        <div class="cal-view-switch">
                            <button id="btnViewGrid" class="cal-view-btn active" onclick="switchView('grid')"><i class="bi bi-calendar3 me-1"></i> Kalender</button>
                            <button id="btnViewList" class="cal-view-btn" onclick="switchView('list')"><i class="bi bi-list-ul me-1"></i> Daftar</button>
                        </div>
                    </div>
                </div>

                {{-- FILTER BAR --}}
                <div class="cal-filter-bar">
                    <div class="d-flex align-items-center gap-2 flex-wrap" id="catChipsContainer">
                        <button class="cal-cat-chip active" data-cat="all" onclick="filterKategori('all', this)">
                            Semua ({{ count($events) }})
                        </button>
                        @foreach($kategoriList as $k)
                            @php
                                $cnt = collect($events)->where('kat', $k)->count();
                            @endphp
                            @if($cnt > 0)
                                <button class="cal-cat-chip" data-cat="{{ $k }}" onclick="filterKategori('{{ $k }}', this)">
                                    {{ $k }} ({{ $cnt }})
                                </button>
                            @endif
                        @endforeach
                    </div>
                    <div style="position:relative;min-width:200px">
                        <i class="bi bi-search" style="position:absolute;left:10px;top:50%;transform:translateY(-50%);color:#90A4AE;font-size:.82rem"></i>
                        <input type="text" id="eventSearchInput" oninput="cariEvent(this.value)" placeholder="Cari nama event..."
                               style="width:100%;padding:6px 12px 6px 30px;border-radius:20px;border:1px solid var(--border);font-size:.8rem;outline:none">
                    </div>
                </div>

                {{-- VIEW GRID (BULANAN) --}}
                <div id="viewGridContainer">
                    <div class="cal-grid-header">
                        <div class="cal-grid-header-cell">Sen</div>
                        <div class="cal-grid-header-cell">Sel</div>
                        <div class="cal-grid-header-cell">Rab</div>
                        <div class="cal-grid-header-cell">Kam</div>
                        <div class="cal-grid-header-cell">Jum</div>
                        <div class="cal-grid-header-cell weekend">Sab</div>
                        <div class="cal-grid-header-cell weekend">Min</div>
                    </div>
                    <div id="calGrid" class="cal-grid-body"></div>
                </div>

                {{-- VIEW LIST (DAFTAR TIMELINE) --}}
                <div id="viewListContainer" style="display:none;padding:20px">
                    <div id="timelineList"></div>
                </div>

                {{-- FOOTER KALENDER (LEGENDA) --}}
                <div style="padding:14px 24px;background:#FAFCFE;border-top:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px;font-size:.78rem;color:var(--text-soft)">
                    <div class="d-flex align-items-center gap-3 flex-wrap">
                        <span><span style="display:inline-block;width:10px;height:10px;border-radius:50%;background:var(--primary);margin-right:5px"></span>Hari Ini</span>
                        <span><span style="display:inline-block;width:10px;height:10px;border-radius:3px;background:#E8F1FC;border-left:3px solid var(--primary);margin-right:5px"></span>Ada Agenda</span>
                        <span><span style="display:inline-block;width:10px;height:10px;border-radius:2px;outline:2px solid var(--primary);margin-right:5px"></span>Tanggal Terpilih</span>
                    </div>
                    <div><i class="bi bi-info-circle me-1"></i> Klik tanggal untuk melihat event khusus hari itu</div>
                </div>
            </div>
        </div>

        {{-- KOLOM SIDEBAR DETAIL EVENT --}}
        <div class="col-xl-4 col-lg-5">
            <div style="background:#fff;border-radius:18px;border:1px solid var(--border);box-shadow:0 10px 30px rgba(0,0,0,0.06);position:sticky;top:90px">
                <div class="cal-side-header">
                    <div>
                        <h5 style="margin:0;font-weight:800;color:var(--primary);font-size:1.02rem" id="sideTitle">
                            Daftar Event
                        </h5>
                        <small style="color:var(--text-soft);font-size:.76rem" id="sideSub">
                            Pilih tanggal di kalender
                        </small>
                    </div>
                    <button id="btnResetFilterDate" class="btn btn-sm btn-link p-0 text-decoration-none" style="font-size:.78rem;font-weight:700;display:none" onclick="resetTanggalFilter()">
                        <i class="bi bi-x-circle"></i> Reset Filter
                    </button>
                </div>

                <div style="padding:16px;max-height:680px;overflow-y:auto" id="sideEventList">
                    {{-- Dinamis diisi lewat JS --}}
                </div>

                {{-- CTA HUBUNGI DINAS --}}
                <div style="padding:16px 20px;background:#F8FBFF;border-top:1px solid var(--border);border-radius:0 0 18px 18px">
                    <div style="display:flex;align-items:center;gap:12px">
                        <div style="width:40px;height:40px;border-radius:10px;background:var(--sky);display:flex;align-items:center;justify-content:center;color:var(--primary);font-size:1.2rem;flex-shrink:0">
                            <i class="bi bi-megaphone-fill"></i>
                        </div>
                        <div style="flex:1">
                            <div style="font-weight:700;font-size:.82rem;color:var(--primary)">Punya agenda acara di Samarinda?</div>
                            <div style="font-size:.74rem;color:var(--text-soft)">Kirim info event Anda ke Dinas Pariwisata</div>
                        </div>
                        <a href="{{ route('kontak.index') }}" class="btn-d btn-blue" style="padding:6px 12px;font-size:.75rem">
                            Daftarkan
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
// Data Event dari Database
var allEvents = @json($events);
var filteredEvents = [...allEvents];
var activeKategori = 'all';
var searchQuery = '';
var selectedDateStr = null; // YYYY-MM-DD
var currentView = 'grid';

var bulanNama = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
var hariNama = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];

// Waktu saat ini
var cur = new Date();
cur.setDate(1);

var padZero = function(n) { return String(n).padStart(2, '0'); };
var isoDate = function(d) { return d.getFullYear() + '-' + padZero(d.getMonth() + 1) + '-' + padZero(d.getDate()); };

function escHtml(str) {
    if (!str) return '';
    var d = document.createElement('div');
    d.textContent = str;
    return d.innerHTML;
}

function gantiBulan(n) {
    cur.setMonth(cur.getMonth() + n);
    renderCalendar();
}

function keHariIni() {
    cur = new Date();
    cur.setDate(1);
    selectedDateStr = isoDate(new Date());
    renderCalendar();
    renderSidebar();
}

function switchView(mode) {
    currentView = mode;
    document.getElementById('btnViewGrid').classList.toggle('active', mode === 'grid');
    document.getElementById('btnViewList').classList.toggle('active', mode === 'list');
    document.getElementById('viewGridContainer').style.display = mode === 'grid' ? 'block' : 'none';
    document.getElementById('viewListContainer').style.display = mode === 'list' ? 'block' : 'none';
    if (mode === 'list') {
        renderTimelineList();
    }
}

function filterKategori(kat, btn) {
    activeKategori = kat;
    document.querySelectorAll('#catChipsContainer button').forEach(function(b) {
        b.classList.remove('active');
    });
    if (btn) btn.classList.add('active');
    applyFilters();
}

function cariEvent(val) {
    searchQuery = (val || '').toLowerCase().trim();
    applyFilters();
}

function applyFilters() {
    filteredEvents = allEvents.filter(function(e) {
        var matchKat = (activeKategori === 'all') || (e.kat && e.kat.toLowerCase() === activeKategori.toLowerCase());
        var matchSearch = !searchQuery ||
            (e.nama && e.nama.toLowerCase().includes(searchQuery)) ||
            (e.lokasi && e.lokasi.toLowerCase().includes(searchQuery)) ||
            (e.deskripsi && e.deskripsi.toLowerCase().includes(searchQuery));
        return matchKat && matchSearch;
    });

    renderCalendar();
    renderSidebar();
    if (currentView === 'list') {
        renderTimelineList();
    }
}

function pilihTanggal(dateStr) {
    if (selectedDateStr === dateStr) {
        selectedDateStr = null; // Toggle unselect
    } else {
        selectedDateStr = dateStr;
    }
    renderCalendar();
    renderSidebar();
}

function resetTanggalFilter() {
    selectedDateStr = null;
    renderCalendar();
    renderSidebar();
}

function getGoogleCalUrl(e) {
    // Format tanggal Google Calendar YYYYMMDD
    var startIso = e.mulai ? e.mulai.replace(/-/g, '') : '';
    var endIso = e.selesai ? e.selesai.replace(/-/g, '') : startIso;
    // Tambah 1 hari untuk all day event di gcal
    return 'https://calendar.google.com/calendar/render?action=TEMPLATE&text=' + encodeURIComponent(e.nama)
        + '&dates=' + startIso + '/' + endIso
        + '&details=' + encodeURIComponent((e.deskripsi || '') + '\n\nSelengkapnya: ' + e.url)
        + '&location=' + encodeURIComponent(e.lokasi || 'Samarinda');
}

function getWhatsAppShareUrl(e) {
    var text = 'Halo! Ada event menarik di Samarinda nih:\n\n* ' + e.nama + '*\nTanggal: ' + e.mulai_format + (e.mulai_format !== e.selesai_format ? ' s/d ' + e.selesai_format : '') + '\nLokasi: ' + (e.lokasi || 'Samarinda') + '\n\nYuk ikutan! Cek info lengkapnya di:\n' + e.url;
    return 'https://api.whatsapp.com/send?text=' + encodeURIComponent(text);
}

function getKatClass(kat) {
    if (!kat) return '';
    var k = kat.toLowerCase();
    if (k.includes('budaya') || k.includes('seni')) return 'budaya';
    if (k.includes('festival') || k.includes('expo')) return 'festival';
    if (k.includes('olahraga') || k.includes('sport')) return 'olahraga';
    if (k.includes('religi')) return 'religi';
    if (k.includes('kuliner')) return 'kuliner';
    return '';
}

function renderCalendar() {
    var y = cur.getFullYear(), m = cur.getMonth();
    document.getElementById('calTitle').textContent = bulanNama[m] + ' ' + y;

    // Hari pertama dalam bulan (0=Minggu, 1=Senin, ..., 6=Sabtu)
    // Di Indonesia, minggu dimulai dari Senin (0=Senin ... 6=Minggu)
    var firstDayRaw = new Date(y, m, 1).getDay();
    var firstDayMon = (firstDayRaw + 6) % 7; // Convert: Mon=0 ... Sun=6

    var daysInMonth = new Date(y, m + 1, 0).getDate();
    var daysInPrevMonth = new Date(y, m, 0).getDate();
    var todayStr = isoDate(new Date());

    var grid = document.getElementById('calGrid');
    grid.innerHTML = '';

    // Sel dari bulan sebelumnya
    for (var p = firstDayMon - 1; p >= 0; p--) {
        var prevNum = daysInPrevMonth - p;
        var prevM = m === 0 ? 11 : m - 1;
        var prevY = m === 0 ? y - 1 : y;
        var prevDateStr = prevY + '-' + padZero(prevM + 1) + '-' + padZero(prevNum);

        var cell = document.createElement('div');
        cell.className = 'cal-cell other-month';
        cell.innerHTML = '<div class="cal-cell-header"><span class="cal-cell-num">' + prevNum + '</span></div>';
        grid.appendChild(cell);
    }

    // Sel bulan aktif
    for (var d = 1; d <= daysInMonth; d++) {
        var dateStr = y + '-' + padZero(m + 1) + '-' + padZero(d);
        var dayOfWeek = (firstDayMon + (d - 1)) % 7;
        var isWeekend = (dayOfWeek === 5 || dayOfWeek === 6); // Sabtu & Minggu

        // Event yang aktif pada hari ini
        var dayEvents = filteredEvents.filter(function(ev) {
            return dateStr >= ev.mulai && dateStr <= ev.selesai;
        });

        var cell = document.createElement('div');
        var cellClasses = ['cal-cell'];
        if (dateStr === todayStr) cellClasses.push('is-today');
        if (dateStr === selectedDateStr) cellClasses.push('is-selected');
        if (isWeekend) cellClasses.push('weekend');
        cell.className = cellClasses.join(' ');

        // HTML Header Cell
        var cellHtml = '<div class="cal-cell-header">'
            + '<span class="cal-cell-num">' + d + '</span>'
            + (dayEvents.length > 0 ? '<span style="font-size:.68rem;font-weight:700;color:var(--primary);background:var(--sky);padding:1px 6px;border-radius:10px">' + dayEvents.length + '</span>' : '')
            + '</div>';

        // Pills event (Desktop)
        var pillsHtml = '';
        dayEvents.slice(0, 2).forEach(function(ev) {
            var katClass = getKatClass(ev.kat);
            var iconClass = (ev.icon && ev.icon.startsWith('bi-')) ? ev.icon : 'bi-calendar-event';
            pillsHtml += '<div class="cal-event-pill ' + katClass + '" title="' + escHtml(ev.nama) + ' (' + escHtml(ev.kat) + ')">'
                + '<i class="bi ' + iconClass + ' me-1"></i>' + escHtml(ev.nama)
                + '</div>';
        });
        if (dayEvents.length > 2) {
            pillsHtml += '<div style="font-size:.68rem;color:var(--text-soft);font-weight:700;padding-left:4px">+' + (dayEvents.length - 2) + ' lainnya</div>';
        }

        // Dots (Mobile)
        var dotsHtml = '<div class="cal-dots-container">';
        dayEvents.slice(0, 3).forEach(function() {
            dotsHtml += '<span class="cal-dot"></span>';
        });
        dotsHtml += '</div>';

        cell.innerHTML = cellHtml + pillsHtml + dotsHtml;

        // Onclick cell
        (function(dt) {
            cell.onclick = function() {
                pilihTanggal(dt);
            };
        })(dateStr);

        grid.appendChild(cell);
    }

    // Sel sisa bulan berikutnya agar grid genap kelipatan 7
    var totalCells = firstDayMon + daysInMonth;
    var nextCells = (totalCells % 7 === 0) ? 0 : 7 - (totalCells % 7);
    for (var n = 1; n <= nextCells; n++) {
        var cell = document.createElement('div');
        cell.className = 'cal-cell other-month';
        cell.innerHTML = '<div class="cal-cell-header"><span class="cal-cell-num">' + n + '</span></div>';
        grid.appendChild(cell);
    }
}

function renderSidebar() {
    var sideList = document.getElementById('sideEventList');
    var sideTitle = document.getElementById('sideTitle');
    var sideSub = document.getElementById('sideSub');
    var resetBtn = document.getElementById('btnResetFilterDate');

    var currentY = cur.getFullYear(), currentM = cur.getMonth();
    var currentMonthPrefix = currentY + '-' + padZero(currentM + 1);

    var displayEvents = [];

    if (selectedDateStr) {
        // Filter event pada tanggal terpilih
        displayEvents = filteredEvents.filter(function(e) {
            return selectedDateStr >= e.mulai && selectedDateStr <= e.selesai;
        });
        var parts = selectedDateStr.split('-');
        var dObj = new Date(+parts[0], +parts[1] - 1, +parts[2]);
        sideTitle.innerHTML = '<i class="bi bi-calendar-event me-2 text-primary"></i>' + dObj.getDate() + ' ' + bulanNama[dObj.getMonth()] + ' ' + dObj.getFullYear();
        sideSub.textContent = displayEvents.length + ' event ditemukan pada hari ini';
        resetBtn.style.display = 'inline-block';
    } else {
        // Tampilkan semua event di bulan aktif
        displayEvents = filteredEvents.filter(function(e) {
            return (e.mulai.slice(0, 7) <= currentMonthPrefix && e.selesai.slice(0, 7) >= currentMonthPrefix);
        });
        sideTitle.innerHTML = '<i class="bi bi-calendar3 me-2 text-primary"></i>Event ' + bulanNama[currentM] + ' ' + currentY;
        sideSub.textContent = displayEvents.length + ' agenda terdaftar di bulan ini';
        resetBtn.style.display = 'none';
    }

    if (!displayEvents.length) {
        sideList.innerHTML = '<div style="text-align:center;padding:40px 15px;color:#90A4AE">'
            + '<i class="bi bi-calendar-x" style="font-size:3rem;display:block;margin-bottom:10px;opacity:.5"></i>'
            + '<div style="font-weight:700;color:var(--text-main);margin-bottom:4px">Tidak ada event ditemukan</div>'
            + '<small>' + (selectedDateStr ? 'Tidak ada agenda yang dijadwalkan pada tanggal ini.' : 'Belum ada agenda di bulan ini.') + '</small>'
            + '</div>';
        return;
    }

    var html = '';
    displayEvents.forEach(function(e) {
        var gCalUrl = getGoogleCalUrl(e);
        var waUrl = getWhatsAppShareUrl(e);
        var iconClass = (e.icon && e.icon.startsWith('bi-')) ? e.icon : 'bi-calendar-event';

        html += '<div class="cal-side-card">'
            + '<div style="display:flex;gap:12px;align-items:flex-start">'
                + (e.gambar ? '<img src="' + escHtml(e.gambar) + '" class="card-thumb" alt="Foto Event" onerror="this.src=\'{{ asset("images/hero/hero-bg-1.jpg") }}\'">' : '<div class="card-thumb d-flex align-items-center justify-content-center text-primary" style="font-size:1.6rem"><i class="bi ' + iconClass + '"></i></div>')
                + '<div style="flex:1;min-width:0">'
                    + '<div class="d-flex justify-content-between align-items-center mb-1">'
                        + '<span class="pill ' + (getKatClass(e.kat) === 'budaya' ? 'purple' : (getKatClass(e.kat) === 'olahraga' ? 'green' : 'blue')) + '" style="font-size:.7rem;padding:3px 8px">' + escHtml(e.kat || 'Agenda') + '</span>'
                    + '</div>'
                    + '<a href="' + escHtml(e.url) + '" style="font-weight:800;color:var(--primary);font-size:.9rem;line-height:1.3;display:block;margin-bottom:4px;text-decoration:none">' + escHtml(e.nama) + '</a>'
                    + '<div style="font-size:.76rem;color:var(--text-soft);margin-bottom:3px"><i class="bi bi-calendar3 text-primary me-1"></i>' + escHtml(e.mulai_format) + (e.mulai_format !== e.selesai_format ? ' s/d ' + escHtml(e.selesai_format) : '') + '</div>'
                    + '<div style="font-size:.76rem;color:var(--text-soft);margin-bottom:6px"><i class="bi bi-geo-alt text-danger me-1"></i>' + escHtml(e.lokasi || 'Samarinda') + (e.jam ? ' • <i class="bi bi-clock ms-1 me-1 text-primary"></i>' + escHtml(e.jam) : '') + '</div>'
                + '</div>'
            + '</div>'
            + (e.deskripsi ? '<p style="font-size:.78rem;color:var(--text-soft);margin:8px 0 10px;line-height:1.4">' + escHtml(e.deskripsi) + '</p>' : '')
            + '<div class="d-flex gap-2 pt-2" style="border-top:1px dashed var(--border)">'
                + '<a href="' + escHtml(e.url) + '" class="btn-d btn-blue flex-fill justify-content-center py-1" style="font-size:.75rem"><i class="bi bi-arrow-right-circle"></i> Detail</a>'
                + '<a href="' + gCalUrl + '" target="_blank" rel="noopener" class="btn-d btn-light-d py-1 px-2" title="Simpan ke Google Calendar" style="font-size:.75rem"><i class="bi bi-google text-danger"></i></a>'
                + '<a href="' + waUrl + '" target="_blank" rel="noopener" class="btn-d btn-light-d py-1 px-2" title="Bagikan ke WhatsApp" style="font-size:.75rem"><i class="bi bi-whatsapp text-success"></i></a>'
            + '</div>'
            + '</div>';
    });

    sideList.innerHTML = html;
}

function renderTimelineList() {
    var cont = document.getElementById('timelineList');
    if (!filteredEvents.length) {
        cont.innerHTML = '<div class="text-center py-5 text-muted">Tidak ada event yang sesuai pencarian atau filter.</div>';
        return;
    }

    var html = '<div class="row g-3">';
    filteredEvents.forEach(function(e) {
        var gCalUrl = getGoogleCalUrl(e);
        var waUrl = getWhatsAppShareUrl(e);
        var iconClass = (e.icon && e.icon.startsWith('bi-')) ? e.icon : 'bi-calendar-event';

        html += '<div class="col-md-6">'
            + '<div style="background:#fff;border:1.5px solid var(--border);border-radius:14px;padding:16px;height:100%;display:flex;flex-direction:column;justify-content:space-between">'
                + '<div>'
                    + '<div class="d-flex justify-content-between align-items-center mb-2">'
                        + '<span class="pill blue" style="font-size:.72rem">' + escHtml(e.kat || 'Umum') + '</span>'
                        + '<span style="font-size:.76rem;color:var(--text-soft);font-weight:600"><i class="bi bi-calendar-event text-primary me-1"></i>' + escHtml(e.mulai_format) + '</span>'
                    + '</div>'
                    + '<h6 style="font-weight:800;color:var(--primary);margin-bottom:6px"><a href="' + escHtml(e.url) + '" style="color:inherit;text-decoration:none">' + escHtml(e.nama) + '</a></h6>'
                    + '<div style="font-size:.78rem;color:var(--text-soft);margin-bottom:8px"><i class="bi bi-geo-alt text-danger me-1"></i>' + escHtml(e.lokasi || 'Kota Samarinda') + '</div>'
                    + (e.deskripsi ? '<p style="font-size:.8rem;color:var(--text-soft);line-height:1.4;margin-bottom:12px">' + escHtml(e.deskripsi) + '</p>' : '')
                + '</div>'
                + '<div class="d-flex gap-2 pt-2" style="border-top:1px solid #ECEFF1">'
                    + '<a href="' + escHtml(e.url) + '" class="btn-d btn-blue flex-fill justify-content-center py-1" style="font-size:.78rem">Lihat Info Lengkap</a>'
                    + '<a href="' + gCalUrl + '" target="_blank" rel="noopener" class="btn-d btn-light-d py-1 px-2" title="Google Calendar"><i class="bi bi-google text-danger"></i></a>'
                    + '<a href="' + waUrl + '" target="_blank" rel="noopener" class="btn-d btn-light-d py-1 px-2" title="Bagikan ke WhatsApp"><i class="bi bi-whatsapp text-success"></i></a>'
                + '</div>'
            + '</div>'
            + '</div>';
    });
    html += '</div>';

    cont.innerHTML = html;
}

// Inisialisasi awal
renderCalendar();
renderSidebar();
</script>
@endpush
