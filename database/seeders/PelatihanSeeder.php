<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PelatihanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pelatihans')->insert([
            [
                'nama_pelatihan' => 'LKPD',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_pelatihan' => 'LKPL',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_pelatihan' => 'LKPA',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_pelatihan' => 'TOT',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
