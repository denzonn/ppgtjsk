<?php

namespace Tests;

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    public function createApplication(): Application
    {
        $app = require __DIR__.'/../bootstrap/app.php';
        $app->make(Kernel::class)->bootstrap();

        return $app;
    }

    /** Data anggota minimal untuk test (kolom NOT NULL diisi nilai dummy). */
    protected function anggota(string $email, bool $aktif = true): \App\Models\DataAnggota
    {
        $isi = array_fill_keys(['nik', 'no_hp', 'tempat_lahir', 'alamat', 'jenis_kelamin', 'golongan_darah', 'rhesus',
            'bersedia', 'status', 'keanggotaan', 'pendidikan', 'pekerjaan', 'domisili', 'nama_ayah', 'nama_ibu',
            'keterangan_tinggal', 'wilayah'], '-');

        return \App\Models\DataAnggota::forceCreate($isi + [
            'nama' => 'Anggota '.$email, 'email' => $email, 'tanggal_lahir' => '2000-01-01', 'status_active' => $aktif,
        ]);
    }
}
