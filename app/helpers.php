<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

if (!function_exists('store_image')) {
    /**
     * Simpan file gambar ke storage publik dan kembalikan path-nya.
     *
     * @param  \Illuminate\Http\UploadedFile  $file
     * @param  string  $folder  Sub-folder di dalam disk 'public' (mis. 'destinasi', 'berita')
     * @return string           Path relatif yang tersimpan (mis. 'destinasi/abc123.jpg')
     */
    function store_image(UploadedFile $file, string $folder = 'uploads'): string
    {
        $extension = $file->getClientOriginalExtension();
        $filename  = Str::uuid() . '.' . $extension;

        $file->storeAs($folder, $filename, 'public');

        return $folder . '/' . $filename;
    }
}

if (!function_exists('delete_image')) {
    /**
     * Hapus file gambar dari storage publik.
     *
     * @param  string|null  $path   Path relatif yang tersimpan (mis. 'destinasi/abc123.jpg')
     * @param  string       $folder Tidak dipakai — disimpan agar signature konsisten dengan pemanggil
     * @return void
     */
    function delete_image(?string $path, string $folder = ''): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}

if (!function_exists('media_url')) {
    function media_url(?string $path, string $folder = 'uploads'): string
    {
        if (!$path) {
            return asset('images/no-image.png');
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        // Foto dari storage publik (mis. destinasi/xxx.jpg)
        if (Storage::disk('public')->exists($path)) {
            return asset('storage/' . ltrim($path, '/'));
        }

        // Foto lama di public/images/{folder}/{filename}
        $filename = basename($path);
        $oldPath = public_path('images/' . trim($folder, '/') . '/' . $filename);
        if (file_exists($oldPath)) {
            return asset('images/' . trim($folder, '/') . '/' . $filename);
        }

        // Foto di public/images/{path}
        if (file_exists(public_path('images/' . ltrim($path, '/')))) {
            return asset('images/' . ltrim($path, '/'));
        }

        // Foto di public/{path}
        if (file_exists(public_path(ltrim($path, '/')))) {
            return asset(ltrim($path, '/'));
        }

        return asset('images/no-image.png');
    }
}
