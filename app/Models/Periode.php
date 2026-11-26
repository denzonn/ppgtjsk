<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Periode extends Model
{
    protected $fillable = ['tahun_mulai', 'tahun_selesai', 'dibuat_oleh'];

    public function isAktif(): bool
    {
        $tahun = now()->year;

        return $this->tahun_mulai <= $tahun && $tahun <= $this->tahun_selesai;
    }

    public function sebelumnya(): ?Periode
    {
        return static::where('tahun_selesai', $this->tahun_mulai)->first();
    }

    public function label(): string
    {
        return $this->tahun_mulai.'-'.$this->tahun_selesai;
    }

    public static function aktif(): ?Periode
    {
        $user = Auth::user();
        if (! $user || $user->role !== 'ADMIN') {
            return null;
        }
        if ($user->periode_id) {
            return $user->periode;
        }

        if (request()->hasSession() && ($id = session('periode_id')) && ($p = static::find($id))) {
            return $p;
        }

        $tahun = now()->year;

        return static::where('tahun_mulai', '<=', $tahun)->where('tahun_selesai', '>=', $tahun)
            ->orderByDesc('tahun_mulai')->first()
            ?? static::orderByDesc('tahun_mulai')->first();
    }
}
