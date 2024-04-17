<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SekilasAnggotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sekilas_anggotas')->insert([
            'description' => 'Buat teman-teman yang rindu untuk mendapatkan layanan kasih (ibadah PPGT) dapat menghubungi pengurus Kelompok 1 Dave dan Kelompok 2 Euro Angelo',
        ]);
    }
}
