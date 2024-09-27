<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles
        $sekretaris = Role::firstOrCreate(['name' => 'Sekretaris']);
        $pengelolaKeuangan = Role::firstOrCreate(['name' => 'Pengelola Keuangan']);
        $pengadministrasiPersuratan = Role::firstOrCreate(['name' => 'Pengadministrasi Persuratan']);

        // create permissions
        $permissionBuatRapat = Permission::firstOrCreate(['name' => 'buat rapat']);
        $permissionBuatSppd = Permission::firstOrCreate(['name' => 'buat sppd']);
        $permissionBuatSurat = Permission::firstOrCreate(['name' => 'buat surat']);

        // assign permissions to roles
        $sekretaris->givePermissionTo($permissionBuatRapat);
        $pengelolaKeuangan->givePermissionTo($permissionBuatSppd);
        $pengadministrasiPersuratan->givePermissionTo($permissionBuatSurat);

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

        User::create([
            'unit_kerja_id' => 2,
            'jabatan_id' => 1,
            'nama' => 'Sekretaris',
            'email' => 'sekretaris@gmail.com',
            'password' => bcrypt('password'),
        ])->assignRole($sekretaris);

        User::create([
            'unit_kerja_id' => 3,
            'jabatan_id' => 2,
            'nama' => 'Pengelola Keuangan',
            'email' => 'pengelolakeuangan@gmail.com',
            'password' => bcrypt('password'),
        ])->assignRole($pengelolaKeuangan);

        User::create([
            'unit_kerja_id' => 4,
            'jabatan_id' => 3,
            'nama' => 'Pengadministrasi Persuratan',
            'email' => 'pengadministrasipersuratan@gmail.com',
            'password' => bcrypt('password'),
        ])->assignRole($pengadministrasiPersuratan);
    }
}
