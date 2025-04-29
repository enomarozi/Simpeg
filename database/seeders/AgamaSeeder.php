<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgamaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pegawai_agama')->insert([
            ['nama'=>'Islam'],
            ['nama'=>'Kristen Protestan'],
            ['nama'=>'Kristen Katolik'],
            ['nama'=>'Hindu'],
            ['nama'=>'Buddha'],
            ['nama'=>'Konghucu'],
        ]);
    }
}
