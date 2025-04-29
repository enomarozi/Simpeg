<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GolonganDarahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $golonganDarahList = ['A', 'B', 'AB', 'O'];

        foreach ($golonganDarahList as $golongan) {
            DB::table('pegawai_golongan_darah')->insert([
                'golongan_darah' => $golongan,
            ]);
        }
    }
}
