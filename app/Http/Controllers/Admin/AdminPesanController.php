<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesan;

class AdminPesanController extends Controller
{
    public function index()
    {
        $pesan = Pesan::latest()->paginate(12);

        return view('admin.pesan.index', compact('pesan'));
    }

    public function toggle(Pesan $pesan)
    {
        $pesan->update(['dibaca' => !$pesan->dibaca]);

        return back();
    }

    public function destroy(Pesan $pesan)
    {
        $pesan->delete();

        return back()->with('success', 'Pesan berhasil dihapus.');
    }
}
