<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $table = 'kegiatans';

    protected $fillable = [
        'name',
        'slug',
        'program_id',
        'bidang_id',
        'description',
        'photo',
        'link_drive',
    ];

    public function program()
    {
        return $this->belongsTo(ProgramKerja::class, 'program_id', 'id');
    }
}
