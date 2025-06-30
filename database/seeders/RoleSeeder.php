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
        Role::create(['name' => 'atasan_langsung']);

        $admin = User::factory()->create([
            'username' => 'administrator',
            'name' => 'Eno Marozi',
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
        $atasan->assignRole('atasan_langsung');

        $pegawai = User::factory()->create([
            'username' => 'pegawai',
            'name' => 'Pegawai SKP',
            'email' => 'pegawai@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        $pegawai->assignRole('pegawai');
    }
}
