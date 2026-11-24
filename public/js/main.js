document.addEventListener('DOMContentLoaded', function () {
    if (typeof AOS !== 'undefined') AOS.init({ duration: 700, once: true, offset: 60 });

    // ── Scroll top
    var st = document.getElementById('scrollTop');
    if (st) {
        window.addEventListener('scroll', function () { st.classList.toggle('show', window.scrollY > 400); });
        st.addEventListener('click', function () { window.scrollTo({ top: 0, behavior: 'smooth' }); });
    }

    // ── Counter angka hero
    var stats = document.querySelectorAll('.hero-stat-item .number');
    if (stats.length && 'IntersectionObserver' in window) {
        var obs = new IntersectionObserver(function (entries) {
            entries.forEach(function (e) {
                if (!e.isIntersecting) return;
                var raw = e.target.textContent, num = parseInt(raw.replace(/\D/g, ''), 10) || 0, suf = raw.replace(/[0-9]/g, '');
                var cur = 0, step = Math.max(1, num / 60);
                var t = setInterval(function () {
                    cur += step;
                    if (cur >= num) { e.target.textContent = num + suf; clearInterval(t); }
                    else e.target.textContent = Math.floor(cur) + suf;
                }, 18);
                obs.unobserve(e.target);
            });
        }, { threshold: .5 });
        stats.forEach(function (el) { obs.observe(el); });
    }

    // ── Flash otomatis hilang
    document.querySelectorAll('.flash').forEach(function (el) {
        setTimeout(function () { el.style.transition = 'opacity .5s'; el.style.opacity = '0'; setTimeout(function () { el.remove(); }, 500); }, 4500);
    });

    // ── Splash screen (sekali per sesi)
    var splash = document.getElementById('splash');
    if (splash) {
        var done = false;
        try { done = sessionStorage.getItem('splashDone'); } catch (e) {}
        if (done) { splash.style.display = 'none'; return; }
        var bar = document.getElementById('splash-bar'), logo = document.getElementById('splash-logo'), txt = document.getElementById('splash-text');
        var msgs = ['MEMUAT...', 'MENYIAPKAN DATA...', 'HAMPIR SELESAI...', 'SELAMAT DATANG!'];
        setTimeout(function () { logo.classList.add('show'); }, 80);
        var p = 0;
        var iv = setInterval(function () {
            p = Math.min(100, p + 6 + Math.random() * 14);
            bar.style.width = p + '%';
            txt.textContent = msgs[Math.min(3, Math.floor(p / 34))];
            if (p >= 100) {
                clearInterval(iv);
                setTimeout(function () {
                    splash.style.opacity = '0';
                    setTimeout(function () { splash.style.display = 'none'; try { sessionStorage.setItem('splashDone', '1'); } catch (e) {} }, 600);
                }, 350);
            }
        }, 110);
    }
});
