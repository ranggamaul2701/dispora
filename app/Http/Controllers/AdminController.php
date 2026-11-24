<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct() { $this->middleware('auth'); }

    public function dashboard()
    {
        $stats = [
            ['label'=>'Total Berita',      'value'=>6,  'icon'=>'bi-newspaper','color'=>'primary'],
            ['label'=>'Album Galeri',       'value'=>6,  'icon'=>'bi-images','color'=>'success'],
            ['label'=>'Agenda Pariwisata',  'value'=>6,  'icon'=>'bi-calendar-event','color'=>'warning'],
            ['label'=>'Pesan Masuk',        'value'=>12, 'icon'=>'bi-envelope','color'=>'info'],
        ];
        $beritaTerbaru = collect([
            ['judul'=>'Festival Pesona Wisata Samarinda 2025 Dibuka','kategori'=>'Festival','tanggal'=>'07 Jul 2025','slug'=>'festival-pesona-wisata-2025'],
            ['judul'=>'5 Destinasi Baru di Tepian Mahakam','kategori'=>'Destinasi','tanggal'=>'20 Jun 2025','slug'=>'destinasi-wisata-mahakam'],
            ['judul'=>'Kampung Kuliner Samarinda Jadi Terfavorit','kategori'=>'Kuliner','tanggal'=>'14 Jun 2025','slug'=>'kuliner-kampung-wisata'],
        ]);
        $agendaMendatang = collect([
            ['nama'=>'Festival Pesona Wisata Samarinda 2025','tanggal'=>'26 Jul 2025','lokasi'=>'Tepian Mahakam'],
            ['nama'=>'Pameran UMKM & Kerajinan Samarinda','tanggal'=>'10 Ags 2025','lokasi'=>'Mall Samarinda Square'],
            ['nama'=>'Samarinda Culture & Heritage Night','tanggal'=>'17 Sep 2025','lokasi'=>'Kawasan Cagar Budaya'],
        ]);
        return view('admin.dashboard', compact('stats','beritaTerbaru','agendaMendatang'));
    }
}
