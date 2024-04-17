<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BidangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bidangs')->insert([
            [
                'nama_bidang' => 'Manajemen',
                'foto_bidang' => 'foto.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_bidang' => 'Spiritualitas & Pengakaran Iman',
                'foto_bidang' => 'foto.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_bidang' => 'Organisasi',
                'foto_bidang' => 'foto.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_bidang' => 'Sumber Daya Manusia (SDM)',
                'foto_bidang' => 'foto.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_bidang' => 'Pelayanan Sosial & Kemasyarakatan',
                'foto_bidang' => 'foto.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_bidang' => 'Kelompok-Kelompok',
                'foto_bidang' => 'foto.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
