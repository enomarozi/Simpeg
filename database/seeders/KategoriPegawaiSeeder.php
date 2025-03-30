<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriPegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kategori_kepegawaian')->insert([
            [   
                'nama_kategori_kepegawaian'=>'PNS'
            ],
            [   
                'nama_kategori_kepegawaian'=>'CPNS'
            ],
            [   
                'nama_kategori_kepegawaian'=>'PT'
            ],
            [
                'nama_kategori_kepegawaian'=>'PTT'
            ],
            [
                'nama_kategori_kepegawaian'=>'Lainnya'
            ],
        ]);
    }
}
