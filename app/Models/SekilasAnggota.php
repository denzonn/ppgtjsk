<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SekilasAnggota extends Model
{
    use \App\Models\Concerns\TercatatDiLog;
    use HasFactory;

    protected $fillable = [
        'description'
    ];
}
