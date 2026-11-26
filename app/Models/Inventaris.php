<?php

namespace App\Models;

use App\Casts\PublicUrl;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
    use \App\Models\Concerns\TercatatDiLog;
    use HasFactory;

    protected $table = 'inventaris';

    protected $fillable = [
        'nama',
        'jenis_id',
        'kode',
        'jumlah',
        'keterangan',
        'photo',
        'periode_id',
    ];

    /** URL lengkap berbasis APP_URL saat dibaca; database tetap menyimpan path relatif. */
    protected $casts = [
        'photo' => PublicUrl::class,
    ];

    protected static function booted()
    {
        static::creating(function ($m) {
            if (! $m->periode_id) {
                $m->periode_id = Periode::aktif()?->id;
            }
        });
    }

    public function periode()
    {
        return $this->belongsTo(Periode::class);
    }

    public function jenis()
    {
        return $this->belongsTo(JenisInventaris::class, 'jenis_id', 'id');
    }
}
