<?php

namespace App\Support;

class Gallery
{
    public static function albums(): array
    {
        return config('pariwisata.albums');
    }

    /** Daftar nama file foto (tanpa cover.*) di sebuah album, urut natural. */
    public static function files(string $slug): array
    {
        if (!isset(self::albums()[$slug])) {
            return [];
        }
        $dir = public_path("images/galeri/{$slug}");
        if (!is_dir($dir)) {
            return [];
        }
        $out = [];
        foreach (scandir($dir) as $f) {
            $ext = strtolower(pathinfo($f, PATHINFO_EXTENSION));
            if (!in_array($ext, ['jpg', 'jpeg', 'png', 'webp'], true)) {
                continue;
            }
            if (strtolower(pathinfo($f, PATHINFO_FILENAME)) === 'cover') {
                continue;
            }
            $out[] = $f;
        }
        natcasesort($out);

        return array_values($out);
    }

    public static function url(string $slug, string $file): string
    {
        return asset("images/galeri/{$slug}/{$file}");
    }

    /** Foto lengkap satu album: [['file','url','judul'], ...] */
    public static function photos(string $slug): array
    {
        $nama = self::albums()[$slug]['nama'] ?? $slug;
        $i = 0;
        $out = [];
        foreach (self::files($slug) as $f) {
            $i++;
            $out[] = ['file' => $f, 'url' => self::url($slug, $f), 'judul' => "{$nama} — Foto {$i}"];
        }

        return $out;
    }

    /** Cover album: cover.* kalau ada, kalau tidak foto pertama, kalau tidak ada null. */
    public static function cover(string $slug): ?string
    {
        $dir = public_path("images/galeri/{$slug}");
        foreach (['jpg', 'jpeg', 'png', 'webp'] as $ext) {
            if (is_file("{$dir}/cover.{$ext}")) {
                return self::url($slug, "cover.{$ext}");
            }
        }
        $files = self::files($slug);

        return $files ? self::url($slug, $files[0]) : null;
    }

    /** Foto pilihan lintas album untuk beranda (bergantian per album, tanpa duplikat). */
    public static function featured(int $limit = 8): array
    {
        $pool = [];
        foreach (array_keys(self::albums()) as $slug) {
            $pool[$slug] = self::files($slug);
        }
        $out = [];
        $round = 0;
        while (count($out) < $limit) {
            $added = false;
            foreach ($pool as $slug => $files) {
                if (isset($files[$round]) && count($out) < $limit) {
                    $out[] = [
                        'url'   => self::url($slug, $files[$round]),
                        'label' => self::albums()[$slug]['nama'],
                        'album' => $slug,
                    ];
                    $added = true;
                }
            }
            if (!$added) {
                break;
            }
            $round++;
        }

        return $out;
    }
}
