<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PundiKasih extends Model
{
    use HasFactory;

    protected $fillable = [
        'bank_id',
        'no_rek',
        'atas_nama',
    ];

    public function bank()
    {
        return $this->belongsTo(NamaBank::class, 'bank_id', 'id');
    }
}
