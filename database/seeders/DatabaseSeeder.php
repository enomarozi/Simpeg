<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\{
                    AgamaSeeder, DepartemenSeeder, FakultasSeeder,
                    JenisPegawaiSeeder, KategoriPegawaiSeeder, KepangkatanSeeder,
                    PendidikanSeeder, PegawaiDosenAll, PegawaiTendikAll, StatusPerkawinanSeeder,
                    GolonganDarahSeeder, NegaraSeeder, KewargaNegaraanSeeder,
                    JabatanDosenSeeder, PegawaiJabatan, JabatanTendikSeeder,
                    };
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(AgamaSeeder::class);
        $this->call(FakultasSeeder::class);
        $this->call(DepartemenSeeder::class);
        $this->call(JenisPegawaiSeeder::class);
        $this->call(JabatanDosenSeeder::class);
        $this->call(JabatanTendikSeeder::class);
        $this->call(KategoriPegawaiSeeder::class);
        $this->call(KepangkatanSeeder::class);
        $this->call(PendidikanSeeder::class);
        $this->call(PegawaiDosenAll::class);
        $this->call(PegawaiJabatan::class);
        $this->call(PegawaiTendikAll::class);
        $this->call(StatusPerkawinanSeeder::class);
        $this->call(GolonganDarahSeeder::class);
        $this->call(NegaraSeeder::class);
        $this->call(KewargaNegaraanSeeder::class);
        $this->call(RoleSeeder::class);
    }
}