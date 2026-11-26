<?php

namespace App\Models;

use App\Models\Concerns\BerPeriode;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramKerja extends Model
{
    use \App\Models\Concerns\TercatatDiLog, BerPeriode, HasFactory;

    protected $table = 'program_kerjas';

    protected $fillable = [
        'periode_id',
        'name',
        'description',
        'bidang_id'
    ];

    public function bidang()
    {
        return $this->belongsTo(Bidang::class, 'bidang_id', 'id');
    }
}
