<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusPerkawinanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pegawai_perkawinan')->insert([
            ['nama'=>'Belum Kawin'],
            ['nama'=>'Kawin'],
            ['nama'=>'Cerai Hidup'],
            ['nama'=>'Cerai Mati'],
        ]);
    }
}
