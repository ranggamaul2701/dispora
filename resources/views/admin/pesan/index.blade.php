@extends('admin.layout')
@section('title', 'Pesan Masuk')
@section('content')
@include('admin.partials.head', ['icon' => 'bi-envelope-fill', 'bg' => 'linear-gradient(135deg,#F9A825,#FFC107)', 'judul' => 'Pesan Masuk', 'sub' => 'Pesan dari formulir kontak website'])
<div class="dcard">
    <div class="dcard-b" style="padding:14px">
    @forelse($pesan as $p)
        <div style="padding:16px;border:1.5px solid {{ $p->dibaca ? 'var(--sky)' : 'var(--primary)' }};border-radius:13px;margin-bottom:12px;background:{{ $p->dibaca ? '#fff' : '#F8FBFF' }}">
            <div class="d-flex justify-content-between flex-wrap gap-2">
                <div><strong style="color:var(--primary)">{{ $p->nama }}</strong> <a href="mailto:{{ $p->email }}" style="font-size:.82rem">&lt;{{ $p->email }}&gt;</a> @unless($p->dibaca)<span class="pill red">Baru</span>@endunless</div>
                <small style="color:var(--text-soft)">{{ $p->created_at->translatedFormat('d M Y, H:i') }}</small>
            </div>
            <div style="font-weight:800;margin:6px 0 4px">{{ $p->subjek }}</div>
            <div style="font-size:.9rem;color:#37474F;white-space:pre-line">{{ $p->isi }}</div>
            <div class="d-flex gap-2 mt-3">
                <form method="POST" action="{{ route('admin.pesan.toggle', $p) }}">@csrf @method('PATCH')<button class="btn-d btn-light-d" style="padding:6px 14px;font-size:.78rem" type="submit"><i class="bi bi-{{ $p->dibaca ? 'envelope' : 'envelope-open' }}"></i> {{ $p->dibaca ? 'Tandai belum dibaca' : 'Tandai sudah dibaca' }}</button></form>
                <a class="btn-d btn-blue" style="padding:6px 14px;font-size:.78rem" href="mailto:{{ $p->email }}?subject={{ rawurlencode('Re: ' . $p->subjek) }}"><i class="bi bi-reply"></i> Balas</a>
                @include('admin.partials.hapus', ['action' => route('admin.pesan.destroy', $p), 'pesan' => 'Hapus pesan dari ' . $p->nama . '?'])
            </div>
        </div>
    @empty
        <div class="text-center py-5" style="color:#90A4AE"><div style="font-size:2.2rem;color:#90A4AE;margin-bottom:8px"><i class="bi bi-inbox"></i></div>Belum ada pesan masuk.</div>
    @endforelse
    </div>
    @if($pesan->hasPages())<div style="padding:16px;border-top:1px solid var(--sky)">{{ $pesan->links() }}</div>@endif
</div>
@endsection
