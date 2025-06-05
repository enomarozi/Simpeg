<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PegawaiJabatan extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pegawai_jabatan')->insert([
            ['nama'=>'Dosen'],
            ['nama'=>'Tenaga Kependidikan'],
        ]);
    }
}
