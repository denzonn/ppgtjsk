<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PiutangKeuangan extends Model
{
    use HasFactory;

    protected $table = 'piutang_keuangans';

    protected $fillable = [
        'keterangan',
        'jumlah',
        'status',
        'catatan',
        'photo',
    ];
}
