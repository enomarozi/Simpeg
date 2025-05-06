<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JabatanDosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pegawai_jabatan_dosen')->insert([
            ['nama_jabatan'=>'Asisten Ahli'],
            ['nama_jabatan'=>'Guru Besar'],
            ['nama_jabatan'=>'Lektor'],
            ['nama_jabatan'=>'Lektor Kepala'],
            ['nama_jabatan'=>'Belum Fungsional'],
        ]);
    }
}
