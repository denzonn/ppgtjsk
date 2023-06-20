<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengeluaranKeuangan extends Model
{
    use HasFactory;

    protected $table = 'pengeluaran_keuangans';

    protected $fillable = [
        'tanggal',
        'keterangan',
        'jumlah',
        'catatan',
        'photo',
    ];
}
