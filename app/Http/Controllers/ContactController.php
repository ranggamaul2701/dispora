<?php

namespace App\Http\Controllers;

use App\Models\Pesan;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('kontak.index');
    }

    public function send(Request $request)
    {
        $data = $request->validate([
            'nama'   => 'required|string|max:100',
            'email'  => 'required|email|max:150',
            'subjek' => 'required|string|max:200',
            'isi'    => 'required|string|max:2000',
        ], [
            'nama.required'   => 'Nama wajib diisi.',
            'email.required'  => 'Email wajib diisi.',
            'email.email'     => 'Format email tidak valid.',
            'subjek.required' => 'Subjek wajib diisi.',
            'isi.required'    => 'Pesan wajib diisi.',
        ]);

        Pesan::create($data);

        return redirect()->route('kontak.index')->with('success', 'Pesan Anda berhasil dikirim. Kami akan merespons dalam 1–2 hari kerja.');
    }
}
