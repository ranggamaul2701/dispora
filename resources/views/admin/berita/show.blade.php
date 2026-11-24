@extends('layouts.app')

@section('title', $berita->judul)

@section('content')

<div class="container py-5">

    <a href="{{ route('berita.index') }}" class="btn btn-success mb-4">
        ← Kembali ke Berita
    </a>

    <h1 class="fw-bold">
        {{ $berita->judul }}
    </h1>

    <p class="text-muted">
        {{ $berita->ringkasan }}
    </p>

    <hr>

    <p>
        {{ $berita->konten }}
    </p>

</div>

@endsection