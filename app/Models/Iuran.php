<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Iuran extends Model
{
    use HasFactory;

    protected $table = 'iurans';

    protected $fillable = [
        'nama',
        'kelompok',
        'keterangan',
        'jumlah',
        'catatan',
    ];
}
