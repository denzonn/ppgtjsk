<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KsbSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('foto_ksbs')->insert(
            [
                [
                    'foto' => 'foto-ksb.jpg',
                    'nama' => 'Denson',
                    'jabatan' => 'Ketua',
                    'motto' => 'Hidup itu indah',
                    'instagram' => 'https://www.instagram.com/denson/',
                    'facebook' => 'https://www.facebook.com/denson/',
                    'whatsapp' => 'https://www.whatsapp.com/denson/',
                ],
                [
                    'foto' => 'foto-ksb.jpg',
                    'nama' => 'Denson',
                    'jabatan' => 'Ketua',
                    'motto' => 'Hidup itu indah',
                    'instagram' => 'https://www.instagram.com/denson/',
                    'facebook' => 'https://www.facebook.com/denson/',
                    'whatsapp' => 'https://www.whatsapp.com/denson/',
                ],
                [
                    'foto' => 'foto-ksb.jpg',
                    'nama' => 'Denson',
                    'jabatan' => 'Ketua',
                    'motto' => 'Hidup itu indah',
                    'instagram' => 'https://www.instagram.com/denson/',
                    'facebook' => 'https://www.facebook.com/denson/',
                    'whatsapp' => 'https://www.whatsapp.com/denson/',
                ],
                [
                    'foto' => 'foto-ksb.jpg',
                    'nama' => 'Denson',
                    'jabatan' => 'Ketua',
                    'motto' => 'Hidup itu indah',
                    'instagram' => 'https://www.instagram.com/denson/',
                    'facebook' => 'https://www.facebook.com/denson/',
                    'whatsapp' => 'https://www.whatsapp.com/denson/',
                ],
            ]
        );
    }
}
