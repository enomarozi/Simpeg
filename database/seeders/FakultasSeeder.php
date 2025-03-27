<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FakultasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('fakultas')->insert([
            [
                'id'=>1,
                'nama_fakultas'=>'Fakultas ISIP'
            ],
            [
                'id'=>2,
                'nama_fakultas'=>'Fakultas Ilmu Budaya',
            ],
            [
                'id'=>3,
                'nama_fakultas'=>'Fakultas MIPA',
            ],
            [
                'id'=>4,
                'nama_fakultas'=>'Fakultas Keperawatan',
            ],
            [
                'id'=>5,
                'nama_fakultas'=>'Fakultas Kedokteran',
            ],
            [
                'id'=>6,
                'nama_fakultas'=>'Sekolah Pascasarjana',
            ],
            [
                'id'=>7,
                'nama_fakultas'=>'Fakultas Farmasi',
            ],
            [
                'id'=>8,
                'nama_fakultas'=>'Fakultas Hukum',
            ],
            [
                'id'=>9,
                'nama_fakultas'=>'Fakultas Pertanian'
            ],
            [
                'id'=>10,
                'nama_fakultas'=>'Fakultas Teknik'
            ],
            [
                'id'=>11,
                'nama_fakultas'=>'Fakultas Ekonomi Dan Bisnis',
            ],
            [
                'id'=>12,
                'nama_fakultas'=>'Fakultas Teknologi Informasi',
            ],
            [
                'id'=>13,
                'nama_fakultas'=>'Fakultas Teknologi Pertanian',
            ],
            [
                'id'=>14,
                'nama_fakultas'=>'Fakultas Peternakan',
            ],
            [
                'id'=>15,
                'nama_fakultas'=>'Fakultas Kedokteran Gigi',
            ],
            [
                'id'=>16,
                'nama_fakultas'=>'Fakultas Kes. Masyarakat',
            ]
        ]);
    }
}
