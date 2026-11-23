<?php

namespace App\Models;

use App\Casts\PublicUrl;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bidang extends Model
{
    use HasFactory;

    protected $tabel = 'bidangs';

    protected $fillable = [
        'nama_bidang',
        'foto_bidang',
    ];

    /** URL lengkap berbasis APP_URL saat dibaca; database tetap menyimpan path relatif. */
    protected $casts = [
        'foto_bidang' => PublicUrl::class,
    ];
}
