<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PundiKasihSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pundi_kasihs')->insert([
            [
                'bank_id' => '1',
                'no_rek' => '1520032833515',
                'atas_nama' => 'Irene Aprianti Baan'
            ],
            [
                'bank_id' => '2',
                'no_rek' => '548-513132-6',
                'atas_nama' => 'Irene Aprianti Baan'
            ],
            [
                'bank_id' => '3',
                'no_rek' => NULL,
                'atas_nama' => NULL
            ],
            [
                'bank_id' => '4',
                'no_rek' => NULL,
                'atas_nama' => NULL
            ],
        ]);
    }
}
