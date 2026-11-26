<?php

namespace App\Models\Concerns;

use App\Models\ActivityLog;
use App\Models\Periode;
use Illuminate\Support\Facades\Auth;

trait TercatatDiLog
{
    public static function bootTercatatDiLog()
    {
        static::created(fn ($m) => $m->catatLog('tambah', null, $m->getAttributes()));
        static::deleted(fn ($m) => $m->catatLog('hapus', $m->getAttributes(), null));
        static::updated(function ($m) {
            $sesudah = collect($m->getChanges())->except(['updated_at', 'password', 'remember_token']);
            if ($sesudah->isEmpty()) {
                return;
            }
            $sebelum = collect($m->getRawOriginal())->only($sesudah->keys());
            $m->catatLog('ubah', $sebelum->all(), $sesudah->all());
        });
    }

    protected function catatLog(string $aksi, ?array $sebelum, ?array $sesudah): void
    {
        $buang = array_flip(['password', 'remember_token']);
        ActivityLog::create([
            'user_id' => Auth::id(),
            'periode_id' => Periode::aktif()?->id,
            'per_periode' => in_array(BerPeriode::class, class_uses_recursive($this)),
            'aksi' => $aksi,
            'model' => static::class,
            'model_id' => $this->getKey(),
            'sebelum' => $sebelum === null ? null : array_diff_key($sebelum, $buang),
            'sesudah' => $sesudah === null ? null : array_diff_key($sesudah, $buang),
        ]);
    }
}
