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

    protected $appends = ['periode'];

    public function periodeKepengurusan()
    {
        return $this->belongsTo(\App\Models\Periode::class, 'periode_id');
    }

    /** Teks periode format lama ("Periode 2013 - 2015") untuk view publik dan API. */
    public function getPeriodeAttribute()
    {
        $p = $this->periodeKepengurusan;

        return $p ? "Periode {$p->tahun_mulai} - {$p->tahun_selesai}" : null;
    }
}
