<?php

namespace App\Models;

use App\Casts\PublicUrl;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotulensiRapat extends Model
{
    use HasFactory;

    protected $table = 'notulensi_rapats';

    protected $fillable = [
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
