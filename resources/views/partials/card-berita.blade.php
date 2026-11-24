<div class="news-card">
    <a href="{{ route('berita.show', $b->slug) }}" style="display:block;height:210px;overflow:hidden;background:var(--sky)">
        <img src="{{ media_url($b->gambar, 'berita') }}" alt="{{ $b->judul }}" class="news-card-img" loading="lazy">
    </a>
    <div class="card-body-x">
        <span class="news-kategori">{{ $b->kategori }}</span>
        <h5 class="news-card-title"><a href="{{ route('berita.show', $b->slug) }}">{{ $b->judul }}</a></h5>
        <p>{{ \Illuminate\Support\Str::limit($b->ringkasan, 110) }}</p>
        <div class="meta-line" style="margin:0">
            <span><i class="bi bi-calendar3"></i> {{ $b->created_at->translatedFormat('d M Y') }}</span>
            <span><i class="bi bi-eye"></i> {{ number_format($b->views) }}</span>
        </div>
    </div>
</div>
