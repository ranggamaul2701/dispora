<?php

namespace App\Models;

use App\Models\Concerns\HasSlug;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasSlug;

    protected $table = 'berita';

    protected $fillable = [
        'judul', 'slug', 'kategori', 'gambar', 'icon', 'ringkasan', 'konten', 'views', 'is_published',
    ];

    protected $casts = ['is_published' => 'boolean', 'views' => 'integer'];

    public function slugSource(): string
    {
        return 'judul';
    }

    public function scopePublished($q)
    {
        return $q->where('is_published', true);
    }
}
