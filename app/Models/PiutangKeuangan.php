<?php

namespace App\Models;

use App\Casts\PublicUrl;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PiutangKeuangan extends Model
{
    use \App\Models\Concerns\TercatatDiLog;
    use HasFactory;

    protected $table = 'piutang_keuangans';

    protected $fillable = [
        'keterangan',
        'jumlah',
        'status',
        'catatan',
        'photo',
    ];

    /** URL lengkap berbasis APP_URL saat dibaca; database tetap menyimpan path relatif. */
    protected $casts = [
        'photo' => PublicUrl::class,
    ];
}
