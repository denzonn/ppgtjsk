<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('nama_banks')->insert([
            [
                'name' => 'Mandiri',
            ],
            [
                'name' => 'BCA',
            ],
            [
                'name' => 'BRI',
            ],
            [
                'name' => 'BNI',
            ],
        ]);
    }
}
