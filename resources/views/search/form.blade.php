<form method="GET" action="{{ route('search') }}" class="search-bar" style="max-width:560px;margin:8px 0 12px">
    <input class="form-input" type="text" name="q" value="{{ $q }}" placeholder="Cari destinasi, berita, agenda..." autofocus>
    <button class="btn-primary-custom" type="submit"><i class="bi bi-search"></i> Cari</button>
</form>
