@extends('admin.layout')
@section('title', $item ? 'Edit Pengguna' : 'Tambah Pengguna')
@section('content')
@include('admin.partials.head', ['icon' => 'bi-person-fill', 'bg' => 'linear-gradient(135deg,#6A1B9A,#9C27B0)', 'judul' => $item ? 'Edit Pengguna' : 'Tambah Pengguna', 'sub' => 'Data akun pengguna', 'kembali' => route('admin.users.index')])
<div class="row justify-content-center"><div class="col-lg-6">
<form method="POST" action="{{ $item ? route('admin.users.update', $item) : route('admin.users.store') }}">
    @csrf @if($item) @method('PUT') @endif
    <div class="dcard"><div class="dcard-h"><div class="dcard-t"><span class="ic" style="background:#F3E5F5"><i class="bi bi-person-fill"></i></span> Data Pengguna</div></div>
        <div class="dcard-b d-flex flex-column gap-3">
            <div><label class="f-label">Nama Lengkap *</label><input class="f-input" name="name" value="{{ old('name', $item?->name) }}" required></div>
            <div><label class="f-label">Email *</label><input type="email" class="f-input" name="email" value="{{ old('email', $item?->email) }}" required></div>
            <div><label class="f-label">Role *</label><select class="f-input" name="role" required><option value="tamu" @selected(old('role', $item?->role) === 'tamu')>Tamu / Pengunjung</option><option value="admin" @selected(old('role', $item?->role) === 'admin')>Administrator</option></select></div>
            <div><label class="f-label">Password {{ $item ? '(kosongkan jika tidak diganti)' : '*' }}</label><input type="password" class="f-input" name="password" minlength="6" {{ $item ? '' : 'required' }}><div class="f-hint">Minimal 6 karakter.</div></div>
            <button class="btn-d btn-purple justify-content-center" style="padding:13px" type="submit"><i class="bi bi-check-circle-fill"></i> {{ $item ? 'Simpan Perubahan' : 'Tambah Pengguna' }}</button>
        </div>
    </div>
</form>
</div></div>
@endsection
