<?php

namespace App\Models;

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

    public function jenis()
    {
        return $this->belongsTo(JenisInventaris::class, 'jenis_id', 'id');
    }
}
