<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Periode;
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
        $periodeId = Periode::firstOrCreate(['tahun_mulai' => 2024, 'tahun_selesai' => 2026])->id;
        DB::table('foto_ksbs')->insert(array_map(fn ($baris) => $baris + ['periode_id' => $periodeId], [
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
                    'jabatan' => 'Sekretaris',
                    'motto' => 'Hidup itu indah',
                    'instagram' => 'https://www.instagram.com/denson/',
                    'facebook' => 'https://www.facebook.com/denson/',
                    'whatsapp' => 'https://www.whatsapp.com/denson/',
                ],
                [
                    'foto' => 'foto-ksb.jpg',
                    'nama' => 'Denson',
                    'jabatan' => 'Wakil Sekretaris',
                    'motto' => 'Hidup itu indah',
                    'instagram' => 'https://www.instagram.com/denson/',
                    'facebook' => 'https://www.facebook.com/denson/',
                    'whatsapp' => 'https://www.whatsapp.com/denson/',
                ],
                [
                    'foto' => 'foto-ksb.jpg',
                    'nama' => 'Denson',
                    'jabatan' => 'Bendahara',
                    'motto' => 'Hidup itu indah',
                    'instagram' => 'https://www.instagram.com/denson/',
                    'facebook' => 'https://www.facebook.com/denson/',
                    'whatsapp' => 'https://www.whatsapp.com/denson/',
                ],
            ]));
    }
}
