<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinkTerkait extends Model
{
    use \App\Models\Concerns\TercatatDiLog;
    use HasFactory;

    protected $fillable = [
        'label',
        'link'
    ];
}
