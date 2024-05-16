<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                'name' => 'Admin',
                'email' => 'ppgtsatriakasih@gmail.com',
                'password' => bcrypt('111262'),
                'role' => 'ADMIN',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
