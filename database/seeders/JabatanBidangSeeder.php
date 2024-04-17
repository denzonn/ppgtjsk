<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        DB::table('jabatan_bidangs')->insert([
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
        ]);
    }
}
