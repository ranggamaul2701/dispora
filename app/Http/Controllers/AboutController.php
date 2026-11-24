<?php

namespace App\Http\Controllers;

class AboutController extends Controller
{
    public function index()
    {
        $struktur = [
            ['jabatan' => 'Kepala Bidang Pariwisata',    'nama' => 'Diana Pida, SE, M.Si',   'foto' => 'kabid-pariwisata.jpg'],
            ['jabatan' => 'Mahasiswa Magang UMKT', 'nama' => 'Rangga Maulana Ikhza Prabowo', 'foto' => 'rangga.jpg'],
            ['jabatan' => 'Mahasiswa Magang UMKT',         'nama' => 'Rizky Nur Intan Putri',     'foto' => 'intan.jpg'],
            ['jabatan' => 'Kepala Bidang Ekonomi Kreatif', 'nama' => 'Agnes Gering Belawing, SP',        'foto' => 'kepala-bidang-ekraf.jpg'],
            ['jabatan' => 'Mahasiswa Magang UMKT',           'nama' => 'Nurul Aini',        'foto' => 'nurul.jpg'],
            ['jabatan' => 'Kepala Dinas Dinas Pemuda Olahraga Dan Pariwisata',        'nama' => 'H. Muslimin, S.E., M.Si',          'foto' => 'kadis.jpg'],
        ];

        return view('about.index', compact('struktur'));
    }
}
