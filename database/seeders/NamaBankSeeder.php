<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NamaBankSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pegawai_nama_banks')->insert([
            ['nama'=>'BCA'],
            ['nama'=>'BNI'],
            ['nama'=>'BRI'],
            ['nama'=>'BSI'],
            ['nama'=>'BTN'],
            ['nama'=>'Mandiri'],
            ['nama'=>'Nagari'],
        ]);
    }
}
