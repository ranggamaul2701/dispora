<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Destinasi;

class LayananController extends Controller
{
    public function peta()
    {
        $destinasi = Destinasi::published()->orderBy('nama')->get();

        return view('layanan.peta', compact('destinasi'));
    }

    public function statistik()
    {
        return view('layanan.statistik', [
            'totalDestinasi' => Destinasi::published()->count(),
            'totalAgenda'    => Agenda::published()->count(),
            'top'            => Destinasi::published()->orderByDesc('ulasan')->take(5)->get(),
        ]);
    }

    public function kalkulator()
    {
        $destinasi = Destinasi::published()->orderBy('nama')->get();

        return view('layanan.kalkulator', compact('destinasi'));
    }

    public function kalender()
    {
        $events = Agenda::published()->orderBy('tanggal_mulai')->get()->map(fn ($a) => [
            'id'      => $a->id,
            'nama'    => $a->nama,
            'mulai'   => $a->tanggal_mulai->format('Y-m-d'),
            'selesai' => $a->tanggalAkhir()->format('Y-m-d'),
            'kat'     => $a->kategori,
            'icon'    => $a->icon,
            'lokasi'  => $a->lokasi,
            'jam'     => $a->jam_mulai,
            'url'     => route('agenda.show', $a->id),
        ])->values();

        return view('layanan.kalender', compact('events'));
    }

    public function itinerary()
    {
        $destinasi = Destinasi::published()->orderBy('nama')->get(['id', 'nama', 'icon', 'kategori', 'harga', 'durasi']);

        return view('layanan.itinerary', compact('destinasi'));
    }
}
