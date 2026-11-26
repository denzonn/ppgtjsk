<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RenunganHarian extends Model
{
    use \App\Models\Concerns\TercatatDiLog;
    use HasFactory;

    protected $table = 'renungan';

    protected $fillable = [
        'judul',
        'ayat',
        'isi',
        'url_youtube',
    ];
}
