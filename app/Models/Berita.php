<?php

namespace App\Models;

use App\Models\Concerns\HasSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Berita extends Model
{
    use HasSlug;

    protected $table = 'berita';

    protected $fillable = [
        'kategori_id', 'judul', 'slug', 'kategori', 'gambar', 'icon', 'ringkasan', 'konten', 'views', 'is_published',
    ];

    protected $casts = ['is_published' => 'boolean', 'views' => 'integer'];

    protected static function booted()
    {
        static::saving(function ($model) {
            if (empty($model->kategori_id) && !empty($model->kategori)) {
                $kat = KategoriBerita::firstOrCreate(
                    ['nama' => $model->kategori],
                    ['slug' => Str::slug($model->kategori)]
                );
                $model->kategori_id = $kat->id;
            }
        });
    }

    public function kategoriRelasi()
    {
        return $this->belongsTo(KategoriBerita::class, 'kategori_id');
    }

    public function slugSource(): string
    {
        return 'judul';
    }

    public function scopePublished($q)
    {
        return $q->where('is_published', true);
    }
}
