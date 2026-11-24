(function () {
    var win = document.getElementById('chatWindow');
    if (!win) return;
    var msgs = document.getElementById('chatMsgs'), input = document.getElementById('chatInput'), icon = document.getElementById('chatIcon');

    var kb = [
        ['halo|hai|hello|selamat', 'Halo! Saya Sari, asisten wisata Samarinda 👋\nTanyakan tentang destinasi, harga tiket, jam buka, kuliner, hotel, atau transportasi.'],
        ['tepian|mahakam', '🌊 Tepian Mahakam\n• Gratis, buka 24 jam\n• Terbaik dikunjungi 17.00–19.00 untuk senja\n• Ada parkir, warung, dan spot foto'],
        ['islamic|masjid', '🕌 Islamic Center Samarinda\n• Gratis, 08.00–17.00 WITA\n• Masjid termegah di Kalimantan Timur\n• Gunakan pakaian sopan'],
        ['kebun|raya|unmul', '🌿 Kebun Raya Unmul\n• Rp 10.000/orang, 07.00–17.00 WITA\n• Hutan wisata 300 hektar, danau, outbond'],
        ['museum|mulawarman', '🎭 Museum Mulawarman\n• Rp 5.000/orang, 08.00–16.00 WITA\n• Tutup hari Senin'],
        ['tiket|harga|biaya', '🎫 Harga tiket:\n• Tepian Mahakam & Islamic Center: gratis\n• Kebun Raya Unmul: Rp 10.000\n• Museum Mulawarman: Rp 5.000\n• Wisata Sungai: Rp 50.000–200.000/perahu\nLihat Kalkulator Biaya Wisata di menu Layanan untuk estimasi lengkap.'],
        ['jam|buka|tutup', '🕐 Jam buka:\n• Tepian Mahakam: 24 jam\n• Islamic Center: 08.00–17.00\n• Kebun Raya: 07.00–17.00\n• Museum: 08.00–16.00 (Senin tutup)\n• Kampung Kuliner: 10.00–22.00'],
        ['kuliner|makan|nasi|soto|amplang', '🍜 Kuliner khas: Nasi Kuning, Soto Banjar, Amplang, Pisang Gapit, dan seafood Mahakam. Pusatnya di Kampung Kuliner, Pasar Pagi.'],
        ['hotel|inap|menginap|penginapan', '🏨 Perkiraan akomodasi per malam:\n• Homestay ± Rp 150.000\n• Hotel bintang 2 ± Rp 350.000\n• Hotel bintang 3 ± Rp 600.000'],
        ['transport|kendaraan|angkot|grab|gojek|rental', '🚗 Transportasi: angkot kota, Grab/Gojek, rental motor ± Rp 75.000/hari, rental mobil ± Rp 250.000/hari.'],
        ['event|agenda|festival|acara', '📅 Lihat jadwal event terbaru di menu Agenda atau Kalender Event.'],
        ['kontak|hubungi|telepon|telpon|alamat', '📞 Bidang Pariwisata Disporapar\n• Telepon: (0541) 123-456\n• Jam kerja: Senin–Jumat 08.00–16.00 WITA\nAtau kirim pesan lewat halaman Kontak.'],
        ['terima kasih|makasih|thanks', 'Sama-sama! Selamat berwisata di Samarinda 🌴']
    ];
    var fallback = 'Maaf, Sari belum bisa menjawab itu 🤔\nCoba tanya: destinasi, harga tiket, jam buka, kuliner, hotel, atau transportasi.';

    function reply(t) {
        t = t.toLowerCase();
        if (/destinasi|wisata apa|tempat/.test(t)) return '🗺️ Destinasi unggulan: Tepian Mahakam, Islamic Center, Kebun Raya Unmul, Museum Mulawarman, Kampung Kuliner, dan Wisata Sungai Mahakam. Semua ada di menu Destinasi.';
        for (var i = 0; i < kb.length; i++) {
            var keys = kb[i][0].split('|');
            for (var k = 0; k < keys.length; k++) if (t.indexOf(keys[k]) !== -1) return kb[i][1];
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
        setTimeout(function () { ty.remove(); add(reply(text), 'bot'); }, 650);
    }
    window.toggleChat = function () {
        var open = win.classList.toggle('open');
        icon.textContent = open ? '✕' : '💬';
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
    add('Halo! Saya Sari 👋 asisten wisata Samarinda. Ada yang bisa saya bantu?', 'bot');
})();
