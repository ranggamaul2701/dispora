<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $kategori = $request->get('kategori');
        $q = trim((string) $request->get('q', ''));

        $berita = Berita::published()
            ->when($kategori && $kategori !== 'Semua', fn ($w) => $w->where('kategori', $kategori))
            ->when($q !== '', fn ($w) => $w->where(fn ($x) => $x->where('judul', 'like', "%{$q}%")->orWhere('ringkasan', 'like', "%{$q}%")))
            ->latest()->paginate(9)->withQueryString();

        $kategoriList = array_merge(['Semua'], config('pariwisata.kategori_berita'));

        return view('berita.index', compact('berita', 'kategoriList', 'kategori', 'q'));
    }

    public function show(string $slug)
    {
        $berita = Berita::published()->where('slug', $slug)->firstOrFail();
        $berita->increment('views');
        $lainnya = Berita::published()->where('id', '!=', $berita->id)->latest()->take(4)->get();

        return view('berita.detail', compact('berita', 'lainnya'));
    }
}
