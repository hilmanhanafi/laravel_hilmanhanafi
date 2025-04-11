<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'username' => 'hilmanhanafi',
                'name' => 'Hilman',
                'email' => 'hilmanhanafi04@gmail.com',
                'password' => Hash::make('password123'),
            ],
            [
                'username' => 'admin',
                'name' => 'Administrator',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password456'),
            ],
        ]);
    }
}
