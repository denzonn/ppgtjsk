<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bidang extends Model
{
    use HasFactory;

    protected $tabel = 'bidangs';

    protected $fillable = [
        'nama_bidang',
        'foto_bidang',
    ];
}
