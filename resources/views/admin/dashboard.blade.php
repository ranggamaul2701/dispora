@extends('admin.layout')
@section('title', 'Dashboard')

@section('content')
<div style="background:linear-gradient(135deg,var(--primary-dark),var(--primary) 60%,var(--primary-light));border-radius:16px;padding:28px 32px;margin-bottom:24px;position:relative;overflow:hidden">
    <div style="position:absolute;top:-30px;right:-20px;width:190px;height:190px;border-radius:50%;background:rgba(255,255,255,.07)"></div>
    <div style="position:relative;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:16px">
        <div>
            <div style="color:rgba(255,255,255,.7);font-size:.82rem"><i class="bi bi-calendar3"></i> {{ now()->translatedFormat('l, d F Y') }}</div>
            <h4 style="color:#fff;font-weight:800;margin:4px 0">Selamat datang, {{ Auth::user()->name }}!</h4>
            <p style="color:rgba(255,255,255,.78);font-size:.88rem;margin:0">Kelola seluruh konten website Pariwisata Samarinda dari satu tempat.</p>
        </div>
        <div style="display:flex;gap:10px;flex-wrap:wrap">
            <a href="{{ route('home') }}" target="_blank" class="btn-d" style="background:rgba(255,255,255,.16);border:1px solid rgba(255,255,255,.28)"><i class="bi bi-globe"></i> Lihat Website</a>
            <a href="{{ route('admin.destinasi.create') }}" class="btn-d" style="background:var(--accent);color:var(--primary-dark)"><i class="bi bi-plus-circle"></i> Tambah Konten</a>
        </div>
    </div>
</div>

@if($search !== '')
    <div class="alert-dash ok" style="background:var(--sky);color:var(--primary);border-color:var(--border);border-left-color:var(--primary)">
        <i class="bi bi-search"></i><span>Menampilkan hasil pencarian untuk "{{ $search }}" — <a href="{{ route('admin.dashboard') }}" style="text-decoration:underline">hapus pencarian</a></span>
    </div>
@endif

<div class="row g-3 mb-4">
    @foreach([
        ['bi-geo-alt-fill','Destinasi',$stats['destinasi'],'#1565C0','#E3F2FD',route('admin.destinasi.index')],
        ['bi-newspaper','Berita',$stats['berita'],'#2E7D32','#E8F5E9',route('admin.berita.index')],
        ['bi-calendar-event','Agenda',$stats['agenda'],'#E65100','#FBE9E7',route('admin.agenda.index')],
        ['bi-people-fill','Pengguna',$stats['users'],'#6A1B9A','#F3E5F5',route('admin.users.index')],
    ] as $s)
        <div class="col-xl-3 col-md-6">
            <a href="{{ $s[5] }}" style="display:flex;gap:16px;align-items:center;background:#fff;border-radius:14px;padding:20px;box-shadow:var(--shadow);border-left:4px solid {{ $s[3] }};transition:.25s" onmouseover="this.style.transform='translateY(-4px)'" onmouseout="this.style.transform=''">
                <div style="width:54px;height:54px;border-radius:14px;background:{{ $s[4] }};display:flex;align-items:center;justify-content:center;font-size:1.5rem;color:{{ $s[3] }}"><i class="bi {{ $s[0] }}"></i></div>
                <div><div style="font-size:1.9rem;font-weight:800;color:{{ $s[3] }};line-height:1">{{ $s[2] }}</div><div style="font-size:.8rem;color:var(--text-soft)">Total {{ $s[1] }}</div></div>
            </a>
        </div>
    @endforeach
</div>

<div class="dcard mb-4">
    <div class="dcard-h"><div class="dcard-t"><span class="ic"><i class="bi bi-lightning-charge-fill"></i></span> Aksi Cepat</div><small style="color:var(--text-soft)">{{ number_format($stats['views']) }} total views berita • {{ $stats['pesan'] }} pesan belum dibaca</small></div>
    <div class="dcard-b" style="display:flex;gap:10px;flex-wrap:wrap">
        <a href="{{ route('admin.destinasi.create') }}" class="btn-d btn-blue"><i class="bi bi-geo-alt-fill"></i> Tambah Destinasi</a>
        <a href="{{ route('admin.berita.create') }}" class="btn-d btn-green"><i class="bi bi-newspaper"></i> Tambah Berita</a>
        <a href="{{ route('admin.agenda.create') }}" class="btn-d btn-orange"><i class="bi bi-calendar-plus"></i> Tambah Agenda</a>
        <a href="{{ route('admin.galeri.index') }}" class="btn-d btn-purple"><i class="bi bi-images"></i> Upload Foto Galeri</a>
        <a href="{{ route('admin.users.create') }}" class="btn-d btn-light-d"><i class="bi bi-person-plus"></i> Tambah Pengguna</a>
    </div>
</div>

<div class="row g-4">
    <div class="col-xl-7">
        <div class="dcard" style="height:100%">
            <div class="dcard-h"><div class="dcard-t"><span class="ic" style="background:#E8F5E9"><i class="bi bi-newspaper"></i></span> Berita Terbaru</div><a href="{{ route('admin.berita.index') }}" class="pill blue">Lihat semua →</a></div>
            <div style="overflow-x:auto"><table class="dtable">
                <thead><tr><th>Judul</th><th>Kategori</th><th class="text-center">Views</th><th class="text-center">Status</th><th class="text-center">Aksi</th></tr></thead>
                <tbody>
                @forelse($berita as $b)
                    <tr>
                        <td><div style="font-weight:700;color:var(--primary);max-width:240px;line-height:1.35">{{ \Illuminate\Support\Str::limit($b->judul, 48) }}</div><small style="color:#90A4AE"><i class="bi bi-clock"></i> {{ $b->created_at->diffForHumans() }}</small></td>
                        <td><span class="pill blue">{{ $b->kategori }}</span></td>
                        <td class="text-center" style="font-weight:700;color:var(--primary)">{{ number_format($b->views) }}</td>
                        <td class="text-center"><span class="pill {{ $b->is_published ? 'green' : 'gray' }}">{{ $b->is_published ? 'Terbit' : 'Draft' }}</span></td>
                        <td class="text-center"><a href="{{ route('admin.berita.edit', $b) }}" class="btn-i bi-edit" title="Edit"><i class="bi bi-pencil"></i></a></td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center py-5" style="color:#90A4AE"><div style="font-size:2rem;color:#90A4AE;margin-bottom:6px"><i class="bi bi-inbox"></i></div>Belum ada berita. <a href="{{ route('admin.berita.create') }}">Tambah sekarang</a></td></tr>
                @endforelse
                </tbody>
            </table></div>
        </div>
    </div>

    <div class="col-xl-5">
        <div class="dcard" style="height:100%">
            <div class="dcard-h"><div class="dcard-t"><span class="ic" style="background:#FBE9E7"><i class="bi bi-calendar-event"></i></span> {{ $search !== '' ? 'Agenda' : 'Agenda Mendatang' }}</div><a href="{{ route('admin.agenda.index') }}" class="pill blue">Lihat semua →</a></div>
            <div class="dcard-b" style="padding:14px">
                @forelse($agenda as $a)
                    <div style="display:flex;gap:12px;padding:12px;border:1.5px solid var(--sky);border-radius:12px;margin-bottom:9px;align-items:center">
                        <div style="width:48px;height:48px;border-radius:12px;background:linear-gradient(135deg,var(--primary),var(--primary-light));display:flex;align-items:center;justify-content:center;font-size:1.2rem;color:#fff;flex-shrink:0">
                            @if(str_starts_with($a->icon ?? '', 'bi-'))<i class="bi {{ $a->icon }}"></i>@else<i class="bi bi-calendar-event"></i>@endif
                        </div>
                        <div style="flex:1;min-width:0">
                            <div style="font-weight:800;color:var(--primary);font-size:.87rem;line-height:1.3">{{ \Illuminate\Support\Str::limit($a->nama, 42) }}</div>
                            <div style="font-size:.74rem;color:var(--text-soft)"><i class="bi bi-calendar3" style="color:#F9A825"></i> {{ $a->tanggal_mulai->translatedFormat('d M Y') }} &nbsp; <i class="bi bi-geo-alt" style="color:#F9A825"></i> {{ \Illuminate\Support\Str::limit($a->lokasi, 22) }}</div>
                        </div>
                        <a href="{{ route('admin.agenda.edit', $a) }}" class="btn-i bi-edit"><i class="bi bi-pencil"></i></a>
                    </div>
                @empty
                    <div class="text-center py-5" style="color:#90A4AE"><div style="font-size:2rem;color:#90A4AE;margin-bottom:6px"><i class="bi bi-inbox"></i></div>Belum ada agenda mendatang.</div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="col-xl-7">
        <div class="dcard">
            <div class="dcard-h"><div class="dcard-t"><span class="ic"><i class="bi bi-geo-alt-fill"></i></span> Destinasi {{ $search !== '' ? '' : 'Terbaru' }}</div><a href="{{ route('admin.destinasi.index') }}" class="pill blue">Lihat semua →</a></div>
            <div style="overflow-x:auto"><table class="dtable"><tbody>
                @forelse($destinasi as $d)
                    <tr>
                        <td style="width:70px"><img class="thumb" src="{{ media_url($d->gambar, 'destinasi') }}" alt=""></td>
                        <td><div style="font-weight:700;color:var(--primary)">{{ $d->nama }}</div><small style="color:var(--text-soft)">{{ $d->kategori }} • {{ $d->harga }}</small></td>
                        <td><span class="pill {{ $d->is_published ? 'green' : 'gray' }}">{{ $d->is_published ? 'Aktif' : 'Nonaktif' }}</span></td>
                        <td class="text-end"><a href="{{ route('admin.destinasi.edit', $d) }}" class="btn-i bi-edit"><i class="bi bi-pencil"></i></a></td>
                    </tr>
                @empty
                    <tr><td class="text-center py-4" style="color:#90A4AE">Belum ada destinasi.</td></tr>
                @endforelse
            </tbody></table></div>
        </div>
    </div>

    <div class="col-xl-5">
        <div class="dcard" style="height:100%">
            <div class="dcard-h"><div class="dcard-t"><span class="ic" style="background:#FFF8E1"><i class="bi bi-envelope-fill"></i></span> Pesan Terbaru</div><a href="{{ route('admin.pesan.index') }}" class="pill blue">Lihat semua →</a></div>
            <div class="dcard-b" style="padding:14px">
                @forelse($pesan as $p)
                    <div style="padding:11px;border-bottom:1px solid #EEF5FF">
                        <div style="display:flex;justify-content:space-between;gap:8px"><strong style="font-size:.86rem;color:var(--primary)">{{ $p->nama }}</strong>@unless($p->dibaca)<span class="pill red">Baru</span>@endunless</div>
                        <div style="font-size:.82rem;font-weight:600">{{ \Illuminate\Support\Str::limit($p->subjek, 40) }}</div>
                        <small style="color:#90A4AE">{{ $p->created_at->diffForHumans() }}</small>
                    </div>
                @empty
                    <div class="text-center py-4" style="color:#90A4AE">Belum ada pesan masuk.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
