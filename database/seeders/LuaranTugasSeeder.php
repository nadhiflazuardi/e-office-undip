<?php

namespace Database\Seeders;

use App\Models\Log;
use App\Models\LuaranTugas;
use App\Models\VerifikasiLuaranTugas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LuaranTugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LuaranTugas::factory()->count(100)->create()->each(function ($luaranTugas) {
            if ($luaranTugas->status != 'sedang diperiksa') {
                $luaranTugas->verifikasi()->save(VerifikasiLuaranTugas::factory([
                    'status' => $luaranTugas->status
                ])->make());
            }

            if ($luaranTugas->status == 'disetujui') {
                Log::create([
                    'pegawai_id' => $luaranTugas->pegawai_id,
                    'kegiatan_id' => $luaranTugas->id,
                    'bobot' => $luaranTugas->bobot,
                ]);
            }
        });
    }
}
