<?php

namespace App\Models;

use App\Models\Concerns\BerPeriode;

use App\Casts\PublicUrl;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bidang extends Model
{
    use \App\Models\Concerns\TercatatDiLog, BerPeriode, HasFactory;

    protected $table = 'bidangs';

    protected $fillable = [
        'periode_id',
        'nama_bidang',
        'foto_bidang',
        'maksimal_orang',
    ];

    /** URL lengkap berbasis APP_URL saat dibaca; database tetap menyimpan path relatif. */
    protected $casts = [
        'foto_bidang' => PublicUrl::class,
    ];

    public function pengurus()
    {
        return $this->hasMany(AnggotaBidang::class, 'bidangs_id');
    }

    public function sudahPenuh(?int $kecualiPengurusId = null): bool
    {
        if ($this->maksimal_orang === null) {
            return false;
        }

        return $this->pengurus()->when($kecualiPengurusId, fn ($q) => $q->where('id', '!=', $kecualiPengurusId))
            ->count() >= $this->maksimal_orang;
    }

    /** Lempar ValidationException (web: kembali ke form, API: 422) kalau bidang sudah penuh. */
    public static function pastikanMuat($bidangId, ?int $kecualiPengurusId = null): void
    {
        $bidang = $bidangId ? static::find($bidangId) : null;
        if ($bidang && $bidang->sudahPenuh($kecualiPengurusId)) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'bidangs_id' => "Bidang {$bidang->nama_bidang} sudah penuh ({$bidang->maksimal_orang} orang).",
            ]);
        }
    }
}
