<?php

namespace App\Models;

use App\Casts\PublicUrl;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengeluaranKeuangan extends Model
{
    use \App\Models\Concerns\TercatatDiLog;
    use HasFactory;

    protected $table = 'pengeluaran_keuangans';

    protected $fillable = [
        'tanggal',
        'keterangan',
        'jumlah',
        'catatan',
        'photo',
    ];

    /** URL lengkap berbasis APP_URL saat dibaca; database tetap menyimpan path relatif. */
    protected $casts = [
        'photo' => PublicUrl::class,
    ];
}
