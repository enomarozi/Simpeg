<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\AgamaSeeder;
use Database\Seeders\DepartemenSeeder;
use Database\Seeders\FakultasSeeder;
use Database\Seeders\JenisPegawaiSeeder;
use Database\Seeders\KategoriPegawaiSeeder;
use Database\Seeders\KepangkatanSeeder;
use Database\Seeders\PendidikanSeeder;
use Database\Seeders\PegawaiSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'username'=>'administrator',
            'name' => 'Eno Marozi',
            'email' => 'marozieno0@gmail.com',
            'password'=> '12345678',
        ]);

        $this->call(AgamaSeeder::class);
        $this->call(FakultasSeeder::class);
        $this->call(DepartemenSeeder::class);
        $this->call(JenisPegawaiSeeder::class);
        $this->call(KategoriPegawaiSeeder::class);
        $this->call(KepangkatanSeeder::class);
        $this->call(PendidikanSeeder::class);
        $this->call(PegawaiSeeder::class);
    }
}