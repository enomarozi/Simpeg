<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PendidikanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pendidikan')->insert([
            ['jenjang' => 'SD'],
            ['jenjang' => 'SMP'],
            ['jenjang' => 'SMA'],
            ['jenjang' => 'D3'],
            ['jenjang' => 'S1'],
            ['jenjang' => 'S2'],
            ['jenjang' => 'S3'],
        ]);
    }
}
