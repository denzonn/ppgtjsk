<?php

namespace App\Models;

use App\Models\Concerns\BerPeriode;

use App\Casts\PublicUrl;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use BerPeriode, HasFactory;

    protected $table = 'kegiatans';

    protected $fillable = [
        'periode_id',
        'name',
        'slug',
        'program_id',
        'bidang_id',
        'description',
        'photo',
        'link_drive',
        'checked'
    ];

    /** URL lengkap berbasis APP_URL saat dibaca; database tetap menyimpan path relatif. */
    protected $casts = [
        'photo' => PublicUrl::class,
    ];

    public function program()
    {
        return $this->belongsTo(ProgramKerja::class, 'program_id', 'id');
    }
}
