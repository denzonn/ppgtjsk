<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryKegiatan extends Model
{
    use HasFactory;

    protected $table = 'gallery_kegiatans';

    protected $fillable = [
        'kegiatan_id',
        'photo',
    ];

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'kegiatan_id', 'id');
    }
}
