<div class="page-head">
    <div style="display:flex;align-items:center;gap:12px">
        <div class="ph-ic" style="background:{{ $bg }}">
            @if(str_starts_with($icon, 'bi-'))<i class="bi {{ $icon }}"></i>@else{{ $icon }}@endif
        </div>
        <div><h1>{{ $judul }}</h1><p>{{ $sub }}</p></div>
    </div>
    <div style="display:flex;gap:10px;flex-wrap:wrap;align-items:center">
        @isset($search)
            <form class="search-d" method="GET">
                <i class="bi bi-search"></i><input type="text" name="q" value="{{ $search }}" placeholder="Cari..." autocomplete="off">
            </form>
        @endisset
        @isset($tombol)<a href="{{ $tombol[0] }}" class="btn-d {{ $tombol[2] ?? 'btn-blue' }}"><i class="bi bi-plus-circle"></i> {{ $tombol[1] }}</a>@endisset
        @isset($kembali)<a href="{{ $kembali }}" class="btn-d btn-light-d"><i class="bi bi-arrow-left"></i> Kembali</a>@endisset
    </div>
</div>
