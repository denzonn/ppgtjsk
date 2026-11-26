<?php

namespace App\Models;

use App\Models\Concerns\BerPeriode;

use App\Casts\PublicUrl;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotulensiRapat extends Model
{
    use \App\Models\Concerns\TercatatDiLog, BerPeriode, HasFactory;

    protected $table = 'notulensi_rapats';

    protected $fillable = [
        'periode_id',
        'tanggal',
        'judul',
        'isi',
        'file',
    ];

    /** URL lengkap berbasis APP_URL saat dibaca; database tetap menyimpan path relatif. */
    protected $casts = [
        'file' => PublicUrl::class,
    ];
}
