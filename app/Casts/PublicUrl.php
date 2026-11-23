<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * Kolom file/gambar hasil upload.
 *
 * Database menyimpan path relatif (mis. "photo/abc.jpg" di disk public, atau "images/nodata.jpg" di public/),
 * tapi saat dibaca selalu menjadi URL lengkap berbasis APP_URL, mis. https://www.ppgt-satriakasih.org/storage/photo/abc.jpg.
 * Berlaku di view maupun respons JSON API. Untuk menghapus file, pakai $model->getRawOriginal('kolom').
 */
class PublicUrl implements CastsAttributes
{
    public function get(Model $model, string $key, mixed $value, array $attributes): ?string
    {
        if ($value === null || $value === '') {
            return $value;
        }

        $path = static::toPath($value);

        // URL eksternal (bukan file situs ini) dibiarkan apa adanya.
        if (preg_match('~^https?://~i', $path)) {
            return $path;
        }

        // File di public/images (mis. gambar "nodata") vs file upload di storage/app/public.
        return str_starts_with($path, 'images/')
            ? rtrim(config('app.url'), '/') . '/' . $path
            : Storage::disk('public')->url($path);
    }

    public function set(Model $model, string $key, mixed $value, array $attributes): ?string
    {
        return $value === null || $value === '' ? $value : static::toPath($value);
    }

    /**
     * Ubah URL lengkap milik situs ini (domain apa pun, termasuk data lama "http://localhost/...") kembali ke path relatif.
     */
    public static function toPath(string $value): string
    {
        $urlPath = preg_match('~^https?://~i', $value) ? (string) parse_url($value, PHP_URL_PATH) : '/' . ltrim($value, '/');

        return match (true) {
            str_starts_with($urlPath, '/storage/') => substr($urlPath, strlen('/storage/')),
            str_starts_with($urlPath, '/images/') => ltrim($urlPath, '/'),
            preg_match('~^https?://~i', $value) === 1 => $value,
            default => ltrim($value, '/'),
        };
    }
}
