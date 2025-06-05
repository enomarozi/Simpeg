<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FakultasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pegawai_fakultas')->insert([
            [
                'nama_fakultas'=>'Fakultas ISIP'
            ],
            [
                'nama_fakultas'=>'Fakultas Ilmu Budaya',
            ],
            [
                'nama_fakultas'=>'Fakultas MIPA',
            ],
            [
                'nama_fakultas'=>'Fakultas Keperawatan',
            ],
            [
                'nama_fakultas'=>'Fakultas Kedokteran',
            ],
            [
                'nama_fakultas'=>'Sekolah Pascasarjana',
            ],
            [
                'nama_fakultas'=>'Fakultas Farmasi',
            ],
            [
                'nama_fakultas'=>'Fakultas Hukum',
            ],
            [
                'nama_fakultas'=>'Fakultas Pertanian'
            ],
            [
                'nama_fakultas'=>'Fakultas Teknik'
            ],
            [
                'nama_fakultas'=>'Fakultas Ekonomi Dan Bisnis',
            ],
            [
                'nama_fakultas'=>'Fakultas Teknologi Informasi',
            ],
            [
                'nama_fakultas'=>'Fakultas Teknologi Pertanian',
            ],
            [
                'nama_fakultas'=>'Fakultas Peternakan',
            ],
            [
                'nama_fakultas'=>'Fakultas Kedokteran Gigi',
            ],
            [
                'nama_fakultas'=>'Fakultas Kes. Masyarakat',
            ],
            [
                'nama_fakultas'=>'Rumah Sakit UNAND',
            ],
            [
                'nama_fakultas'=>'Rektorat',
            ],
        ]);
    }
}
