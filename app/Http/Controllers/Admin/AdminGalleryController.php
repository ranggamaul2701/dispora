<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Support\Gallery;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminGalleryController extends Controller
{
    public function index()
    {
        $albums = [];
        foreach (Gallery::albums() as $slug => $meta) {
            $albums[] = $meta + ['slug' => $slug, 'cover' => Gallery::cover($slug), 'foto' => Gallery::photos($slug)];
        }

        return view('admin.galeri.index', compact('albums'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'album'  => ['required', Rule::in(array_keys(Gallery::albums()))],
            'foto'   => 'required|array|max:20',
            'foto.*' => 'image|mimes:jpg,jpeg,png,webp|max:5120',
        ], [
            'foto.required' => 'Pilih minimal satu foto.',
            'foto.*.image'  => 'File harus berupa gambar.',
            'foto.*.mimes'  => 'Format foto harus JPG, PNG, atau WebP.',
            'foto.*.max'    => 'Ukuran tiap foto maksimal 5 MB.',
        ]);

        $album = $request->input('album');
        $dir = public_path("images/galeri/{$album}");
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $max = 0;
        foreach (Gallery::files($album) as $f) {
            if (preg_match('/^foto-(\d+)\./i', $f, $m)) {
                $max = max($max, (int) $m[1]);
            }
        }
        $count = 0;
        foreach ($request->file('foto') as $file) {
            $max++;
            $file->move($dir, 'foto-' . $max . '.' . strtolower($file->getClientOriginalExtension() ?: 'jpg'));
            $count++;
        }

        return redirect()->route('admin.galeri.index')->with('success', "{$count} foto berhasil diunggah ke album \"" . Gallery::albums()[$album]['nama'] . '".');
    }

    public function destroy(string $album, string $file)
    {
        abort_unless(isset(Gallery::albums()[$album]) && in_array($file, Gallery::files($album), true), 404);
        @unlink(public_path("images/galeri/{$album}/{$file}"));

        return redirect()->route('admin.galeri.index')->with('success', 'Foto "' . $file . '" berhasil dihapus.');
    }
}
