<?php

namespace App\Models;

use App\Models\Concerns\BerPeriode;

use App\Casts\PublicUrl;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoKsb extends Model
{
    use BerPeriode, HasFactory;

    protected $table = 'foto_ksbs';

    protected $fillable = [
        'periode_id',
        'foto',
        'nama',
        'jabatan',
        'motto',
        'instagram',
        'facebook',
        'whatsapp',
    ];

    /** URL lengkap berbasis APP_URL saat dibaca; database tetap menyimpan path relatif. */
    protected $casts = [
        'foto' => PublicUrl::class,
    ];
}
