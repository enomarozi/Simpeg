<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\SKPPeriode;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'atasan']);
        Role::create(['name' => 'pegawai']);

        $admin = User::factory()->create([
            'username' => 'administrator',
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        $admin->assignRole('admin');

        $atasan = User::factory()->create([
            'username' => 'atasan',
            'name' => 'Atasan Langsung',
            'email' => 'atasan@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        $atasan->assignRole('atasan');

        $pegawai = User::factory()->create([
            'username' => '197708162005011002',
            'name' => 'Darmawan',
            'email' => 'darmawan@gmail.com',
            'pegawai_id' => '840',
            'password' => bcrypt('12345678'),
        ]);
        $pegawai->assignRole('atasan');

        $pegawai = User::factory()->create([
            'username' => '199312052019031014',
            'name' => 'Amirul Luthfi',
            'email' => 'amirul@gmail.com',
            'pegawai_id' => '852',
            'password' => bcrypt('12345678'),
        ]);
        $pegawai->assignRole('atasan');

        $pegawai = User::factory()->create([
            'username' => '220199710202306101',
            'name' => 'Eno Marozi',
            'email' => 'eno@gmail.com',
            'pegawai_id' => '3070',
            'password' => bcrypt('12345678'),
        ]);
        $pegawai->assignRole('pegawai');

        SKPPeriode::create([
            'tahun' => 2025,
            'tanggal_mulai' => '2025-01-01',
            'tanggal_selesai' => '2025-12-31',
            'is_active' => '0',
        ]);
    }
}
