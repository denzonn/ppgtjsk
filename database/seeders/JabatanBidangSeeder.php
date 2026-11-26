<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Periode;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JabatanBidangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $periodeId = Periode::firstOrCreate(['tahun_mulai' => 2024, 'tahun_selesai' => 2026])->id;
        DB::table('jabatan_bidangs')->insert(array_map(fn ($baris) => $baris + ['periode_id' => $periodeId], [
            [
                'nama_jabatan' => 'Ketua'
            ],
            [
                'nama_jabatan' => 'Sekretaris'
            ],
            [
                'nama_jabatan' => 'Wakil Sekretaris'
            ],
            [
                'nama_jabatan' => 'Bendahara'
            ],
            [
                'nama_jabatan' => 'Ketua Bidang'
            ],
            [
                'nama_jabatan' => 'Anggota Bidang'
            ],
            [
                'nama_jabatan' => 'Koodinator Kelompok 1'
            ],
            [
                'nama_jabatan' => 'Koodinator Kelompok 2'
            ],
            [
                'nama_jabatan' => 'Wakil Koodinator Kelompok 1'
            ],
            [
                'nama_jabatan' => 'Wakil Koodinator Kelompok 2'
            ],
        ]));
    }
}
