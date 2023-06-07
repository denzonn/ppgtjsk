<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataAnggota extends Model
{
    use HasFactory;

    protected $table = 'data_anggotas';

    protected $fillable = [
        'nik',
        'nama',
        'email',
        'no_hp',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'jenis_kelamin',
        'golongan_darah',
        'rhesus',
        'bersedia',
        'status',
        'keanggotaan',
        'pendidikan',
        'pekerjaan',
        'domisili',
        'nama_ayah',
        'nama_ibu',
        'keterangan_tinggal',
        'wilayah',
    ];
}
