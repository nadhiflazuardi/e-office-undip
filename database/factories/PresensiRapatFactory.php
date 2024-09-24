<?php

namespace Database\Factories;

use App\Models\PresensiRapat;
use App\Models\Rapat;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PresensiRapatFactory extends Factory
{
    protected $model = PresensiRapat::class;

    public function definition()
    {
        return [
            'rapat_id' => Rapat::factory(),
            'pegawai_id' => User::inRandomOrder()->first()->id,
            'status' => $this->faker->randomElement(['hadir', 'izin', 'notset']),
        ];
    }
}
