<?php

namespace App\Models;

use App\Casts\PublicUrl;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
    use HasFactory;

    protected $table = 'inventaris';

    protected $fillable = [
        'nama',
        'jenis_id',
        'kode',
        'jumlah',
        'keterangan',
        'photo'
    ];

    /** URL lengkap berbasis APP_URL saat dibaca; database tetap menyimpan path relatif. */
    protected $casts = [
        'photo' => PublicUrl::class,
    ];

    public function jenis()
    {
        return $this->belongsTo(JenisInventaris::class, 'jenis_id', 'id');
    }
}
