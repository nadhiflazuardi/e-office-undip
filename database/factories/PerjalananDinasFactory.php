<?php

namespace Database\Factories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PerjalananDinas>
 */
class PerjalananDinasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $pemberi_perintah = User::whereHas('roles', function ($query) {
            $query->where('name', 'Supervisor');
        })->inRandomOrder()->first();

        $pelaksana = User::whereDoesntHave('roles', function($query) {
            $query->whereIn('name', ['supervisor', 'Wakil Dekan', 'Dekan']);
        })->where('unit_kerja_id', $pemberi_perintah->unit_kerja_id)->where('id', '!=', $pemberi_perintah->id)->inRandomOrder()->first();

        $keperluanPerjalananOptions = [
            'Menghadiri Rapat Koordinasi',
            'Menghadiri Rapat Evaluasi',
            'Menghadiri Rapat Kerja',
            'Pelatihan Kompetensi',
            'Sertiikasi Kompetensi',
            'Peresmian Gedung',
            'Pengawasan Proyek',
            'Penelitian Lapangan',
            'Kegiatan Pengembangan',
            'Pendampingan Kegiatan',
        ];

        return [
            'pemberi_perintah_id' => $pemberi_perintah->id,
            'jabatan_pemberi_perintah_id' => $pemberi_perintah->jabatan_id,
            'pelaksana_id' => $pelaksana->id,
            'jabatan_pelaksana_id' => $pelaksana->jabatan_id,
            'nomor_surat' => "SPPD" . $this->faker->unique()->numerify('###/###/###'),
            'tanggal_surat' => $this->faker->date(),
            'alamat_perjalanan' => $this->faker->sentence,
            'tanggal_mulai' => $this->faker->dateTimeBetween('-1 week', 'now'),
            'tanggal_selesai' => $this->faker->dateTimeBetween('now', '+1 week'),
            'anggaran' => $this->faker->randomNumber('5'),
            'keperluan_perjalanan' => $this->faker->randomElement($keperluanPerjalananOptions),
            'keterangan' => $this->faker->sentence,
            'file_sppd' => $this->faker->word,

        ];
    }
}
