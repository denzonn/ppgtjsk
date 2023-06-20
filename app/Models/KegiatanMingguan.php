<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KegiatanMingguan extends Model
{
    use HasFactory;

    protected $table = 'kegiatan_mingguans';

    protected $fillable = [
        'tanggal',
        'kegiatan_id',
        'waktu',
        'tempat',
    ];

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'kegiatan_id', 'id');
    }
}
