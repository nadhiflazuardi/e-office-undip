<?php

namespace Database\Seeders;

use App\Models\Pegawai;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = json_decode(file_get_contents(database_path('seeders/data/pegawai.json')), true);

        foreach ($data as $pegawai) {
            Pegawai::create([
                'unit_kerja_id' => $pegawai['unit_kerja_id'],
                'jabatan_id' => $pegawai['jabatan_id'],
                'nama' => $pegawai['nama'],
                'email' => $pegawai['email'],
                'password' => bcrypt($pegawai['password']),
            ]);
        }
    }
}
