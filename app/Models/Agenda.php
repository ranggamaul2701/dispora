<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $table = 'agenda';

    protected $fillable = [
        'nama', 'lokasi', 'tanggal_mulai', 'tanggal_selesai', 'jam_mulai', 'kategori', 'icon',
        'deskripsi', 'penyelenggara', 'kontak', 'gambar', 'is_published',
    ];

    protected $casts = [
        'tanggal_mulai'   => 'date',
        'tanggal_selesai' => 'date',
        'is_published'    => 'boolean',
    ];

    public function scopePublished($q)
    {
        return $q->where('is_published', true);
    }

    public function tanggalAkhir()
    {
        return $this->tanggal_selesai ?? $this->tanggal_mulai;
    }

    public function isMultiDay(): bool
    {
        return $this->tanggal_selesai && !$this->tanggal_selesai->isSameDay($this->tanggal_mulai);
    }

    public function isPast(): bool
    {
        return $this->tanggalAkhir()->endOfDay()->isPast();
    }

    /** Jam mulai dalam format HH:MM (untuk countdown), default 08:00. */
    public function jamHHMM(): string
    {
        if ($this->jam_mulai && preg_match('/(\d{1,2})[.:](\d{2})/', $this->jam_mulai, $m)) {
            return str_pad($m[1], 2, '0', STR_PAD_LEFT) . ':' . $m[2];
        }

        return '08:00';
    }
}
