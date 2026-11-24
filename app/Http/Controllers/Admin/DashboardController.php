<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use App\Models\Berita;
use App\Models\Destinasi;
use App\Models\Pesan;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->get('search', ''));

        $stats = [
            'destinasi' => Destinasi::count(),
            'berita'    => Berita::count(),
            'agenda'    => Agenda::count(),
            'users'     => User::count(),
            'pesan'     => Pesan::where('dibaca', false)->count(),
            'views'     => (int) Berita::sum('views'),
        ];

        $berita = Berita::latest()
            ->when($search !== '', fn ($w) => $w->where(fn ($x) => $x->where('judul', 'like', "%{$search}%")->orWhere('kategori', 'like', "%{$search}%")))
            ->take(6)->get();

        $agenda = Agenda::orderBy('tanggal_mulai')
            ->when($search !== '', fn ($w) => $w->where(fn ($x) => $x->where('nama', 'like', "%{$search}%")->orWhere('lokasi', 'like', "%{$search}%")))
            ->when($search === '', fn ($w) => $w->whereDate('tanggal_selesai', '>=', today()))
            ->take(5)->get();

        $destinasi = Destinasi::latest()
            ->when($search !== '', fn ($w) => $w->where(fn ($x) => $x->where('nama', 'like', "%{$search}%")->orWhere('kategori', 'like', "%{$search}%")))
            ->take(5)->get();

        $pesan = Pesan::latest()->take(4)->get();

        return view('admin.dashboard', compact('stats', 'berita', 'agenda', 'destinasi', 'pesan', 'search'));
    }
}
