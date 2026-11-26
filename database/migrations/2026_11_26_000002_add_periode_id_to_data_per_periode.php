<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private $tabel = [
        'bidangs', 'jabatan_bidangs', 'anggota_bidangs', 'foto_ksbs', 'program_kerjas',
        'notulensi_rapats', 'artikels', 'kegiatans', 'gallery_kegiatans',
    ];

    public function up()
    {
        foreach ($this->tabel as $nama) {
            Schema::table($nama, function (Blueprint $table) {
                $table->foreignId('periode_id')->nullable()->constrained('periodes')->cascadeOnDelete();
            });
        }

        $id = DB::table('periodes')->where(['tahun_mulai' => 2024, 'tahun_selesai' => 2026])->value('id');
        foreach ($this->tabel as $nama) {
            DB::table($nama)->update(['periode_id' => $id]);
        }
    }

    public function down()
    {
        foreach ($this->tabel as $nama) {
            Schema::table($nama, function (Blueprint $table) {
                $table->dropConstrainedForeignId('periode_id');
            });
        }
    }
};
