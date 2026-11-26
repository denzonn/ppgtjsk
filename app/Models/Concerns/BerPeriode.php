<?php

namespace App\Models\Concerns;

use App\Models\Periode;
use Illuminate\Database\Eloquent\Builder;

trait BerPeriode
{
    public static function bootBerPeriode()
    {
        static::addGlobalScope('periode', function (Builder $query) {
            if ($periode = Periode::aktif()) {
                $query->where($query->getModel()->qualifyColumn('periode_id'), $periode->id);
            }
        });

        // Admin selalu terikat ke periode aktifnya; periode_id dari request tidak dipercaya.
        static::saving(function ($model) {
            if ($periode = Periode::aktif()) {
                $model->periode_id = $periode->id;
            }
        });
    }

    /** Kembalikan baris dari periode aktif, atau lempar ValidationException (web: back, API: 422). */
    public static function pastikanAda($id, string $field, string $pesan)
    {
        return static::find($id) // global scope: hanya periode aktif
            ?? throw \Illuminate\Validation\ValidationException::withMessages([$field => $pesan]);
    }

    public function periode()
    {
        return $this->belongsTo(Periode::class);
    }
}
