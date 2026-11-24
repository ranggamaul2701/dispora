<?php

namespace Database\Seeders;

use App\Models\Agenda;
use App\Models\Berita;
use App\Models\Destinasi;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create(['name' => 'Admin Disporapar', 'email' => 'admin@disporapar.go.id', 'password' => Hash::make('Admin@2025'), 'role' => 'admin']);
        User::create(['name' => 'Tamu Wisatawan', 'email' => 'tamu@example.com', 'password' => Hash::make('Tamu@2025'), 'role' => 'tamu']);

        // ── DESTINASI ─────────────────────────────────────
        $destinasi = [
            ['nama' => 'Tepian Mahakam', 'kategori' => 'Wisata Alam', 'gambar' => 'tepian-mahakam.jpg', 'icon' => 'bi-water', 'rating' => 4.8, 'ulasan' => 2340, 'harga' => 'Gratis', 'jam' => '24 Jam', 'durasi' => '1 - 3 Jam',
                'alamat' => 'Jl. Gadjah Mada, Samarinda Ulu, Kota Samarinda, Kalimantan Timur', 'galeri_slug' => 'tepian-mahakam',
                'deskripsi' => 'Tepian Mahakam adalah kawasan wisata ikonik di tepi Sungai Mahakam yang menjadi kebanggaan Kota Samarinda. Kawasan ini menawarkan pemandangan sungai yang memukau, terutama saat senja tiba dengan warna langit yang memantul indah di permukaan air. Berbagai kuliner khas Samarinda tersedia di sepanjang tepian.',
                'fasilitas' => ['Parkir Luas', 'Toilet Umum', 'Warung Makan', 'Area Bersantai', 'Spot Foto', 'Penerangan Malam'],
                'tips' => 'Kunjungi saat sore hari (17.00–19.00) untuk menikmati senja terbaik. Bawa kamera untuk mengabadikan momen sunset.'],
            ['nama' => 'Islamic Center Samarinda', 'kategori' => 'Wisata Religi', 'gambar' => 'islamic-center.jpg', 'icon' => 'bi-building', 'rating' => 4.9, 'ulasan' => 3120, 'harga' => 'Gratis', 'jam' => '08.00 - 17.00 WITA', 'durasi' => '1 - 2 Jam',
                'alamat' => 'Jl. Slamet Riyadi, Teluk Lerong Ulu, Samarinda Ulu, Kota Samarinda', 'galeri_slug' => 'wisata-budaya',
                'deskripsi' => 'Islamic Center Samarinda adalah masjid termegah di Kalimantan Timur dengan kubah emas yang menjulang tinggi dan arsitektur islami yang menakjubkan. Masjid ini menjadi landmark kebanggaan Kota Samarinda sekaligus destinasi wisata religi utama.',
                'fasilitas' => ['Parkir Luas', 'Toilet', 'Tempat Wudhu', 'Taman', 'Kantin'],
                'tips' => 'Gunakan pakaian sopan saat berkunjung. Kunjungi pagi hari untuk foto terbaik dengan cahaya yang optimal.'],
            ['nama' => 'Kebun Raya Unmul Samarinda', 'kategori' => 'Wisata Alam', 'gambar' => 'kebun-raya.jpg', 'icon' => 'bi-tree', 'rating' => 4.5, 'ulasan' => 1890, 'harga' => 'Rp 10.000 / orang', 'jam' => '07.00 - 17.00 WITA', 'durasi' => '2 - 4 Jam',
                'alamat' => 'Jl. Sempaja, Samarinda Utara, Kota Samarinda, Kalimantan Timur', 'galeri_slug' => 'wisata-alam',
                'deskripsi' => 'Kawasan hutan wisata seluas 300 hektar yang dikelola Universitas Mulawarman. Terdapat danau yang indah, koleksi flora dan fauna khas Kalimantan, kebun binatang mini, dan berbagai wahana outbond untuk keluarga.',
                'fasilitas' => ['Parkir', 'Toilet', 'Kantin', 'Kebun Binatang Mini', 'Danau', 'Outbond', 'Area Piknik'],
                'tips' => 'Bawa bekal makanan dan gunakan sepatu yang nyaman. Kunjungi di hari kerja untuk menghindari keramaian.'],
            ['nama' => 'Museum Mulawarman', 'kategori' => 'Wisata Budaya', 'gambar' => 'museum-mulawarman.jpg', 'icon' => 'bi-bank', 'rating' => 4.6, 'ulasan' => 1240, 'harga' => 'Rp 5.000 / orang', 'jam' => '08.00 - 16.00 WITA (Tutup Senin)', 'durasi' => '1 - 3 Jam',
                'alamat' => 'Jl. Diponegoro No. 25, Tenggarong, Kutai Kartanegara, Kalimantan Timur', 'galeri_slug' => 'wisata-budaya',
                'deskripsi' => 'Museum Mulawarman menyimpan ribuan koleksi benda bersejarah peninggalan Kerajaan Kutai Kartanegara, kerajaan Hindu tertua di Indonesia. Tersimpan mahkota kerajaan, singgasana, peralatan perang kuno, dan berbagai artefak budaya Kutai.',
                'fasilitas' => ['Parkir', 'Toilet', 'Pemandu Wisata', 'Toko Souvenir', 'Ruang Pameran Ber-AC'],
                'tips' => 'Sewa pemandu wisata untuk penjelasan sejarah yang lebih mendalam. Museum tutup setiap hari Senin.'],
            ['nama' => 'Kampung Kuliner Samarinda', 'kategori' => 'Wisata Kuliner', 'gambar' => 'kampung-kuliner.jpg', 'icon' => 'bi-cup-hot', 'rating' => 4.7, 'ulasan' => 2780, 'harga' => 'Mulai Rp 15.000 / menu', 'jam' => '10.00 - 22.00 WITA', 'durasi' => '1 - 2 Jam',
                'alamat' => 'Jl. Pasar Pagi, Samarinda Kota, Kota Samarinda, Kalimantan Timur', 'galeri_slug' => 'kuliner',
                'deskripsi' => 'Surga bagi pecinta makanan yang ingin mencicipi cita rasa khas Kalimantan Timur. Tersedia lebih dari 50 pilihan kuliner mulai dari Nasi Kuning, Soto Banjar, Amplang, Pisang Gapit, hingga seafood segar dari Sungai Mahakam.',
                'fasilitas' => ['Parkir', 'Toilet', 'Area Makan Indoor & Outdoor', 'WiFi', 'Pembayaran QRIS'],
                'tips' => 'Wajib coba Nasi Kuning dan Amplang sebagai oleh-oleh. Kunjungi malam hari untuk suasana yang lebih meriah.'],
            ['nama' => 'Wisata Sungai Mahakam', 'kategori' => 'Wisata Air', 'gambar' => 'wisata-sungai.jpg', 'icon' => 'bi-compass', 'rating' => 4.6, 'ulasan' => 980, 'harga' => 'Rp 50.000 - Rp 200.000 / perahu', 'jam' => '06.00 - 17.00 WITA', 'durasi' => '2 - 5 Jam',
                'alamat' => 'Dermaga Mahakam, Jl. Yos Sudarso, Samarinda Seberang, Kota Samarinda', 'galeri_slug' => 'wisata-alam',
                'deskripsi' => 'Jelajahi Sungai Mahakam dengan perahu tradisional. Nikmati pemandangan kehidupan di tepian sungai, desa-desa adat, dan jika beruntung melihat Pesut Mahakam — lumba-lumba air tawar langka yang hanya ada di Sungai Mahakam.',
                'fasilitas' => ['Perahu Tradisional', 'Pelampung', 'Pemandu Lokal', 'Warung di Dermaga'],
                'tips' => 'Berangkat pagi (06.00–08.00) untuk peluang melihat Pesut Mahakam lebih besar. Bawa topi dan sunscreen.'],
        ];
        foreach ($destinasi as $d) {
            Destinasi::create($d);
        }

        // ── BERITA ────────────────────────────────────────
        $berita = [
            ['Festival Pesona Wisata Samarinda Resmi Dibuka, Ribuan Wisatawan Hadir', 'Festival', 'bi-calendar-event', 'Festival tahunan yang menampilkan kekayaan budaya, kuliner, dan destinasi wisata Kota Samarinda menarik ribuan pengunjung.', 'Festival Pesona Wisata Samarinda resmi dibuka di kawasan Tepian Mahakam. Selama lima hari, festival menampilkan atraksi budaya, kuliner khas, pameran UMKM, dan pertunjukan seni.', 389, '2026-10-20'],
            ['5 Destinasi Wisata Baru di Tepian Mahakam yang Wajib Dikunjungi', 'Destinasi', 'bi-geo-alt', 'Kawasan Tepian Mahakam terus berkembang dengan hadirnya destinasi wisata baru bagi wisatawan lokal maupun mancanegara.', 'Kawasan Tepian Mahakam semakin berkembang sebagai pusat wisata unggulan. Lima destinasi baru telah dibuka: Taman Kuliner Tepian, Galeri Seni Mahakam, Spot Foto Jembatan, Area Pasar Rakyat, dan Dermaga Wisata Tradisional.', 456, '2026-10-12'],
            ['Kampung Kuliner Samarinda Jadi Destinasi Gastronomi Terfavorit', 'Kuliner', 'bi-cup-hot', 'Wisatawan kini dapat menikmati lebih dari 50 jenis kuliner khas Samarinda di kawasan Kampung Kuliner.', 'Kampung Kuliner Samarinda ditetapkan sebagai destinasi gastronomi terfavorit di Kalimantan Timur. Tersedia nasi kuning, soto banjar, amplang, hingga seafood segar dari Sungai Mahakam.', 312, '2026-10-05'],
            ['Islamic Center Samarinda Jadi Destinasi Wisata Religi Andalan Kaltim', 'Wisata Religi', 'bi-building', 'Masjid Islamic Center yang megah kini menjadi destinasi wisata religi paling dikunjungi di Kalimantan Timur.', 'Dengan arsitektur islami yang megah dan kubah emas yang ikonik, Islamic Center Samarinda menarik wisatawan dari seluruh Indonesia.', 520, '2026-09-28'],
            ['Disporapar Gelar Pelatihan Pemandu Wisata Bersertifikat', 'Program', 'bi-award', 'Sebanyak 60 calon pemandu wisata mengikuti pelatihan bersertifikat yang diselenggarakan Bidang Pariwisata.', 'Bidang Pengembangan Pariwisata menyelenggarakan Pelatihan Pemandu Wisata Bersertifikat yang diikuti 60 peserta dari berbagai latar belakang untuk meningkatkan kualitas SDM pariwisata.', 218, '2026-09-15'],
            ['Ekowisata Pesut Mahakam Resmi Dibuka untuk Wisatawan', 'Ekowisata', 'bi-water', 'Program ekowisata yang memperkenalkan pesut Mahakam, lumba-lumba air tawar langka, kini resmi dibuka.', 'Program Ekowisata Pesut Mahakam diluncurkan oleh Bidang Pengembangan Pariwisata. Wisatawan dapat menikmati pengalaman melihat pesut Mahakam dengan tetap menjaga kelestariannya.', 634, '2026-09-02'],
            ['Festival Budaya Kutai Tampilkan Ratusan Seniman Lokal', 'Festival', 'bi-palette', 'Ratusan seniman lokal tampil dalam pertunjukan tari, musik, dan kerajinan khas Kalimantan Timur.', 'Festival Budaya Kutai berlangsung meriah di Tepian Mahakam. Ratusan seniman lokal menampilkan tari tradisional, musik, dan pameran kerajinan khas Kutai.', 445, '2026-08-22'],
            ['Program Desa Wisata Samarinda Dongkrak Ekonomi Masyarakat', 'Program', 'bi-houses', 'Pengembangan desa wisata berhasil meningkatkan pendapatan masyarakat lokal.', 'Program Desa Wisata yang digagas Bidang Pengembangan Pariwisata berhasil meningkatkan taraf hidup masyarakat di sekitar kawasan wisata melalui homestay, kuliner, dan kerajinan.', 287, '2026-08-10'],
            ['Samarinda Masuk Daftar Kota Wisata Terbaik Kalimantan', 'Destinasi', 'bi-trophy', 'Samarinda masuk dalam daftar kota wisata terbaik di Kalimantan berkat pengembangan destinasi dan event.', 'Pengembangan destinasi, peningkatan kualitas layanan, dan rangkaian event wisata membawa Samarinda masuk dalam daftar kota wisata terbaik di Kalimantan.', 891, '2026-07-30'],
        ];
        foreach ($berita as $i => $b) {
            $m = new Berita([
                'judul' => $b[0], 'kategori' => $b[1], 'icon' => $b[2], 'ringkasan' => $b[3],
                'konten' => '<p>' . $b[4] . '</p><p>Bidang Pengembangan Pariwisata Disporapar Kota Samarinda terus berkomitmen mendorong pertumbuhan sektor pariwisata melalui pengembangan destinasi, promosi, dan pemberdayaan pelaku ekonomi kreatif.</p>',
                'views' => $b[5], 'gambar' => 'berita-' . ($i + 1) . '.jpg', 'is_published' => true,
            ]);
            $m->created_at = $b[6] . ' 09:00:00';
            $m->updated_at = $b[6] . ' 09:00:00';
            $m->save();
        }

        // ── AGENDA ────────────────────────────────────────
        $agenda = [
            ['Jalan Sehat Wisata Tepian Mahakam', 'Tepian Mahakam, Samarinda', '2026-11-08', '2026-11-08', '06.00', 'Olahraga', 'bi-person-walking', 'Jalan sehat keluarga menyusuri kawasan Tepian Mahakam sambil menikmati udara pagi. Terbuka untuk umum dengan berbagai doorprize menarik.', 'Disporapar Kota Samarinda', 'jalan-sehat.jpg'],
            ['Festival Mahakam', 'Tepian Mahakam, Samarinda', '2026-11-20', '2026-11-23', '09.00', 'Festival', 'bi-calendar-event', 'Festival tahunan yang menampilkan kekayaan budaya, kuliner, dan destinasi wisata Kota Samarinda. Dihadiri wisatawan dari seluruh Kalimantan Timur dan luar provinsi.', 'Bidang Pariwisata Disporapar', 'festival-mahakam.jpg'],
            ['Pelatihan Pemandu Wisata Bersertifikat', 'Aula Disporapar, Jl. Basuki Rahmat', '2026-12-02', '2026-12-04', '08.00', 'Pelatihan', 'bi-award', 'Pelatihan intensif pemandu wisata dengan sertifikasi resmi. Peserta mendapatkan materi pelayanan wisata, sejarah lokal, dan bahasa asing dasar.', 'Bidang Pariwisata Disporapar', null],
            ['Festival Budaya Kutai', 'Kawasan Cagar Budaya Samarinda', '2026-12-12', '2026-12-14', '10.00', 'Budaya', 'bi-bank', 'Pertunjukan seni tradisional, pameran benda bersejarah, dan wisata malam kawasan cagar budaya dengan ratusan seniman lokal.', 'Bidang Pariwisata Disporapar', 'festival-budaya.jpg'],
            ['Pameran Produk UMKM & Ekonomi Kreatif', 'Mall Samarinda Square', '2027-01-16', '2027-01-20', '10.00', 'Ekonomi Kreatif', 'bi-palette', 'Pameran produk UMKM dan kerajinan khas Samarinda: tenun, manik Dayak, ukiran kayu, dan batik lokal. Terbuka untuk umum.', 'Bidang Ekonomi Kreatif Disporapar', 'ekraf/ekraf-utama.jpg'],
            ['Promosi Wisata Samarinda', 'Kawasan Tepian Mahakam', '2027-02-06', '2027-02-07', '15.00', 'Pameran', 'bi-megaphone', 'Kampanye promosi destinasi wisata Samarinda bersama pelaku wisata, komunitas, dan media. Ada pameran foto dan bazar kuliner.', 'Bidang Promosi Disporapar', 'wisata-samarinda.jpg'],
        ];
        foreach ($agenda as $a) {
            Agenda::create([
                'nama' => $a[0], 'lokasi' => $a[1], 'tanggal_mulai' => $a[2], 'tanggal_selesai' => $a[3], 'jam_mulai' => $a[4],
                'kategori' => $a[5], 'icon' => $a[6], 'deskripsi' => $a[7], 'penyelenggara' => $a[8], 'kontak' => '(0541) 123-456',
                'gambar' => $a[9], 'is_published' => true,
            ]);
        }
    }
}
