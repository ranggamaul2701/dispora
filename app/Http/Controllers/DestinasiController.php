<?php

namespace App\Http\Controllers;

use App\Models\Destinasi;
use App\Support\Gallery;
use Illuminate\Http\Request;

class DestinasiController extends Controller
{
    public function index(Request $request)
    {
        $kategori = $request->get('kategori');
        $q = trim((string) $request->get('q', ''));

        $destinasi = Destinasi::published()
            ->when($kategori && $kategori !== 'Semua', fn ($w) => $w->where('kategori', $kategori))
            ->when($q !== '', fn ($w) => $w->where(fn ($x) => $x->where('nama', 'like', "%{$q}%")
                ->orWhere('alamat', 'like', "%{$q}%")->orWhere('deskripsi', 'like', "%{$q}%")))
            ->orderByDesc('rating')->paginate(9)->withQueryString();

        $kategoriList = array_merge(['Semua'], config('pariwisata.kategori_destinasi'));

        return view('destinasi.index', compact('destinasi', 'kategoriList', 'kategori', 'q'));
    }

    public function show(string $slug)
    {
        $item = Destinasi::published()->where('slug', $slug)->firstOrFail();
        $lainnya = Destinasi::published()->where('id', '!=', $item->id)->orderByDesc('rating')->take(4)->get();

        // Gunakan foto-foto khusus destinasi tersebut jika ada, atau fallback ke album galeri umum
        if (!empty($item->foto_tambahan) && count($item->foto_tambahan) > 0) {
            $foto = $item->galeri_foto;
        } elseif ($item->galeri_slug) {
            $foto = array_slice(Gallery::photos($item->galeri_slug), 0, 8);
        } else {
            $foto = [];
        }

        return view('destinasi.detail', compact('item', 'lainnya', 'foto'));
    }
}
