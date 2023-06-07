<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RenunganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('renungan')->insert([
            'judul' => 'Judul Renungan',
            'ayat' => 'Ayat Renungan',
            'isi' => 'Isi Renungan',
            'url_youtube' => 'https://www.youtube.com/embed/9XaS93WMRQQ',
        ]);
    }
}
