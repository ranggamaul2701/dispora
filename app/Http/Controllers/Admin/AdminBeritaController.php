<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;

require_once app_path('helpers.php');

class AdminBeritaController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->get('q', ''));
        $kategori = $request->get('kategori');

        $berita = Berita::query()
            ->when($q !== '', fn ($w) => $w->where(fn ($x) => $x->where('judul', 'like', "%{$q}%")->orWhere('ringkasan', 'like', "%{$q}%")))
            ->when($kategori, fn ($w) => $w->where('kategori', $kategori))
            ->latest()->paginate(10)->withQueryString();

        return view('admin.berita.index', compact('berita', 'q', 'kategori'));
    }

    public function create()
    {
        return view('admin.berita.form', ['item' => null]);
    }

    public function store(Request $request)
    {
        $data = $this->payload($request);
        if ($request->hasFile('foto')) {
            $data['gambar'] = store_image($request->file('foto'), 'berita');
        }
        $item = Berita::create($data);

        return redirect()->route('admin.berita.index')->with('success', 'Berita "' . str($item->judul)->limit(50) . '" berhasil ditambahkan.');
    }

    public function edit(Berita $berita)
    {
        return view('admin.berita.form', ['item' => $berita]);
    }

    public function update(Request $request, Berita $berita)
    {
        $data = $this->payload($request);
        if ($request->hasFile('foto')) {
            delete_image($berita->gambar, 'berita');
            $data['gambar'] = store_image($request->file('foto'), 'berita');
        }
        $berita->update($data);

        return redirect()->route('admin.berita.index')->with('success', 'Berita "' . str($berita->judul)->limit(50) . '" berhasil diperbarui.');
    }

    public function destroy(Berita $berita)
    {
        $judul = str($berita->judul)->limit(50);
        delete_image($berita->gambar, 'berita');
        $berita->delete();

        return redirect()->route('admin.berita.index')->with('success', 'Berita "' . $judul . '" berhasil dihapus.');
    }

    private function payload(Request $request): array
    {
        $v = $request->validate([
            'judul'     => 'required|string|max:255',
            'kategori'  => 'required|string|max:100',
            'icon'      => 'nullable|string|max:20',
            'ringkasan' => 'required|string|max:500',
            'konten'    => 'required|string',
            'views'     => 'nullable|integer|min:0',
            'foto'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        return [
            'judul' => $v['judul'], 'kategori' => $v['kategori'], 'icon' => $v['icon'] ?: 'bi-newspaper',
            'ringkasan' => $v['ringkasan'], 'konten' => $v['konten'], 'views' => $v['views'] ?? 0,
            'is_published' => $request->boolean('is_published'),
        ];
    }
}
