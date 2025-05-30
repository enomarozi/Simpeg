<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusPerkawinanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pegawai_status_perkawinan')->insert([
            ['status'=>'Belum Kawin'],
            ['status'=>'Kawin'],
            ['status'=>'Cerai Hidup'],
            ['status'=>'Cerai Mati'],
        ]);
    }
}
