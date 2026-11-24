<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Berita;
use App\Models\Destinasi;
use App\Support\Gallery;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index', [
            'destinasi' => Destinasi::published()->orderByDesc('rating')->take(6)->get(),
            'berita'    => Berita::published()->latest()->take(3)->get(),
            'agenda'    => Agenda::published()->whereDate('tanggal_selesai', '>=', today())->orderBy('tanggal_mulai')->take(4)->get(),
            'galeri'    => Gallery::featured(8),
        ]);
    }

    public function search(Request $request)
    {
        $q = trim((string) $request->get('q', ''));
        $destinasi = $berita = $agenda = collect();

        if ($q !== '') {
            $like = '%' . $q . '%';
            $destinasi = Destinasi::published()->where(fn ($w) => $w->where('nama', 'like', $like)
                ->orWhere('kategori', 'like', $like)->orWhere('alamat', 'like', $like)->orWhere('deskripsi', 'like', $like))->take(12)->get();
            $berita = Berita::published()->where(fn ($w) => $w->where('judul', 'like', $like)
                ->orWhere('ringkasan', 'like', $like)->orWhere('kategori', 'like', $like))->latest()->take(12)->get();
            $agenda = Agenda::published()->where(fn ($w) => $w->where('nama', 'like', $like)
                ->orWhere('lokasi', 'like', $like)->orWhere('deskripsi', 'like', $like))->orderBy('tanggal_mulai')->take(12)->get();
        }

        return view('search.index', compact('q', 'destinasi', 'berita', 'agenda'));
    }
}
