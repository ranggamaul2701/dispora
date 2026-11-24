<?php

namespace App\Http\Controllers;

use App\Support\Gallery;

class GalleryController extends Controller
{
    public function index()
    {
        $albums = [];
        foreach (Gallery::albums() as $slug => $meta) {
            $albums[] = $meta + [
                'slug'   => $slug,
                'cover'  => Gallery::cover($slug),
                'jumlah' => count(Gallery::files($slug)),
            ];
        }
        $total = array_sum(array_column($albums, 'jumlah'));

        return view('galeri.index', compact('albums', 'total'));
    }

    public function album(string $album)
    {
        abort_unless(isset(Gallery::albums()[$album]), 404);

        $meta = Gallery::albums()[$album] + ['slug' => $album, 'cover' => Gallery::cover($album)];
        $foto = Gallery::photos($album);
        $lain = collect(Gallery::albums())->except($album)->map(fn ($m, $s) => $m + ['slug' => $s, 'cover' => Gallery::cover($s)]);

        return view('galeri.album', compact('meta', 'foto', 'lain'));
    }
}
