<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kaderisasi extends Model
{
    use HasFactory;

    protected $table = 'kaderisasis';

    protected $fillable = [
        'anggota_id',
        'pelatihan_id',
        'tahun',
    ];

    public function anggota()
    {
        return $this->belongsTo(DataAnggota::class, 'anggota_id', 'id');
    }

    public function pelatihan()
    {
        return $this->belongsTo(Pelatihan::class, 'pelatihan_id', 'id');
    }
}
