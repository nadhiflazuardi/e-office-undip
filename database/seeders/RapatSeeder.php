<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rapat;
use App\Models\PresensiRapat;
use App\Models\User;

class RapatSeeder extends Seeder
{
    public function run()
    {
        // Membuat factory untuk Rapat
        Rapat::factory()->count(5)->create()->each(function ($rapat) {
            // Memastikan pemimpin rapat juga terdaftar sebagai peserta
            PresensiRapat::factory()->create([
                'rapat_id' => $rapat->id,
                'pegawai_id' => $rapat->pemimpin_rapat_id,
            ]);

            // Menambahkan 4-9 peserta tambahan
            $jumlahPesertaTambahan = rand(4, 9);
            $pesertaIds = User::where('id', '!=', $rapat->pemimpin_rapat_id)
                ->inRandomOrder()
                ->limit($jumlahPesertaTambahan)
                ->pluck('id');

            foreach ($pesertaIds as $pesertaId) {
                PresensiRapat::factory()->create([
                    'rapat_id' => $rapat->id,
                    'pegawai_id' => $pesertaId,
                ]);
            }
        });
    }
}
