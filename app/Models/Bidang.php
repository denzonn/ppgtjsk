<?php

namespace App\Models;

use App\Models\Concerns\BerPeriode;

use App\Casts\PublicUrl;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bidang extends Model
{
    use \App\Models\Concerns\TercatatDiLog, BerPeriode, HasFactory;

    protected $table = 'bidangs';

    protected $fillable = [
        'periode_id',
        'nama_bidang',
        'foto_bidang',
    ];

    /** URL lengkap berbasis APP_URL saat dibaca; database tetap menyimpan path relatif. */
    protected $casts = [
        'foto_bidang' => PublicUrl::class,
    ];
}
