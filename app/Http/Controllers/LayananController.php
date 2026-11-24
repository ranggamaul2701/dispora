<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Destinasi;
use Illuminate\Support\Str;

require_once app_path('helpers.php');

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
        $destinasi = Destinasi::published()->orderBy('nama')->get()->map(function ($d) {
            preg_match_all('/\d[\d.]*/', (string) $d->harga, $m);
            $angka = collect($m[0])->map(fn ($x) => (int) str_replace('.', '', $x))->filter()->values();
            $tarif = $angka->first() ?? 0;

            return [
                'id'       => $d->id,
                'nama'     => $d->nama,
                'kategori' => $d->kategori,
                'icon'     => $d->icon ?: 'bi-geo-alt',
                'harga'    => $d->harga,
                'tarif'    => $tarif,
                'durasi'   => $d->durasi,
                'gambar'   => media_url($d->gambar, 'destinasi'),
                'rating'   => $d->rating ?? 0,
                'ulasan'   => $d->ulasan ?? 0,
                'alamat'   => $d->alamat,
                'url'      => route('destinasi.show', $d->slug),
            ];
        });

        $kategoriList = collect($destinasi)->pluck('kategori')->filter()->unique()->values();

        return view('layanan.kalkulator', compact('destinasi', 'kategoriList'));
    }

    public function kalender()
    {
        $events = Agenda::published()->orderBy('tanggal_mulai')->get()->map(fn ($a) => [
            'id'             => $a->id,
            'nama'           => $a->nama,
            'mulai'          => $a->tanggal_mulai->format('Y-m-d'),
            'selesai'        => $a->tanggalAkhir()->format('Y-m-d'),
            'mulai_format'   => $a->tanggal_mulai->translatedFormat('d M Y'),
            'selesai_format' => $a->tanggalAkhir()->translatedFormat('d M Y'),
            'kat'            => $a->kategori,
            'icon'           => $a->icon ?: 'bi-calendar-event',
            'lokasi'         => $a->lokasi,
            'jam'            => $a->jam_mulai,
            'gambar'         => media_url($a->gambar, 'agenda'),
            'deskripsi'      => Str::limit(strip_tags((string) $a->deskripsi), 130),
            'penyelenggara'  => $a->penyelenggara,
            'url'            => route('agenda.show', $a->id),
        ])->values();

        $kategoriList = Agenda::published()->whereNotNull('kategori')->pluck('kategori')->filter()->unique()->values();

        return view('layanan.kalender', compact('events', 'kategoriList'));
    }

    public function itinerary()
    {
        $destinasi = Destinasi::published()->orderBy('nama')->get()->map(function ($d) {
            preg_match_all('/\d[\d.]*/', (string) $d->harga, $m);
            $angka = collect($m[0])->map(fn ($x) => (int) str_replace('.', '', $x))->filter()->values();
            $tarif = $angka->first() ?? 0;

            return [
                'id'       => $d->id,
                'nama'     => $d->nama,
                'kategori' => $d->kategori,
                'icon'     => $d->icon ?: 'bi-geo-alt',
                'harga'    => $d->harga,
                'tarif'    => $tarif,
                'durasi'   => $d->durasi,
                'alamat'   => $d->alamat,
                'jam'      => $d->jam,
                'gambar'   => media_url($d->gambar, 'destinasi'),
                'rating'   => $d->rating ?? 0,
                'url'      => route('destinasi.show', $d->slug),
            ];
        });

        $kategoriList = collect($destinasi)->pluck('kategori')->filter()->unique()->values();

        return view('layanan.itinerary', compact('destinasi', 'kategoriList'));
    }
}
