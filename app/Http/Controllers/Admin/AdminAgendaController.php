<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use Illuminate\Http\Request;

require_once app_path('helpers.php');

class AdminAgendaController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->get('q', ''));
        $kategori = $request->get('kategori');

        $agenda = Agenda::query()
            ->when($q !== '', fn ($w) => $w->where(fn ($x) => $x->where('nama', 'like', "%{$q}%")->orWhere('lokasi', 'like', "%{$q}%")))
            ->when($kategori, fn ($w) => $w->where('kategori', $kategori))
            ->orderByDesc('tanggal_mulai')->paginate(10)->withQueryString();

        return view('admin.agenda.index', compact('agenda', 'q', 'kategori'));
    }

    public function create()
    {
        return view('admin.agenda.form', ['item' => null]);
    }

    public function store(Request $request)
    {
        $data = $this->payload($request);
        if ($request->hasFile('foto')) {
            $data['gambar'] = store_image($request->file('foto'), 'agenda');
        }
        $item = Agenda::create($data);

        return redirect()->route('admin.agenda.index')->with('success', 'Agenda "' . $item->nama . '" berhasil ditambahkan.');
    }

    public function edit(Agenda $agenda)
    {
        return view('admin.agenda.form', ['item' => $agenda]);
    }

    public function update(Request $request, Agenda $agenda)
    {
        $data = $this->payload($request);
        if ($request->hasFile('foto')) {
            delete_image($agenda->gambar, 'agenda');
            $data['gambar'] = store_image($request->file('foto'), 'agenda');
        }
        $agenda->update($data);

        return redirect()->route('admin.agenda.index')->with('success', 'Agenda "' . $agenda->nama . '" berhasil diperbarui.');
    }

    public function destroy(Agenda $agenda)
    {
        $nama = $agenda->nama;
        delete_image($agenda->gambar, 'agenda');
        $agenda->delete();

        return redirect()->route('admin.agenda.index')->with('success', 'Agenda "' . $nama . '" berhasil dihapus.');
    }

    private function payload(Request $request): array
    {
        $v = $request->validate([
            'nama'            => 'required|string|max:255',
            'lokasi'          => 'required|string|max:255',
            'tanggal_mulai'   => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'jam_mulai'       => 'nullable|string|max:50',
            'kategori'        => 'required|string|max:100',
            'icon'            => 'nullable|string|max:20',
            'deskripsi'       => 'required|string',
            'penyelenggara'   => 'nullable|string|max:150',
            'kontak'          => 'nullable|string|max:150',
            'foto'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        return [
            'nama' => $v['nama'], 'lokasi' => $v['lokasi'], 'tanggal_mulai' => $v['tanggal_mulai'],
            'tanggal_selesai' => $v['tanggal_selesai'] ?? $v['tanggal_mulai'], 'jam_mulai' => $v['jam_mulai'] ?? null,
            'kategori' => $v['kategori'], 'icon' => $v['icon'] ?: 'bi-calendar-event', 'deskripsi' => $v['deskripsi'],
            'penyelenggara' => $v['penyelenggara'] ?? null, 'kontak' => $v['kontak'] ?? null,
            'is_published' => $request->boolean('is_published'),
        ];
    }
}
