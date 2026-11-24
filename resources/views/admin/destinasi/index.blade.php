@extends('admin.layout')
@section('title', 'Destinasi Wisata')
@section('content')
@include('admin.partials.head', ['icon' => 'bi-geo-alt-fill', 'bg' => 'linear-gradient(135deg,#1565C0,#1E88E5)', 'judul' => 'Destinasi Wisata', 'sub' => 'Kelola data destinasi wisata Samarinda', 'search' => $q, 'tombol' => [route('admin.destinasi.create'), 'Tambah Destinasi']])

<div class="dcard">
    <div style="overflow-x:auto"><table class="dtable">
        <thead><tr><th>Foto</th><th>Destinasi</th><th>Kategori</th><th>Harga</th><th>Rating</th><th>Status</th><th class="text-end">Aksi</th></tr></thead>
        <tbody>
        @forelse($destinasi as $d)
            <tr>
                <td><img class="thumb" src="{{ media_url($d->gambar, 'destinasi') }}" alt=""></td>
                <td><div style="font-weight:800;color:var(--primary)">@if(str_starts_with($d->icon ?? '', 'bi-'))<i class="bi {{ $d->icon }} me-1 text-primary"></i>@endif{{ $d->nama }}</div><small style="color:var(--text-soft)">{{ \Illuminate\Support\Str::limit($d->alamat, 48) }}</small></td>
                <td><span class="pill blue">{{ $d->kategori }}</span></td>
                <td style="font-size:.84rem">{{ $d->harga }}</td>
                <td><i class="bi bi-star-fill text-warning me-1"></i><strong>{{ number_format($d->rating, 1) }}</strong></td>
                <td><span class="pill {{ $d->is_published ? 'green' : 'gray' }}">{{ $d->is_published ? 'Aktif' : 'Nonaktif' }}</span></td>
                <td class="text-end" style="white-space:nowrap">
                    <a href="{{ route('destinasi.show', $d->slug) }}" target="_blank" class="btn-i bi-view" title="Lihat di website"><i class="bi bi-eye"></i></a>
                    <a href="{{ route('admin.destinasi.edit', $d) }}" class="btn-i bi-edit" title="Edit"><i class="bi bi-pencil"></i></a>
                    @include('admin.partials.hapus', ['action' => route('admin.destinasi.destroy', $d), 'pesan' => 'Kamu akan menghapus destinasi "' . $d->nama . '". Tindakan ini tidak dapat dibatalkan.'])
                </td>
            </tr>
        @empty
            <tr><td colspan="7" class="text-center py-5" style="color:#90A4AE"><div style="font-size:2.2rem;color:#90A4AE;margin-bottom:8px"><i class="bi bi-inbox"></i></div>Belum ada destinasi.</td></tr>
        @endforelse
        </tbody>
    </table></div>
    @if($destinasi->hasPages())<div style="padding:16px;border-top:1px solid var(--sky)">{{ $destinasi->links() }}</div>@endif
</div>
@endsection
