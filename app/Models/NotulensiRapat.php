<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotulensiRapat extends Model
{
    use HasFactory;

    protected $table = 'notulensi_rapats';

    protected $fillable = [
        'tanggal',
        'judul',
        'isi',
        'file',
    ];
}
