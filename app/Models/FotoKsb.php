<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoKsb extends Model
{
    use HasFactory;

    protected $table = 'foto_ksbs';

    protected $fillable = [
        'foto',
        'nama',
        'jabatan',
        'motto',
        'instagram',
        'facebook',
        'whatsapp',
    ];
}
