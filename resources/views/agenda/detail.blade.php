@extends('layouts.app')
@section('title', $agenda->nama)
@section('meta', \Illuminate\Support\Str::limit($agenda->deskripsi, 150))

@section('content')
@php
    $tgl = $agenda->tanggal_mulai->translatedFormat('d F Y') . ($agenda->isMultiDay() ? ' – ' . $agenda->tanggal_selesai->translatedFormat('d F Y') : '');
@endphp
@include('partials.page-banner', [
    'title' => $agenda->nama, 'bgUrl' => media_url($agenda->gambar, 'agenda'),
    'badge' => e($agenda->kategori),
    'extra' => '<div style="color:rgba(255,255,255,.85);font-size:.9rem;margin:4px 0 8px"><i class="bi bi-calendar3"></i> ' . e($tgl) . ' &nbsp;•&nbsp; <i class="bi bi-geo-alt"></i> ' . e($agenda->lokasi) . '</div>',
    'crumbs' => [['Agenda', route('agenda.index')], ['Detail']],
])

<section class="section-pad bg-soft">
<div class="container"><div class="row g-5">
    <div class="col-lg-8">
        @if($agenda->gambar)
            <div style="border-radius:var(--radius);overflow:hidden;margin-bottom:24px;box-shadow:var(--shadow)">
                <img src="{{ media_url($agenda->gambar, 'agenda') }}" alt="{{ $agenda->nama }}" style="width:100%;max-height:430px;object-fit:cover;display:block">
            </div>
        @endif

        <div class="box">
            <h4 class="box-title"><i class="bi bi-info-circle me-2"></i>Informasi Kegiatan</h4>
            <div class="row g-3">
                @foreach([
                    ['bi-calendar3','Tanggal',$tgl],
                    ['bi-clock','Jam Mulai',$agenda->jam_mulai ? $agenda->jam_mulai.' WITA' : null],
                    ['bi-geo-alt-fill','Lokasi',$agenda->lokasi],
                    ['bi-building','Penyelenggara',$agenda->penyelenggara],
                    ['bi-telephone-fill','Kontak',$agenda->kontak],
                    ['bi-tag-fill','Kategori',$agenda->kategori],
                ] as $r)
                    @if($r[2])
                        <div class="col-md-6"><div class="info-item"><div class="info-icon"><i class="bi {{ $r[0] }}"></i></div><div><div class="info-label">{{ $r[1] }}</div><div class="info-value">{{ $r[2] }}</div></div></div></div>
                    @endif
                @endforeach
            </div>
        </div>

        <div class="box">
            <h4 class="box-title"><i class="bi bi-card-text me-2"></i>Keterangan</h4>
            <div style="line-height:1.85">{!! nl2br(e($agenda->deskripsi)) !!}</div>
        </div>

        <div class="box">
            <strong style="color:var(--primary)">Bagikan Event:</strong>
            @php $u = urlencode(url()->current()); $t = urlencode($agenda->nama); @endphp
            <div class="d-flex gap-2 flex-wrap mt-2">
                <a target="_blank" rel="noopener" href="https://www.facebook.com/sharer/sharer.php?u={{ $u }}" class="btn-accent" style="background:#1877F2"><i class="bi bi-facebook"></i> Facebook</a>
                <a target="_blank" rel="noopener" href="https://twitter.com/intent/tweet?url={{ $u }}&text={{ $t }}" class="btn-accent" style="background:#111"><i class="bi bi-twitter-x"></i> X</a>
                <a target="_blank" rel="noopener" href="https://wa.me/?text={{ $t }}%20{{ $u }}" class="btn-accent" style="background:#25D366"><i class="bi bi-whatsapp"></i> WhatsApp</a>
            </div>
        </div>
        <a href="{{ route('agenda.index') }}" class="btn-accent"><i class="bi bi-arrow-left"></i> Kembali ke Agenda</a>
    </div>

    <div class="col-lg-4">
        <div style="background:linear-gradient(135deg,var(--primary),var(--primary-light));border-radius:var(--radius);padding:24px;margin-bottom:24px;text-align:center;box-shadow:0 8px 30px rgba(21,101,192,.28)">
            <div style="color:rgba(255,255,255,.75);font-size:.8rem;text-transform:uppercase;letter-spacing:.08em;margin-bottom:8px"><i class="bi bi-stopwatch me-1"></i> Hitung Mundur</div>
            <div id="cd" style="font-size:1.9rem;font-weight:800;color:#fff;line-height:1.2">--</div>
            <div id="cdLabel" style="color:rgba(255,255,255,.7);font-size:.8rem;margin-top:6px"></div>
        </div>

        @if($lainnya->count())
            <div class="box">
                <h5 class="box-title" style="font-size:.95rem"><i class="bi bi-calendar-event me-2"></i>Agenda Lainnya</h5>
                @foreach($lainnya as $l)
                    <a href="{{ route('agenda.show', $l->id) }}" style="display:flex;gap:12px;padding-bottom:12px;margin-bottom:12px;border-bottom:1px solid var(--border)">
                        <div class="event-date-box" style="min-width:52px"><span class="day" style="font-size:1.2rem">{{ $l->tanggal_mulai->format('d') }}</span><span class="month">{{ $l->tanggal_mulai->translatedFormat('M') }}</span></div>
                        <div><div style="font-weight:800;color:var(--primary);font-size:.86rem;line-height:1.35">{{ \Illuminate\Support\Str::limit($l->nama, 50) }}</div><div style="font-size:.75rem;color:var(--text-soft)"><i class="bi bi-geo-alt"></i> {{ \Illuminate\Support\Str::limit($l->lokasi, 28) }}</div></div>
                    </a>
                @endforeach
            </div>
        @endif

        <div style="background:var(--primary);border-radius:var(--radius);padding:24px;text-align:center">
            <div style="font-size:2.2rem;color:#fff;margin-bottom:8px"><i class="bi bi-telephone-fill"></i></div>
            <h6 style="color:#fff;font-weight:800">Info Lebih Lanjut?</h6>
            <p style="color:rgba(255,255,255,.75);font-size:.84rem">Hubungi Bidang Pariwisata Disporapar untuk informasi pendaftaran dan teknis kegiatan.</p>
            <a href="{{ route('kontak.index') }}" class="btn-primary-custom" style="padding:9px 20px;font-size:.85rem">Hubungi Kami</a>
        </div>
    </div>
</div></div>
</section>
@endsection

@push('scripts')
<script>
(function () {
    var start = new Date('{{ $agenda->tanggal_mulai->format('Y-m-d') }}T{{ $agenda->jamHHMM() }}:00');
    var end = new Date('{{ $agenda->tanggalAkhir()->format('Y-m-d') }}T23:59:59');
    var el = document.getElementById('cd'), lb = document.getElementById('cdLabel');
    function pad(n){ return String(n).padStart(2, '0'); }
    function tick() {
        var now = new Date(), diff = start - now;
        if (now > end) { el.textContent = 'Telah Selesai'; lb.textContent = 'terima kasih atas partisipasi Anda'; return; }
        if (diff <= 0) { el.textContent = 'Sedang Berlangsung'; lb.textContent = 'kegiatan tengah berlangsung'; return; }
        var d = Math.floor(diff / 864e5), h = Math.floor(diff % 864e5 / 36e5), m = Math.floor(diff % 36e5 / 6e4), s = Math.floor(diff % 6e4 / 1e3);
        if (d > 0) { el.innerHTML = '<span style="font-size:2.6rem">' + d + '</span> hari'; lb.textContent = h + ' jam ' + m + ' menit lagi'; }
        else { el.textContent = pad(h) + ':' + pad(m) + ':' + pad(s); lb.textContent = 'jam : menit : detik lagi'; }
    }
    tick(); setInterval(tick, 1000);
})();
</script>
@endpush
