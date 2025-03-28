<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisPegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jenis_kepegawaian')->insert([
            [   
                'nama_jenis_kepegawaian'=>'Tendik',
            ],
            [   
                'nama_jenis_kepegawaian'=>'Dosen',
            ],
            [   
                'nama_jenis_kepegawaian'=>'Lainnya',
            ],
        ]);
    }
}
