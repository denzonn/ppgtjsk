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

        static::creating(function ($model) {
            if (! $model->periode_id) {
                $model->periode_id = Periode::aktif()?->id;
            }
        });
    }

    public function periode()
    {
        return $this->belongsTo(Periode::class);
    }
}
