@extends('admin.layout')
@section('title', 'Kelola Pengguna')
@section('content')
@include('admin.partials.head', ['icon' => 'bi-people-fill', 'bg' => 'linear-gradient(135deg,#6A1B9A,#9C27B0)', 'judul' => 'Kelola Pengguna', 'sub' => 'Atur akun admin dan tamu', 'search' => $q, 'tombol' => [route('admin.users.create'), 'Tambah Pengguna', 'btn-purple']])
<div class="dcard">
    <div style="overflow-x:auto"><table class="dtable">
        <thead><tr><th>Pengguna</th><th>Email</th><th>Role</th><th>Bergabung</th><th class="text-end">Aksi</th></tr></thead>
        <tbody>
        @forelse($users as $u)
            <tr>
                <td><div style="display:flex;align-items:center;gap:10px"><div style="width:38px;height:38px;border-radius:50%;background:linear-gradient(135deg,var(--primary),var(--primary-light));display:flex;align-items:center;justify-content:center;color:#fff;font-weight:800">{{ strtoupper(substr($u->name, 0, 1)) }}</div><div><strong style="color:var(--primary)">{{ $u->name }}</strong>@if($u->id === auth()->id())<div style="font-size:.7rem;color:#2E7D32;font-weight:700">● Anda</div>@endif</div></div></td>
                <td style="color:var(--text-soft)">{{ $u->email }}</td>
                <td><span class="pill {{ $u->isAdmin() ? 'blue' : 'purple' }}"><i class="bi {{ $u->isAdmin() ? 'bi-shield-check' : 'bi-person' }} me-1"></i>{{ $u->isAdmin() ? 'Administrator' : 'Tamu' }}</span></td>
                <td style="font-size:.8rem;color:var(--text-soft)">{{ $u->created_at->translatedFormat('d M Y') }}</td>
                <td class="text-end" style="white-space:nowrap">
                    <a href="{{ route('admin.users.edit', $u) }}" class="btn-i bi-edit"><i class="bi bi-pencil"></i></a>
                    @if($u->id !== auth()->id())
                        @include('admin.partials.hapus', ['action' => route('admin.users.destroy', $u), 'pesan' => 'Kamu akan menghapus pengguna "' . $u->name . '".'])
                    @endif
                </td>
            </tr>
        @empty
            <tr><td colspan="5" class="text-center py-5" style="color:#90A4AE">Belum ada pengguna.</td></tr>
        @endforelse
        </tbody>
    </table></div>
    @if($users->hasPages())<div style="padding:16px;border-top:1px solid var(--sky)">{{ $users->links() }}</div>@endif
</div>
@endsection
