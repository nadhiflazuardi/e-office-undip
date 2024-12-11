<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SuratMasuk>
 */
class SuratMasukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userId = User::whereHas('jabatan', function ($query) {
            $query->where('nama', 'Pengelola Informasi Akademik')->orWhere('nama','Pengadministrasi Akademik')->orWhere('nama','Pengadministrasi Persuratan')->orWhere('nama','Sekretaris');
        })->inRandomOrder()->first()->id;

        $perihalOptions = [
            'Pengajuan Pembelian Barang',
            'Pengajuan Pelatihan',
            'Pengajuan Penelitian',
            'Pengajuan Pengadaan Barang',
            'Pengajuan Pengembalian Barang',
            'Pengajuan Penghapusan Barang',
            'Pengajuan Penugasan',
            'Pengajuan Perbaikan Barang',
            'Pengajuan Perubahan Data',
            'Pengajuan Pindah Unit Kerja',
            'Pengajuan Pindah Jabatan',
            'Pengajuan Pindah Tugas'
        ];

        return [
            'nomor_surat' => $this->faker->unique()->numerify('###/###/###'),
            'perihal' => fake()->randomElement($perihalOptions),
            'asal' => $this->faker->name(),
            'tujuan' => $this->faker->name(),
            'tanggal_diterima' => $this->faker->date(),
            'file_surat' => $this->faker->word,
            'pengarsip_id' => $userId,
        ];
    }
}
