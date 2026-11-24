<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlbumGaleri extends Model
{
    use HasFactory;

    protected $table = 'album_galeri';

    protected $fillable = [
        'nama',
        'slug',
        'cover',
    ];

    public function foto()
    {
        return $this->hasMany(
            Galeri::class,
            'album_id'
        );
    }
}