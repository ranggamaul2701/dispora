@extends('admin.layout')
@section('title', 'Kelola Berita')
@section('content')
@include('admin.partials.head', ['icon' => 'bi-newspaper', 'bg' => 'linear-gradient(135deg,#2E7D32,#43A047)', 'judul' => 'Kelola Berita', 'sub' => 'Tulis dan kelola berita pariwisata', 'search' => $q, 'tombol' => [route('admin.berita.create'), 'Tambah Berita', 'btn-green']])

<div class="dcard">
    <div style="overflow-x:auto"><table class="dtable">
        <thead><tr><th>Foto</th><th>Judul</th><th>Kategori</th><th>Views</th><th>Status</th><th>Tanggal</th><th class="text-end">Aksi</th></tr></thead>
        <tbody>
        @forelse($berita as $b)
            <tr>
                <td><img class="thumb" src="{{ media_url($b->gambar, 'berita') }}" alt=""></td>
                <td><div style="font-weight:800;color:var(--primary);max-width:300px;line-height:1.35">{{ \Illuminate\Support\Str::limit($b->judul, 60) }}</div><small style="color:var(--text-soft)">{{ \Illuminate\Support\Str::limit($b->ringkasan, 70) }}</small></td>
                <td><span class="pill green">{{ $b->kategori }}</span></td>
                <td style="font-weight:700;color:var(--primary)">{{ number_format($b->views) }}</td>
                <td><span class="pill {{ $b->is_published ? 'green' : 'gray' }}">{{ $b->is_published ? 'Terbit' : 'Draft' }}</span></td>
                <td style="font-size:.8rem;color:var(--text-soft);white-space:nowrap">{{ $b->created_at->translatedFormat('d M Y') }}</td>
                <td class="text-end" style="white-space:nowrap">
                    <a href="{{ route('berita.show', $b->slug) }}" target="_blank" class="btn-i bi-view"><i class="bi bi-eye"></i></a>
                    <a href="{{ route('admin.berita.edit', $b) }}" class="btn-i bi-edit"><i class="bi bi-pencil"></i></a>
                    @include('admin.partials.hapus', ['action' => route('admin.berita.destroy', $b), 'pesan' => 'Kamu akan menghapus berita "' . \Illuminate\Support\Str::limit($b->judul, 60) . '".'])
                </td>
            </tr>
        @empty
            <tr><td colspan="7" class="text-center py-5" style="color:#90A4AE"><div style="font-size:2.2rem;color:#90A4AE;margin-bottom:8px"><i class="bi bi-inbox"></i></div>Belum ada berita.</td></tr>
        @endforelse
        </tbody>
    </table></div>
    @if($berita->hasPages())<div style="padding:16px;border-top:1px solid var(--sky)">{{ $berita->links() }}</div>@endif
</div>
@endsection
