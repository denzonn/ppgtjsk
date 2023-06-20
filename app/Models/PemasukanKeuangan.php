<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemasukanKeuangan extends Model
{
    use HasFactory;

    protected $table = 'pemasukan_keuangans';

    protected $fillable = [
        'tanggal',
        'keterangan',
        'jumlah',
        'catatan',
        'photo',
    ];
}
