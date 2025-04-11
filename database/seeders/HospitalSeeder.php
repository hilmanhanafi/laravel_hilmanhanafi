<?php

namespace Database\Seeders;

use App\Models\Hospital;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HospitalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Hospital::create([
            'nama_rumah_sakit' => 'Dustira',
            'alamat' => 'Jl. Dustira No.1, Baros, Kec. Cimahi Tengah, Kota Cimahi, Jawa Barat 40521',
            'email' => 'info.rsdustira@gmail.com',
            'telepon' => '0226652207'
        ]);

        Hospital::create([
            'nama_rumah_sakit' => 'Rumah Sakit Baros',
            'alamat' => 'Jl. Baros No.E46, Baros, Kec. Cimahi Tengah, Kota Cimahi, Jawa Barat 40521',
            'email' => 'marketing@rsbaros.com',
            'telepon' => '02220670808'
        ]);
    }
}
