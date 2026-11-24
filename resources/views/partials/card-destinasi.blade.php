<div class="dest-card">
    <div class="dest-card-thumb">
        <img src="{{ media_url($d->gambar, 'destinasi') }}" alt="{{ $d->nama }}" loading="lazy">
        <span class="dest-badge">{{ $d->kategori }}</span>
        @if($d->rating > 0)<span class="rating-badge"><i class="bi bi-star-fill text-warning me-1"></i>{{ number_format($d->rating, 1) }}</span>@endif
    </div>
    <div class="card-body-x">
        <h5>{{ $d->nama }}</h5>
        <p>{{ \Illuminate\Support\Str::limit($d->deskripsi, 105) }}</p>
        <div class="meta-line"><span><i class="bi bi-ticket-perforated"></i> {{ $d->harga }}</span></div>
        <div class="meta-line"><span><i class="bi bi-clock"></i> {{ $d->jam }}</span></div>
        <a href="{{ route('destinasi.show', $d->slug) }}" class="btn-accent w-100 mt-2">Lihat Detail <i class="bi bi-arrow-right"></i></a>
    </div>
</div>
