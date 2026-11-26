<?php

namespace App\Models;

use App\Models\Concerns\BerPeriode;

use App\Casts\PublicUrl;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggotaBidang extends Model
{
    use \App\Models\Concerns\TercatatDiLog, BerPeriode, HasFactory;

    protected $table = 'anggota_bidangs';

    protected $fillable = [
        'periode_id',
        'nama_anggota',
        'foto',
        'jabatans_id',
        'bidangs_id',
    ];

    /** URL lengkap berbasis APP_URL saat dibaca; database tetap menyimpan path relatif. */
    protected $casts = [
        'foto' => PublicUrl::class,
    ];

    public function jabatan()
    {
        return $this->belongsTo(JabatanBidang::class, 'jabatans_id', 'id');
    }

    public function bidang()
    {
        return $this->belongsTo(Bidang::class, 'bidangs_id', 'id');
    }
}
