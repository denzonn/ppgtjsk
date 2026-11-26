<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Ubah semua kolom file (cast PublicUrl) di database jadi URL lengkap sesuai APP_URL saat ini.
// Aman dijalankan berulang; jalankan lagi setelah APP_URL berubah (mis. setelah deploy ke server).
Artisan::command('files:full-url {--dry-run : Hanya tampilkan jumlah yang akan diubah}', function () {
    $models = collect(glob(app_path('Models/{,*/}*.php'), GLOB_BRACE))
        ->map(fn ($f) => 'App\\Models\\' . str_replace(['/', '.php'], ['\\', ''], substr($f, strlen(app_path('Models/')))))
        ->filter(fn ($c) => is_subclass_of($c, \Illuminate\Database\Eloquent\Model::class));

    foreach ($models as $class) {
        $model = new $class;
        $columns = array_keys(array_filter($model->getCasts(), fn ($cast) => $cast === \App\Casts\PublicUrl::class));
        if (! $columns || ! \Illuminate\Support\Facades\Schema::hasTable($model->getTable())) continue;

        $changed = 0;
        \Illuminate\Support\Facades\DB::table($model->getTable())->orderBy($model->getKeyName())
            ->each(function ($row) use ($model, $columns, &$changed) {
                $update = [];
                foreach ($columns as $col) {
                    $old = $row->$col ?? null;
                    if ($old !== null && $old !== '' && ($new = \App\Casts\PublicUrl::toUrl($old)) !== $old) $update[$col] = $new;
                }
                if (! $update) return;
                $changed++;
                if (! $this->option('dry-run')) {
                    \Illuminate\Support\Facades\DB::table($model->getTable())->where($model->getKeyName(), $row->{$model->getKeyName()})->update($update);
                }
            });
        $this->line(sprintf('%-28s %-22s %d baris %s', $model->getTable(), implode(',', $columns), $changed, $this->option('dry-run') ? '(dry-run)' : 'diubah'));
    }
})->purpose('Simpan alamat file upload sebagai URL lengkap berbasis APP_URL');
