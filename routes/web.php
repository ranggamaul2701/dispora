<?php

use App\Http\Controllers\Admin\AdminAgendaController;
use App\Http\Controllers\Admin\AdminBeritaController;
use App\Http\Controllers\Admin\AdminDestinasiController;
use App\Http\Controllers\Admin\AdminGalleryController;
use App\Http\Controllers\Admin\AdminPesanController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DestinasiController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

// ── PUBLIK ─────────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/cari', [HomeController::class, 'search'])->name('search');
Route::get('/tentang', [AboutController::class, 'index'])->name('about');

Route::get('/destinasi', [DestinasiController::class, 'index'])->name('destinasi.index');
Route::get('/destinasi/{slug}', [DestinasiController::class, 'show'])->name('destinasi.show');

Route::get('/berita', [NewsController::class, 'index'])->name('berita.index');
Route::get('/berita/{slug}', [NewsController::class, 'show'])->name('berita.show');

Route::get('/galeri', [GalleryController::class, 'index'])->name('galeri.index');
Route::get('/galeri/{album}', [GalleryController::class, 'album'])->name('galeri.album');

Route::get('/agenda', [AgendaController::class, 'index'])->name('agenda.index');
Route::get('/agenda/{agenda}', [AgendaController::class, 'show'])->name('agenda.show');

Route::get('/peta-wisata', [LayananController::class, 'peta'])->name('peta.index');
Route::get('/statistik', [LayananController::class, 'statistik'])->name('statistik.index');
Route::get('/kalkulator-wisata', [LayananController::class, 'kalkulator'])->name('kalkulator.index');
Route::get('/kalender', [LayananController::class, 'kalender'])->name('kalender.index');
Route::get('/itinerary', [LayananController::class, 'itinerary'])->name('itinerary.index');

Route::get('/kontak', [ContactController::class, 'index'])->name('kontak.index');
Route::post('/kontak', [ContactController::class, 'send'])->name('kontak.send');

// ── AUTH ───────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
    // Register tamu dinonaktifkan: setiap pengunjung otomatis menjadi tamu publik
    Route::get('/register', fn () => redirect()->route('home'))->name('register');
    Route::post('/register', fn () => redirect()->route('home'))->name('register.attempt');
});
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// ── ADMIN ──────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', fn () => redirect()->route('admin.dashboard'));
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/destinasi', [AdminDestinasiController::class, 'index'])->name('destinasi.index');
    Route::get('/destinasi/tambah', [AdminDestinasiController::class, 'create'])->name('destinasi.create');
    Route::post('/destinasi', [AdminDestinasiController::class, 'store'])->name('destinasi.store');
    Route::get('/destinasi/{destinasi}/edit', [AdminDestinasiController::class, 'edit'])->name('destinasi.edit');
    Route::put('/destinasi/{destinasi}', [AdminDestinasiController::class, 'update'])->name('destinasi.update');
    Route::delete('/destinasi/{destinasi}', [AdminDestinasiController::class, 'destroy'])->name('destinasi.destroy');

    Route::get('/berita', [AdminBeritaController::class, 'index'])->name('berita.index');
    Route::get('/berita/tambah', [AdminBeritaController::class, 'create'])->name('berita.create');
    Route::post('/berita', [AdminBeritaController::class, 'store'])->name('berita.store');
    Route::get('/berita/{berita}/edit', [AdminBeritaController::class, 'edit'])->name('berita.edit');
    Route::put('/berita/{berita}', [AdminBeritaController::class, 'update'])->name('berita.update');
    Route::delete('/berita/{berita}', [AdminBeritaController::class, 'destroy'])->name('berita.destroy');

    Route::get('/agenda', [AdminAgendaController::class, 'index'])->name('agenda.index');
    Route::get('/agenda/tambah', [AdminAgendaController::class, 'create'])->name('agenda.create');
    Route::post('/agenda', [AdminAgendaController::class, 'store'])->name('agenda.store');
    Route::get('/agenda/{agenda}/edit', [AdminAgendaController::class, 'edit'])->name('agenda.edit');
    Route::put('/agenda/{agenda}', [AdminAgendaController::class, 'update'])->name('agenda.update');
    Route::delete('/agenda/{agenda}', [AdminAgendaController::class, 'destroy'])->name('agenda.destroy');

    Route::get('/pengguna', [AdminUserController::class, 'index'])->name('users.index');
    Route::get('/pengguna/tambah', [AdminUserController::class, 'create'])->name('users.create');
    Route::post('/pengguna', [AdminUserController::class, 'store'])->name('users.store');
    Route::get('/pengguna/{user}/edit', [AdminUserController::class, 'edit'])->name('users.edit');
    Route::put('/pengguna/{user}', [AdminUserController::class, 'update'])->name('users.update');
    Route::delete('/pengguna/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');

    Route::get('/galeri', [AdminGalleryController::class, 'index'])->name('galeri.index');
    Route::post('/galeri', [AdminGalleryController::class, 'upload'])->name('galeri.upload');
    Route::delete('/galeri/{album}/{file}', [AdminGalleryController::class, 'destroy'])->name('galeri.destroy');

    Route::get('/pesan', [AdminPesanController::class, 'index'])->name('pesan.index');
    Route::patch('/pesan/{pesan}', [AdminPesanController::class, 'toggle'])->name('pesan.toggle');
    Route::delete('/pesan/{pesan}', [AdminPesanController::class, 'destroy'])->name('pesan.destroy');
});
