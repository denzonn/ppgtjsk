<?php

namespace App\Models;

use App\Casts\PublicUrl;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoKsb extends Model
{
    use HasFactory;

    protected $table = 'foto_ksbs';

    protected $fillable = [
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
