<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = json_decode(file_get_contents(database_path('seeders/data/user.json')), true);

        foreach ($data as $user) {
            User::create([
                'unit_kerja_id' => $user['unit_kerja_id'],
                'jabatan_id' => $user['jabatan_id'],
                'nama' => $user['nama'],
                'email' => $user['email'],
                'password' => bcrypt($user['password']),
            ]);
        }
    }
}
