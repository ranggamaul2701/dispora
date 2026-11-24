<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public function index(Request $request)
    {
        $kategori = $request->get('kategori');
        $q = trim((string) $request->get('q', ''));

        $agenda = Agenda::published()
            ->when($kategori && $kategori !== 'Semua', fn ($w) => $w->where('kategori', $kategori))
            ->when($q !== '', fn ($w) => $w->where(fn ($x) => $x->where('nama', 'like', "%{$q}%")->orWhere('lokasi', 'like', "%{$q}%")))
            ->orderByRaw('COALESCE(tanggal_selesai, tanggal_mulai) < CURDATE()')
            ->orderBy('tanggal_mulai')
            ->paginate(9)->withQueryString();

        $kategoriList = array_merge(['Semua'], config('pariwisata.kategori_agenda'));

        return view('agenda.index', compact('agenda', 'kategoriList', 'kategori', 'q'));
    }

    public function show(Agenda $agenda)
    {
        abort_unless($agenda->is_published, 404);

        $lainnya = Agenda::published()->where('id', '!=', $agenda->id)
            ->whereDate('tanggal_mulai', '>=', today())->orderBy('tanggal_mulai')->take(3)->get();

        return view('agenda.detail', compact('agenda', 'lainnya'));
    }
}
