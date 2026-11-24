@php
    $bgUrl = $bgUrl ?? asset('images/hero/' . ($bg ?? 'hero-bg-1.jpg'));
    $crumbs = $crumbs ?? [];
@endphp
<section class="page-banner">
    <div class="page-banner-bg" style="background-image:url('{{ $bgUrl }}')"></div>
    <div class="page-banner-overlay"></div>
    <div class="container page-banner-content">
        @isset($badge)<div class="banner-badge">{!! $badge !!}</div>@endisset
        <h1>{{ $title }}</h1>
        @isset($sub)<p class="lead-sub">{{ $sub }}</p>@endisset
        @isset($extra){!! $extra !!}@endisset
        <nav aria-label="breadcrumb" class="mt-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                @foreach($crumbs as $i => $c)
                    @if($i === count($crumbs) - 1 || empty($c[1]))
                        <li class="breadcrumb-item active">{{ $c[0] }}</li>
                    @else
                        <li class="breadcrumb-item"><a href="{{ $c[1] }}">{{ $c[0] }}</a></li>
                    @endif
                @endforeach
            </ol>
        </nav>
    </div>
</section>
