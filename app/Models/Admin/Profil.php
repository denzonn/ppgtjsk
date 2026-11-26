<?php

namespace App\Models\Admin;

use App\Casts\PublicUrl;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Profil extends Model implements HasMedia
{
    use \App\Models\Concerns\TercatatDiLog;
    use HasFactory, InteractsWithMedia;

    protected $table = 'profils';

    protected $fillable = [
        'periode_id',
        'content',
        'photo'
    ];

    /** URL lengkap berbasis APP_URL saat dibaca; database tetap menyimpan path relatif. */
    protected $casts = [
        'photo' => PublicUrl::class,
    ];

    public function periodeKepengurusan()
    {
        return $this->belongsTo(\App\Models\Periode::class, 'periode_id');
    }

    /** Label teks periode, dipakai view publik. */
    public function getPeriodeAttribute()
    {
        return $this->periodeKepengurusan?->label();
    }
}
