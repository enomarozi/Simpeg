<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'pegawai']);
        Role::create(['name' => 'atasan']);

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
            'username' => '199312052019031014',
            'name' => 'Amirul Luthfi',
            'email' => 'amirul@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        $pegawai->assignRole('atasan');

        $pegawai = User::factory()->create([
            'username' => '220199710202306101',
            'name' => 'Eno Marozi',
            'email' => 'eno@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        $pegawai->assignRole('pegawai');
    }
}
