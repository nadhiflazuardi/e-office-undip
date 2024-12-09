<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use App\Models\Log;
use App\Models\UnitKerja;
use App\Models\User;
use App\Models\UserTutam;
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
        $supervisor = Role::firstOrCreate(['name' => 'Supervisor']);
        $sekretaris = Role::firstOrCreate(['name' => 'Sekretaris']);
        $pengelolaKeuangan = Role::firstOrCreate(['name' => 'Pengelola Keuangan']);
        $pengadministrasiPersuratan = Role::firstOrCreate(['name' => 'Pengadministrasi Persuratan']);
        $wakilDekanRole = Role::firstOrCreate(['name' => 'Wakil Dekan']);
        $dekanRole = Role::firstOrCreate(['name' => 'Dekan']);

        // create permissions
        $permissionRevisi = Permission::firstOrCreate(['name' => 'revisi']);
        $permissionBuatRapat = Permission::firstOrCreate(['name' => 'buat rapat']);
        $permissionBuatSppd = Permission::firstOrCreate(['name' => 'buat sppd']);
        $permissionBuatSurat = Permission::firstOrCreate(['name' => 'buat surat']);
        $permissionLihatSurat = Permission::firstOrCreate(['name' => 'lihat surat']);
        $permissionBuatArsipSurat = Permission::firstOrCreate(['name' => 'buat arsip surat']);
        $permissionRevisiSurat = Permission::firstOrCreate(['name' => 'revisi surat']);

        // assign permissions to roles
        $supervisor->givePermissionTo([$permissionRevisi, $permissionLihatSurat, $permissionBuatSppd, $permissionRevisiSurat]);
        $sekretaris->givePermissionTo($permissionBuatRapat);
        $pengelolaKeuangan->givePermissionTo($permissionBuatSppd);
        $pengadministrasiPersuratan->givePermissionTo([$permissionBuatSurat, $permissionLihatSurat, $permissionBuatArsipSurat]);
        $wakilDekanRole->givePermissionTo([$permissionRevisiSurat, $permissionLihatSurat]);
        $dekanRole->givePermissionTo([$permissionRevisiSurat, $permissionLihatSurat]);

        $units = UnitKerja::all();
        $jabatanSekretaris = Jabatan::where('nama', 'Sekretaris')->first();
        $jabatanPengelolaKeuangan = Jabatan::where('nama', 'Pengelola Keuangan')->first();
        $jabatanPengadministrasiPersuratan = Jabatan::where('nama', 'Pengadministrasi Persuratan')->first();
        $jabatanWakilDekanSumberdaya = Jabatan::where('nama', 'Wakil Dekan Sumberdaya')->first();
        $jabatanDekan = Jabatan::where('nama', 'Dekan')->first();

        foreach ($units as $unit) {
            $unitName = strtolower(str_replace(' ', '', $unit->nama));

            $dekan = $unit
                ->user()
                ->create([
                    'jabatan_id' => $jabatanDekan->id,
                    'nama' => 'Dekan ' . $unit->nama,
                    'email' => 'dekan' . $unitName . '@gmail.com',
                    'password' => bcrypt('password'),
                ])
                ->assignRole($dekanRole);
            
            $dekan->userTutam()->create([
                'tutam_id' => 2
            ]);

            
            $wakilDekan = $unit
                ->user()
                ->create([
                    'jabatan_id' => $jabatanWakilDekanSumberdaya->id,
                    'nama' => 'Wakil Dekan Sumberdaya ' . $unit->nama,
                    'email' => 'wakildekan' . $unitName . '@gmail.com',
                    'password' => bcrypt('password'),
                    'supervisor_id' => $dekan->id,
                ])
                ->assignRole($wakilDekanRole);

            $wakilDekan->userTutam()->create([
                'tutam_id' => 4
            ]);

            $supervisorAkademik = $unit
                ->user()
                ->create([
                    'jabatan_id' => 13,
                    'nama' => 'Supervisor Akademik dan Kemahasiswaan',
                    'email' => 'supervisorak' . $unitName . '@gmail.com',
                    'password' => bcrypt('password'),
                    'supervisor_id' => $wakilDekan->id,
                ])
                ->assignRole($supervisor);

            $supervisorAkademik->userTutam()->create([
                'tutam_id' => 6,
            ]);

            $supervisorSumberdaya = $unit
                ->user()
                ->create([
                    'jabatan_id' => 14,
                    'nama' => 'Supervisor Sumberdaya',
                    'email' => 'supervisorsdm' . $unitName . '@gmail.com',
                    'password' => bcrypt('password'),
                ])
                ->assignRole($supervisor);
            $supervisorSumberdaya->userTutam()->create([
                'tutam_id' => 7,
            ]);


            $unit
                ->user()
                ->create([
                    'jabatan_id' => $jabatanSekretaris->id,
                    'nama' => 'Sekretaris',
                    'email' => 'sekretaris' . $unitName . '@gmail.com',
                    'password' => bcrypt('password'),
                    'supervisor_id' => $supervisorAkademik->id,
                ])
                ->assignRole($sekretaris);

            $unit
                ->user()
                ->create([
                    'jabatan_id' => $jabatanPengelolaKeuangan->id,
                    'nama' => 'Pengelola Keuangan',
                    'email' => 'pengelolakeuangan' . $unitName . '@gmail.com',
                    'password' => bcrypt('password'),
                    'supervisor_id' => $supervisorAkademik->id,
                ])
                ->assignRole($pengelolaKeuangan);

            $unit
                ->user()
                ->create([
                    'jabatan_id' => $jabatanPengadministrasiPersuratan->id,
                    'nama' => 'Pengadministrasi Persuratan',
                    'email' => 'pengadministrasipersuratan' . $unitName . '@gmail.com',
                    'password' => bcrypt('password'),
                    'supervisor_id' => $supervisorAkademik->id,
                ])
                ->assignRole($pengadministrasiPersuratan);
        }

        // User::

        // UserTutam::create([
        //     'user_id' => 1,
        //     'tutam_id' => 6,
        // ]);

        // User::create([
        //     'unit_kerja_id' => 1,
        //     'jabatan_id' => 14,
        //     'nama' => 'Supervisor Sumberdaya',
        //     'email' => 'supervisorsdm@gmail.com',
        //     'password' => bcrypt('password'),
        // ])->assignRole($supervisor);

        // UserTutam::create([
        //     'user_id' => 2,
        //     'tutam_id' => 7,
        // ]);

        $data = json_decode(file_get_contents(database_path('seeders/data/user.json')), true);

        $userCount = 1;
        foreach ($data as $user) {
            $user = User::create([
                'unit_kerja_id' => $user['unit_kerja_id'],
                'jabatan_id' => $user['jabatan_id'],
                'nama' => $user['nama'],
                'email' => $user['email'],
                'supervisor_id' => User::role('Supervisor')->inRandomOrder()->where('unit_kerja_id', $user['unit_kerja_id'])->first()->id,
                'password' => bcrypt($user['password']),
            ]);

            for ($i = 1; $i <= 6; $i++) {
                Log::create([
                    'pegawai_id' => $user->id,
                    'kegiatan_id' => 'P' . '24100' . $i . $userCount,
                    'bobot' => 450,
                ]);
            }

            // for ($i = 1; $i <= 2; $i++) {
            //     Log::create([
            //         'pegawai_id' => $user->id,
            //         'kegiatan_id' => 'R'.'24100'.$i.$userCount,
            //         'bobot' => 100,
            //     ]);
            // }

            $userCount += 1;
        }
    }
}
