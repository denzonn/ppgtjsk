<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * Kolom file hasil upload (gambar, PDF, Excel, dll).
 *
 * Database menyimpan URL lengkap berbasis FILE_URL (atau APP_URL bila kosong), mis. https://www.ppgt-satriakasih.org/storage/photo/abc.jpg.
 * Saat dibaca, URL selalu disesuaikan ke FILE_URL/APP_URL yang aktif, jadi data hasil salin dari server lain tetap tampil.
 * Untuk menghapus file dari disk, pakai PublicUrl::toPath($model->getRawOriginal('kolom')).
 * Data lama (path relatif) diubah dengan: php artisan files:full-url
 */
class PublicUrl implements CastsAttributes
{
    public function get(Model $model, string $key, mixed $value, array $attributes): ?string
    {
        return $value === null || $value === '' ? $value : static::toUrl($value);
    }

    public function set(Model $model, string $key, mixed $value, array $attributes): ?string
    {
        return $value === null || $value === '' ? $value : static::toUrl($value);
    }

    /** Path relatif / URL lama situs ini -> URL lengkap berbasis APP_URL. URL eksternal dibiarkan. */
    public static function toUrl(string $value): string
    {
        $path = static::toPath($value);

        return match (true) {
            preg_match('~^https?://~i', $path) === 1 => $path,
            // File di public/images (mis. gambar "nodata") vs file upload di storage/app/public.
            str_starts_with($path, 'images/') => rtrim(config('app.url'), '/') . '/' . $path,
            default => Storage::disk('public')->url($path),
        };
    }

    /**
     * URL lengkap milik situs ini (domain apa pun, termasuk data lama "http://localhost/...") -> path relatif di disk public.
     */
    public static function toPath(string $value): string
    {
        $urlPath = preg_match('~^https?://~i', $value) ? rawurldecode((string) parse_url($value, PHP_URL_PATH)) : '/' . ltrim($value, '/');

        return match (true) {
            str_starts_with($urlPath, '/storage/') => substr($urlPath, strlen('/storage/')),
            str_starts_with($urlPath, '/images/') => ltrim($urlPath, '/'),
            preg_match('~^https?://~i', $value) === 1 => $value,
            default => ltrim($value, '/'),
        };
    }
}
