<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    use HasFactory;

    protected $table = 'galeri';

    protected $fillable = [
        'album_id',
        'judul',
        'file',
        'tipe',
    ];

    public function album()
    {
        return $this->belongsTo(
            AlbumGaleri::class,
            'album_id'
        );
    }
}