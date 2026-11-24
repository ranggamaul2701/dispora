<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destinasi;
use Illuminate\Http\Request;

require_once app_path('helpers.php');

class AdminDestinasiController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->get('q', ''));
        $kategori = $request->get('kategori');

        $destinasi = Destinasi::query()
            ->when($q !== '', fn ($w) => $w->where(fn ($x) => $x->where('nama', 'like', "%{$q}%")->orWhere('alamat', 'like', "%{$q}%")))
            ->when($kategori, fn ($w) => $w->where('kategori', $kategori))
            ->latest()->paginate(10)->withQueryString();

        return view('admin.destinasi.index', compact('destinasi', 'q', 'kategori'));
    }

    public function create()
    {
        return view('admin.destinasi.form', ['item' => null]);
    }

    public function store(Request $request)
    {
        $data = $this->payload($request);
        if ($request->hasFile('foto')) {
            $data['gambar'] = store_image($request->file('foto'), 'destinasi');
        }

        // Upload foto-foto khusus destinasi (multiple)
        if ($request->hasFile('foto_tambahan')) {
            $tambahan = [];
            foreach ($request->file('foto_tambahan') as $f) {
                if ($f && $f->isValid()) {
                    $tambahan[] = store_image($f, 'destinasi');
                }
            }
            $data['foto_tambahan'] = $tambahan;
        }

        $item = Destinasi::create($data);

        return redirect()->route('admin.destinasi.index')->with('success', 'Destinasi "' . $item->nama . '" berhasil ditambahkan.');
    }

    public function edit(Destinasi $destinasi)
    {
        return view('admin.destinasi.form', ['item' => $destinasi]);
    }

    public function update(Request $request, Destinasi $destinasi)
    {
        $data = $this->payload($request);
        if ($request->hasFile('foto')) {
            delete_image($destinasi->gambar, 'destinasi');
            $data['gambar'] = store_image($request->file('foto'), 'destinasi');
        }

        // Kelola foto-foto khusus destinasi
        $existing = is_array($destinasi->foto_tambahan) ? $destinasi->foto_tambahan : [];

        // Hapus foto yang dipilih admin untuk dihapus
        if ($request->filled('hapus_foto_tambahan')) {
            $hapusList = (array) $request->input('hapus_foto_tambahan');
            foreach ($hapusList as $delPath) {
                delete_image($delPath, 'destinasi');
                $existing = array_values(array_filter($existing, fn ($p) => $p !== $delPath));
            }
        }

        // Tambah foto-foto baru
        if ($request->hasFile('foto_tambahan')) {
            foreach ($request->file('foto_tambahan') as $f) {
                if ($f && $f->isValid()) {
                    $existing[] = store_image($f, 'destinasi');
                }
            }
        }
        $data['foto_tambahan'] = $existing;

        $destinasi->update($data);

        return redirect()->route('admin.destinasi.index')->with('success', 'Destinasi "' . $destinasi->nama . '" berhasil diperbarui.');
    }

    public function destroy(Destinasi $destinasi)
    {
        $nama = $destinasi->nama;
        delete_image($destinasi->gambar, 'destinasi');

        if (!empty($destinasi->foto_tambahan) && is_array($destinasi->foto_tambahan)) {
            foreach ($destinasi->foto_tambahan as $delPath) {
                delete_image($delPath, 'destinasi');
            }
        }

        $destinasi->delete();

        return redirect()->route('admin.destinasi.index')->with('success', 'Destinasi "' . $nama . '" berhasil dihapus.');
    }

    private function payload(Request $request): array
    {
        $v = $request->validate([
            'nama'                  => 'required|string|max:200',
            'kategori'              => 'required|string|max:100',
            'icon'                  => 'nullable|string|max:20',
            'alamat'                => 'required|string',
            'deskripsi'             => 'required|string',
            'tips'                  => 'nullable|string',
            'maps'                  => 'nullable|string',
            'harga'                 => 'required|string|max:150',
            'jam'                   => 'required|string|max:150',
            'durasi'                => 'required|string|max:100',
            'rating'                => 'nullable|numeric|min:0|max:5',
            'ulasan'                => 'nullable|integer|min:0',
            'galeri_slug'           => 'nullable|string|max:100',
            'fasilitas'             => 'nullable|string',
            'foto'                  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'foto_tambahan'         => 'nullable|array',
            'foto_tambahan.*'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'hapus_foto_tambahan'   => 'nullable|array',
        ]);

        $fas = collect(preg_split('/[,\n]+/', (string) ($v['fasilitas'] ?? '')))
            ->map(fn ($s) => trim($s))->filter()->values()->all();

        return [
            'nama' => $v['nama'], 'kategori' => $v['kategori'], 'icon' => $v['icon'] ?: 'bi-geo-alt',
            'alamat' => $v['alamat'], 'deskripsi' => $v['deskripsi'], 'tips' => $v['tips'] ?? null, 'maps' => $v['maps'] ?? null,
            'harga' => $v['harga'], 'jam' => $v['jam'], 'durasi' => $v['durasi'],
            'rating' => $v['rating'] ?? 0, 'ulasan' => $v['ulasan'] ?? 0,
            'galeri_slug' => $v['galeri_slug'] ?? null, 'fasilitas' => $fas,
            'is_published' => $request->boolean('is_published'),
        ];
    }
}
