@extends('admin.layout')
@section('title', 'Agenda & Event')
@section('content')
@include('admin.partials.head', ['icon' => 'bi-calendar-event', 'bg' => 'linear-gradient(135deg,#E65100,#FF7043)', 'judul' => 'Agenda & Event', 'sub' => 'Kelola jadwal kegiatan pariwisata', 'search' => $q, 'tombol' => [route('admin.agenda.create'), 'Tambah Agenda', 'btn-orange']])

<div class="dcard">
    <div style="overflow-x:auto"><table class="dtable">
        <thead><tr><th>Foto</th><th>Nama Event</th><th>Kategori</th><th>Tanggal</th><th>Lokasi</th><th>Status</th><th class="text-end">Aksi</th></tr></thead>
        <tbody>
        @forelse($agenda as $a)
            <tr>
                <td><img class="thumb" src="{{ media_url($a->gambar, 'agenda') }}" alt=""></td>
                <td><div style="font-weight:800;color:var(--primary)">@if(str_starts_with($a->icon ?? '', 'bi-'))<i class="bi {{ $a->icon }} me-1 text-primary"></i>@endif{{ \Illuminate\Support\Str::limit($a->nama, 44) }}</div><small style="color:var(--text-soft)">{{ $a->penyelenggara }}</small></td>
                <td><span class="pill amber">{{ $a->kategori }}</span></td>
                <td style="font-size:.82rem;white-space:nowrap">{{ $a->tanggal_mulai->translatedFormat('d M Y') }}@if($a->isMultiDay())<br><small style="color:var(--text-soft)">s/d {{ $a->tanggal_selesai->translatedFormat('d M Y') }}</small>@endif</td>
                <td style="font-size:.82rem;color:var(--text-soft)">{{ \Illuminate\Support\Str::limit($a->lokasi, 30) }}</td>
                <td><span class="pill {{ $a->is_published ? 'green' : 'gray' }}">{{ $a->is_published ? 'Terbit' : 'Draft' }}</span> @if($a->isPast())<span class="pill gray">Selesai</span>@endif</td>
                <td class="text-end" style="white-space:nowrap">
                    <a href="{{ route('agenda.show', $a->id) }}" target="_blank" class="btn-i bi-view"><i class="bi bi-eye"></i></a>
                    <a href="{{ route('admin.agenda.edit', $a) }}" class="btn-i bi-edit"><i class="bi bi-pencil"></i></a>
                    @include('admin.partials.hapus', ['action' => route('admin.agenda.destroy', $a), 'pesan' => 'Kamu akan menghapus agenda "' . $a->nama . '".'])
                </td>
            </tr>
        @empty
            <tr><td colspan="7" class="text-center py-5" style="color:#90A4AE"><div style="font-size:2.2rem;color:#90A4AE;margin-bottom:8px"><i class="bi bi-inbox"></i></div>Belum ada agenda.</td></tr>
        @endforelse
        </tbody>
    </table></div>
    @if($agenda->hasPages())<div style="padding:16px;border-top:1px solid var(--sky)">{{ $agenda->links() }}</div>@endif
</div>
@endsection
