<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('profils', function (Blueprint $table) {
            $table->foreignId('periode_id')->nullable()->constrained('periodes')->restrictOnDelete();
        });

        $cari = function ($mulai, $selesai) {
            $id = DB::table('periodes')->where('tahun_mulai', $mulai)->where('tahun_selesai', $selesai)->value('id');

            return $id ?? DB::table('periodes')->insertGetId([
                'tahun_mulai' => $mulai, 'tahun_selesai' => $selesai,
                'created_at' => now(), 'updated_at' => now(),
            ]);
        };

        foreach (DB::table('profils')->get(['id', 'periode']) as $row) {
            preg_match('/^(\d{4})\s*-\s*(\d{4})$/', trim((string) $row->periode), $m);
            DB::table('profils')->where('id', $row->id)
                ->update(['periode_id' => $m ? $cari($m[1], $m[2]) : $cari(2024, 2026)]);
        }

        Schema::table('profils', function (Blueprint $table) {
            $table->dropColumn('periode');
        });
    }

    public function down()
    {
        Schema::table('profils', function (Blueprint $table) {
            $table->string('periode')->nullable();
        });

        foreach (DB::table('periodes')->get() as $p) {
            DB::table('profils')->where('periode_id', $p->id)
                ->update(['periode' => $p->tahun_mulai . '-' . $p->tahun_selesai]);
        }

        Schema::table('profils', function (Blueprint $table) {
            $table->dropConstrainedForeignId('periode_id');
        });
    }
};
