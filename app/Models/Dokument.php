<?php

namespace App\Models;

use App\Casts\PublicUrl;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokument extends Model
{
    use HasFactory;

    protected $table = 'dokuments';

    protected $fillable = [
        'judul',
        'file',
    ];

    /** URL lengkap berbasis APP_URL saat dibaca; database tetap menyimpan path relatif. */
    protected $casts = [
        'file' => PublicUrl::class,
    ];
}
