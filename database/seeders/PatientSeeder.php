<?php

namespace Database\Seeders;

use App\Models\Patient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Patient::create([
            'nama_pasien' => 'Dewi Irawati',
            'alamat' => 'Jalan Patuha No.14, Lingkar Selatan, Kota Bandung, Jawa Barat',
            'no_telepon' => '08123456789',
            'id_rumah_sakit' => 1
        ]);

        Patient::create([
            'nama_pasien' => 'Hanafi',
            'alamat' => 'Jalan tipar barat Rt09/02 Kabupaten Bandung Barat',
            'no_telepon' => '085759920857',
            'id_rumah_sakit' => 2
        ]);
    }
}
