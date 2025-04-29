<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KepangkatanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pegawai_kepangkatan')->insert([
            ['pangkat' => 'Pengatur Muda', 'golongan' => 'I/a'],
            ['pangkat' => 'Pengatur Muda Tingkat I', 'golongan' => 'I/b'],
            ['pangkat' => 'Pengatur', 'golongan' => 'I/c'],
            ['pangkat' => 'Pengatur Tingkat I', 'golongan' => 'I/d'],
            ['pangkat' => 'Penata Muda', 'golongan' => 'II/a'],
            ['pangkat' => 'Penata Muda Tingkat I', 'golongan' => 'II/b'],
            ['pangkat' => 'Penata', 'golongan' => 'II/c'],
            ['pangkat' => 'Penata Tingkat I', 'golongan' => 'II/d'],
            ['pangkat' => 'Penata Tk. I', 'golongan' => 'III/a'],
            ['pangkat' => 'Penata Muda', 'golongan' => 'III/b'],
            ['pangkat' => 'Penata Muda Tingkat I', 'golongan' => 'III/c'],
            ['pangkat' => 'Penata', 'golongan' => 'III/d'],
            ['pangkat' => 'Penata Tingkat I', 'golongan' => 'III/e'],
            ['pangkat' => 'Pembina', 'golongan' => 'IV/a'],
            ['pangkat' => 'Pembina Tingkat I', 'golongan' => 'IV/b'],
            ['pangkat' => 'Pembina Utama Muda', 'golongan' => 'IV/c'],
            ['pangkat' => 'Pembina Utama Madya', 'golongan' => 'IV/d'],
            ['pangkat' => 'Pembina Utama', 'golongan' => 'IV/e'],
        ]);
    }
}
