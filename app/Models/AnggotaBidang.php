<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggotaBidang extends Model
{
    use HasFactory;

    protected $table = 'anggota_bidangs';

    protected $fillable = [
        'nama_anggota',
        'foto',
        'jabatans_id',
        'bidangs_id',
    ];

    public function jabatan()
    {
        return $this->belongsTo(JabatanBidang::class, 'jabatans_id', 'id');
    }

    public function bidang()
    {
        return $this->belongsTo(Bidang::class, 'bidangs_id', 'id');
    }
}
