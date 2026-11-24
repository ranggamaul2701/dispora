(function () {
    var win = document.getElementById('chatWindow');
    if (!win) return;
    var msgs = document.getElementById('chatMsgs'), input = document.getElementById('chatInput'), icon = document.getElementById('chatIcon');

    var kb = [
        ['halo|hai|hello|selamat|pagi|siang|sore|malam', 'Halo! Selamat datang di Layanan Informasi Wisata Samarinda.\nAda yang bisa kami bantu seputar destinasi, jadwal event, akomodasi, atau rute perjalanan Anda?'],
        ['tepian|mahakam', 'Tepian Mahakam:\n• Tiket: Gratis, Buka 24 jam\n• Waktu terbaik: 17.00–19.00 WITA untuk menikmati pemandangan senja Sungai Mahakam\n• Fasilitas: Area santai, kuliner malam, spot foto, dan dermaga kapal wisata.'],
        ['islamic|masjid', 'Masjid Islamic Center Samarinda:\n• Tiket: Gratis, Buka 08.00–17.00 WITA\n• Merupakan masjid megah ikonik dengan menara setinggi 99 meter.\n• Pengunjung diimbau mengenakan busana yang sopan dan rapi.'],
        ['kebun|raya|unmul', 'Kebun Raya Unmul Samarinda (KRUS):\n• Tiket: Rp 10.000 / orang, Buka 07.00–17.00 WITA\n• Hutan botani seluas 300 hektar dengan danau rekreasi, panggung seni, dan museum kayu.'],
        ['museum|mulawarman', 'Museum Mulawarman:\n• Tiket: Rp 5.000 / orang, Buka 08.00–16.00 WITA (Senin Tutup)\n• Menyimpan peninggalan bersejarah Kesultanan Kutai Kartanegara dan kebudayaan Kalimantan Timur.'],
        ['tiket|harga|biaya|tarif', 'Informasi Tarif Tiket Masuk Destinasi Samarinda:\n• Tepian Mahakam & Islamic Center: Gratis\n• Kebun Raya Unmul: Rp 10.000\n• Museum Mulawarman: Rp 5.000\n• Kapal Susur Sungai Mahakam: Rp 50.000\nSilakan coba simulasi lengkap di menu Layanan > Kalkulator Biaya Wisata.'],
        ['jam|buka|tutup|operasional', 'Jam Operasional Destinasi:\n• Tepian Mahakam: Buka 24 Jam\n• Islamic Center: 08.00–17.00 WITA\n• Kebun Raya Unmul: 07.00–17.00 WITA\n• Museum Mulawarman: 08.00–16.00 WITA (Senin libur)\n• Kampung Kuliner: 10.00–22.00 WITA.'],
        ['kuliner|makan|nasi|soto|amplang|sarung', 'Kuliner & Oleh-oleh Khas Samarinda:\n• Kuliner: Nasi Kuning khas Samarinda, Soto Banjar, Pisang Gapit, Ikan Patin Bakar.\n• Oleh-oleh: Amplang Kuku Macan, Sarung Tenun Samarinda Asli, Batik Kaltim.\n• Sentra belanja dapat dikunjungi di Kampung Kuliner dan kawasan Pasar Pagi.'],
        ['hotel|inap|menginap|penginapan', 'Perkiraan Akomodasi di Samarinda:\n• Homestay / Guesthouse: ± Rp 150.000 / malam\n• Hotel Bintang 2–3: ± Rp 300.000 – Rp 600.000 / malam\n• Hotel Bintang 4–5: ± Rp 950.000 – Rp 1.600.000 / malam.'],
        ['transport|kendaraan|angkot|grab|gojek|rental|sewa', 'Pilihan Transportasi di Samarinda:\n• Angkot / Bus Kota: ± Rp 15.000 / hari\n• Transportasi Online (Grab / Gojek): Mudah dipesan di mana saja\n• Sewa Sepeda Motor: ± Rp 75.000 / hari\n• Rental Mobil: ± Rp 250.000 / hari lepas kunci.'],
        ['event|agenda|festival|acara', 'Jadwal Agenda & Event:\nSamarinda rutin menyelenggarakan Festival Mahakam, Pagelaran Seni Budaya Dayak, dan Pameran Ekraf. Silakan lihat kalender lengkap di menu Layanan > Kalender Event.'],
        ['kontak|hubungi|telepon|telpon|alamat|lokasi', 'Kontak Resmi Bidang Pariwisata Disporapar Kota Samarinda:\n• Alamat: Jl. Dahlia No. 02, Bugis, Samarinda Kota\n• Telepon: (0541) 123-456\n• Jam Kerja: Senin–Jumat 08.00–16.00 WITA\n• Anda juga dapat meninggalkan pesan melalui formulir di halaman Kontak.'],
        ['terima kasih|makasih|thanks|tq', 'Sama-sama! Selamat berlibur dan menikmati keindahan Kota Samarinda.']
    ];
    var fallback = 'Pertanyaan Anda belum tercatat di data otomatis kami.\nSilakan coba kata kunci seperti: destinasi, harga tiket, jam buka, kuliner, hotel, atau kontak.';

    function reply(t) {
        t = t.toLowerCase();
        if (/destinasi|wisata apa|tempat/.test(t)) {
            return 'Destinasi unggulan Kota Samarinda meliputi:\n1. Tepian Mahakam\n2. Islamic Center Samarinda\n3. Kebun Raya Unmul\n4. Museum Mulawarman\n5. Wisata Sungai Mahakam\n6. Kampung Kuliner\nSelengkapnya dapat dijelajahi di menu Destinasi.';
        }
        for (var i = 0; i < kb.length; i++) {
            var keys = kb[i][0].split('|');
            for (var k = 0; k < keys.length; k++) {
                if (t.indexOf(keys[k]) !== -1) return kb[i][1];
            }
        }
        return fallback;
    }
    function add(text, who) {
        var d = document.createElement('div');
        d.className = 'msg ' + who;
        d.textContent = text;
        msgs.appendChild(d);
        msgs.scrollTop = msgs.scrollHeight;
    }
    function ask(text) {
        add(text, 'user');
        var ty = document.createElement('div');
        ty.className = 'msg bot typing';
        ty.innerHTML = '<span>●</span> <span>●</span> <span>●</span>';
        msgs.appendChild(ty);
        msgs.scrollTop = msgs.scrollHeight;
        setTimeout(function () {
            ty.remove();
            add(reply(text), 'bot');
        }, 550);
    }
    window.toggleChat = function () {
        var open = win.classList.toggle('open');
        icon.innerHTML = open ? '<i class="bi bi-x-lg"></i>' : '<i class="bi bi-chat-dots-fill"></i>';
        if (open) input.focus();
    };
    window.sendChat = function () {
        var v = input.value.trim();
        if (!v) return;
        input.value = '';
        ask(v);
    };
    window.quickChat = function (t) { ask(t); };
    input.addEventListener('keydown', function (e) { if (e.key === 'Enter') window.sendChat(); });
    add('Halo! Selamat datang di Pusat Informasi Pariwisata Samarinda. Ada yang bisa kami bantu seputar destinasi, event, atau rute perjalanan Anda?', 'bot');
})();
