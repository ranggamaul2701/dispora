<?php

namespace App\Models;

use App\Models\Concerns\HasSlug;
use Illuminate\Database\Eloquent\Model;

class Destinasi extends Model
{
    use HasSlug;

    protected $table = 'destinasi';

    protected $fillable = [
        'nama', 'slug', 'kategori', 'gambar', 'foto_tambahan', 'icon', 'rating', 'ulasan', 'harga', 'jam', 'durasi',
        'alamat', 'maps', 'deskripsi', 'fasilitas', 'tips', 'galeri_slug', 'is_published',
    ];

    protected $casts = [
        'fasilitas'     => 'array',
        'foto_tambahan' => 'array',
        'is_published'  => 'boolean',
        'rating'        => 'float',
    ];

    public function getGaleriFotoAttribute(): array
    {
        $fotos = $this->foto_tambahan ?? [];
        return array_map(function ($p) {
            return [
                'url'   => media_url($p, 'destinasi'),
                'path'  => $p,
                'judul' => $this->nama,
            ];
        }, (array) $fotos);
    }

    public function slugSource(): string
    {
        return 'nama';
    }

    public function scopePublished($q)
    {
        return $q->where('is_published', true);
    }

    public function mapsUrl(): string
    {
        return $this->maps ?: 'https://www.google.com/maps?q=' . urlencode($this->nama . ' Samarinda') . '&output=embed';
    }
}
