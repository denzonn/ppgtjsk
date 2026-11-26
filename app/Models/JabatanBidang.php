<?php

namespace App\Models;

use App\Models\Concerns\BerPeriode;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JabatanBidang extends Model
{
    use BerPeriode, HasFactory;

    protected $table = 'jabatan_bidangs';

    protected $fillable = [
        'periode_id',
        'nama_jabatan',
    ];
}
