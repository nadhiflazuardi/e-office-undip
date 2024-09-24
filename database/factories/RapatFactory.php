<?php

namespace Database\Factories;

use App\Models\Rapat;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RapatFactory extends Factory
{
    protected $model = Rapat::class;

    public function definition()
    {
        $waktuMulai = $this->faker->dateTimeBetween('now', '+1 month');
        $waktuSelesai = clone $waktuMulai;
        $waktuSelesai->modify('+' . rand(1, 3) . ' hours');

        return [
            'pemimpin_rapat_id' => User::inRandomOrder()->first()->id,
            'judul' => $this->faker->sentence,
            'perihal' => $this->faker->paragraph,
            'waktu_mulai' => $waktuMulai,
            'waktu_selesai' => $waktuSelesai,
            'tempat' => $this->faker->randomElement(['Ruang Rapat A', 'Ruang Rapat B', 'Aula Utama', 'Ruang Konferensi']),
            'warna_label' => $this->faker->randomElement(['#d50000', '#039ae5', '#33b679']),
        ];
    }
}
