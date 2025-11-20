<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KewargaNegaraanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pegawai_kewarganegaraan')->insert([
            ['kewarganegaraan'=>'WNI'],
            ['kewarganegaraan'=>'WNA'],
        ]);
    }
}
