<?php

namespace App\Providers;

use App\Models\Agenda;
use App\Models\Berita;
use App\Models\Destinasi;
use App\Models\Pesan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        require_once app_path('helpers.php');
    }

    public function boot(): void
    {
        Paginator::useBootstrapFive();
        Carbon::setLocale('id');

        // Jumlah data untuk badge sidebar admin (dipasang di sini, bukan di dalam blade)
        View::composer('admin.layout', function ($view) {
            try {
                $view->with('cnt', [
                    'destinasi' => Destinasi::count(),
                    'berita'    => Berita::count(),
                    'agenda'    => Agenda::count(),
                    'users'     => User::count(),
                    'pesan'     => Pesan::where('dibaca', false)->count(),
                ]);
            } catch (\Throwable $e) {
                $view->with('cnt', ['destinasi' => 0, 'berita' => 0, 'agenda' => 0, 'users' => 0, 'pesan' => 0]);
            }
        });
    }
}
