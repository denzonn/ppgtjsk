<?php

namespace App\Models;

use App\Models\Concerns\BerPeriode;

use App\Casts\PublicUrl;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryKegiatan extends Model
{
    use BerPeriode, HasFactory;

    protected $table = 'gallery_kegiatans';

    protected $fillable = [
        'periode_id',
        'kegiatan_id',
        'photo',
    ];

    /** URL lengkap berbasis APP_URL saat dibaca; database tetap menyimpan path relatif. */
    protected $casts = [
        'photo' => PublicUrl::class,
    ];

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'kegiatan_id', 'id');
    }
}
