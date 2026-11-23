<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

/**
 * Gambar situs yang bisa diganti dari admin (menu Home > Gambar Situs).
 * Slot yang belum di-upload memakai gambar bawaan di public/images.
 */
class SiteImage extends Model
{
    protected $fillable = ['key', 'path'];

    /** key => [label, keterangan, gambar bawaan, grup] */
    public const SLOTS = [
        'hero' => ['Latar Hero Beranda', 'Foto besar di bagian paling atas beranda. Disarankan landscape, minimal 1600px.', 'images/pengurus.jpg', 'Beranda'],
        'logo' => ['Logo Situs', 'Tampil di navbar publik, halaman login, dan sidebar admin. Disarankan persegi/bulat, PNG transparan.', 'images/logo.png', 'Identitas'],
        'favicon' => ['Favicon', 'Ikon kecil di tab browser. Disarankan persegi 64×64 PNG.', 'images/titlelogo.png', 'Identitas'],
        'bank_mandiri' => ['Logo Bank Mandiri', 'Dipakai di bagian Pundi Kasih beranda.', 'images/mandiri.png', 'Pundi Kasih'],
        'bank_bni' => ['Logo Bank BNI', 'Dipakai di bagian Pundi Kasih beranda.', 'images/bni.png', 'Pundi Kasih'],
        'bank_bri' => ['Logo Bank BRI', 'Dipakai di bagian Pundi Kasih beranda.', 'images/bri.png', 'Pundi Kasih'],
        'bank_bca' => ['Logo Bank BCA / Lainnya', 'Dipakai untuk BCA dan bank lain yang belum punya logo sendiri.', 'images/bca.png', 'Pundi Kasih'],
    ];

    private static ?array $paths = null;

    /** URL gambar untuk slot $key (upload admin, atau bawaan). */
    public static function url(string $key): string
    {
        // Satu query per request; aman dipanggil sebelum migration dijalankan.
        self::$paths ??= Schema::hasTable('site_images') ? static::pluck('path', 'key')->all() : [];

        return isset(self::$paths[$key])
            ? Storage::url(self::$paths[$key])
            : asset(self::SLOTS[$key][2]);
    }

    /** Logo bank berdasarkan nama bank; bank tanpa slot memakai logo BCA seperti sebelumnya. */
    public static function bankLogo(string $bankName): string
    {
        $key = 'bank_' . strtolower($bankName);

        return static::url(isset(self::SLOTS[$key]) ? $key : 'bank_bca');
    }
}
