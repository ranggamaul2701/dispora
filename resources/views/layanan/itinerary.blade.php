@extends('layouts.app')
@section('title', 'Itinerary Builder')

@section('content')
@include('partials.page-banner', ['title' => 'Itinerary Builder', 'bg' => 'hero-bg-1.jpg', 'badge' => 'Rencanakan Perjalanan', 'sub' => 'Susun rencana wisata per hari lalu cetak atau simpan sebagai PDF.', 'crumbs' => [['Itinerary']]])

<section class="section-pad bg-soft">
<div class="container"><div class="row g-4">
    <div class="col-lg-4">
        <div class="box" style="position:sticky;top:90px">
            <h5 class="box-title" style="font-size:.95rem"><i class="bi bi-geo-alt-fill me-2"></i>Pilih Destinasi</h5>
            <p class="text-muted" style="font-size:.82rem">Klik untuk menambahkan ke hari yang sedang aktif.</p>
            @foreach($destinasi as $d)
                <div data-d="{{ json_encode(['nama' => $d->nama, 'icon' => $d->icon, 'harga' => $d->harga, 'durasi' => $d->durasi]) }}" onclick="tambah(JSON.parse(this.dataset.d))"
                     style="display:flex;gap:10px;align-items:center;padding:11px;border:1.5px solid var(--border);border-radius:11px;margin-bottom:8px;cursor:pointer;transition:.2s"
                     onmouseover="this.style.background='var(--sky)'" onmouseout="this.style.background='#fff'">
                    <span style="font-size:1.3rem;color:var(--primary)">@if(str_starts_with($d->icon ?? '', 'bi-'))<i class="bi {{ $d->icon }}"></i>@else<i class="bi bi-geo-alt"></i>@endif</span>
                    <div style="flex:1;min-width:0"><div style="font-weight:800;color:var(--primary);font-size:.86rem">{{ $d->nama }}</div><div style="font-size:.74rem;color:var(--text-soft)">{{ $d->harga }} • <i class="bi bi-clock me-1"></i>{{ $d->durasi }}</div></div>
                    <span style="color:var(--accent-dark);font-size:1.3rem;font-weight:800">+</span>
                </div>
            @endforeach
        </div>
    </div>
    <div class="col-lg-8">
        <div class="box">
            <div class="row g-3 align-items-end">
                <div class="col-md-6"><label class="form-label-x">Nama Perjalanan</label><input id="tripNama" class="form-input" value="Wisata Samarinda Saya"></div>
                <div class="col-md-3"><label class="form-label-x">Tanggal Mulai</label><input id="tripTgl" type="date" class="form-input"></div>
                <div class="col-md-3 d-flex gap-2"><button class="btn-accent flex-fill justify-content-center" onclick="window.print()"><i class="bi bi-printer"></i> Cetak</button><button class="btn-accent" style="background:#C62828" onclick="reset()" title="Kosongkan"><i class="bi bi-trash"></i></button></div>
            </div>
        </div>
        <div id="hari"></div>
        <button class="chip w-100 text-center" style="border-style:dashed;padding:13px" onclick="tambahHari()">+ Tambah Hari</button>
    </div>
</div></div>
</section>
@endsection

@push('scripts')
<script>
document.getElementById('tripTgl').value = new Date().toISOString().slice(0, 10);
var plan = [[]], aktif = 0;
function esc(s) { var d = document.createElement('div'); d.textContent = s == null ? '' : s; return d.innerHTML; }
function renderIcon(ic) {
    if (ic && ic.startsWith('bi-')) {
        return '<i class="bi ' + esc(ic) + ' text-primary"></i>';
    }
    return '<i class="bi bi-geo-alt text-primary"></i>';
}
function tambah(d) {
    if (plan[aktif].some(function (x) { return x.nama === d.nama; })) { alert('Destinasi sudah ada di Hari ' + (aktif + 1)); return; }
    plan[aktif].push({ nama: d.nama, icon: d.icon, harga: d.harga, durasi: d.durasi, jam: ['08:00','10:00','12:30','14:30','16:30','18:30'][plan[aktif].length] || '19:00', catatan: '' });
    render();
}
function tambahHari() { if (plan.length >= 7) return alert('Maksimal 7 hari'); plan.push([]); aktif = plan.length - 1; render(); }
function hapusHari(i) { if (plan.length === 1) return; plan.splice(i, 1); aktif = Math.min(aktif, plan.length - 1); render(); }
function hapus(i, j) { plan[i].splice(j, 1); render(); }
function reset() { if (confirm('Kosongkan seluruh itinerary?')) { plan = [[]]; aktif = 0; render(); } }
function setAktif(i) { aktif = i; render(); }
function render() {
    document.getElementById('hari').innerHTML = plan.map(function (items, i) {
        var on = i === aktif;
        return '<div class="box" style="padding:0;overflow:hidden;border:2px solid ' + (on ? 'var(--primary)' : 'transparent') + '">'
            + '<div onclick="setAktif(' + i + ')" style="cursor:pointer;padding:13px 20px;display:flex;justify-content:space-between;align-items:center;background:' + (on ? 'var(--primary)' : 'var(--light-bg)') + ';color:' + (on ? '#fff' : 'var(--primary)') + ';font-weight:800">'
            + '<span>Hari ' + (i + 1) + ' <small style="font-weight:500;opacity:.8">• ' + items.length + ' destinasi' + (on ? ' • aktif' : '') + '</small></span>'
            + (plan.length > 1 ? '<button onclick="event.stopPropagation();hapusHari(' + i + ')" style="background:none;border:none;color:inherit;cursor:pointer" title="Hapus hari"><i class="bi bi-trash"></i></button>' : '') + '</div>'
            + '<div style="padding:14px">' + (items.length ? items.map(function (it, j) {
                return '<div style="display:flex;gap:10px;align-items:flex-start;padding:11px;background:var(--light-bg);border-radius:11px;margin-bottom:8px">'
                    + '<input type="time" value="' + it.jam + '" onchange="plan[' + i + '][' + j + '].jam=this.value" style="border:none;background:transparent;color:var(--primary);font-weight:700;width:76px">'
                    + '<span style="font-size:1.3rem">' + renderIcon(it.icon) + '</span><div style="flex:1"><div style="font-weight:800;font-size:.88rem">' + esc(it.nama) + '</div><div style="font-size:.74rem;color:var(--text-soft)"><i class="bi bi-clock me-1"></i>' + esc(it.durasi) + ' • <i class="bi bi-ticket-perforated me-1"></i>' + esc(it.harga) + '</div>'
                    + '<input placeholder="Catatan..." value="' + esc(it.catatan).replace(/"/g, '&quot;') + '" onchange="plan[' + i + '][' + j + '].catatan=this.value" style="width:100%;border:none;border-bottom:1px solid var(--border);background:transparent;font-size:.78rem;outline:none;margin-top:4px"></div>'
                    + '<button onclick="hapus(' + i + ',' + j + ')" style="background:none;border:none;color:#C62828;cursor:pointer"><i class="bi bi-x-lg"></i></button></div>';
            }).join('') : '<div class="text-center text-muted py-3" style="font-size:.85rem;border:2px dashed var(--border);border-radius:11px">Klik destinasi di kiri untuk menambahkan</div>') + '</div></div>';
    }).join('');
}
render();
</script>
@endpush
