<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pegawai')->insert([
            [
                'nip' => '197410282008011006',
                'nama' => 'ABDUL KHALIQ',
                'gelar_depan' => '',
                'gelar_belakang' => 'SE., MA',
                'status' => 'AKTIF',
                'jenis_kelamin' => 'L',
                'tempat_lahir' => 'Siluak Panjang',
                'tanggal_lahir' => '1974-10-28',
                'id_agama' => 1,
                'id_kategori_kepegawaian' => 1,
                'id_departemen' => 58,
                'id_kepangkatan' => 1,
            ],
            [
                'nip' => '199510252024061001',
                'nama' => 'ADIB',
                'gelar_depan' => '',
                'gelar_belakang' => 'S.E.,M.E.',
                'status' => 'AKTIF',
                'jenis_kelamin' => 'L',
                'tempat_lahir' => 'Tanah Datar',
                'tanggal_lahir' => '1995-10-25',
                'id_agama' => 1,
                'id_kategori_kepegawaian' => 2,
                'id_departemen' => 61,
                'id_kepangkatan' => 2,
            ],
            [
                'nip' => '198804162019032013',
                'nama' => 'ADILA ADISTI',
                'gelar_depan' => '',
                'gelar_belakang' => 'S.E., M.Ec.ME',
                'status' => 'AKTIF',
                'jenis_kelamin' => 'P',
                'tempat_lahir' => 'Bukittinggi',
                'tanggal_lahir' => '1988-04-16',
                'id_agama' => 1,
                'id_kategori_kepegawaian' => 1,
                'id_departemen' => 59,
                'id_kepangkatan' => 2,
            ],
            [
                'nip' => '199107052019031015',
                'nama' => 'AGRI QISTHI',
                'gelar_depan' => '',
                'gelar_belakang' => 'SE., MM',
                'status' => 'AKTIF',
                'jenis_kelamin' => 'L',
                'tempat_lahir' => 'Bukittinggi',
                'tanggal_lahir' => '1991-07-05',
                'id_agama' => 1,
                'id_kategori_kepegawaian' => 1,
                'id_departemen' => 57,
                'id_kepangkatan' => 2,
            ],
            [
                'nip' => '197508202001121001',
                'nama' => 'ALFITMAN',
                'gelar_depan' => 'Dr.',
                'gelar_belakang' => 'SE. M.Sc',
                'status' => 'AKTIF',
                'jenis_kelamin' => 'L',
                'tempat_lahir' => 'Padang',
                'tanggal_lahir' => '1975-08-20',
                'id_agama' => 1,
                'id_kategori_kepegawaian' => 1,
                'id_departemen' => 62,
                'id_kepangkatan' => 3,
            ],
            [
                'nip' => '199303272006042001',
                'nama' => 'DEVI YULIA RAHMI',
                'gelar_depan' => '',
                'gelar_belakang' => 'S.E., M.Sc',
                'status' => 'AKTIF',
                'jenis_kelamin' => 'P',
                'tempat_lahir' => 'Agam',
                'tanggal_lahir' => '1993-03-27',
                'id_agama' => 1,
                'id_kategori_kepegawaian' => 1,
                'id_departemen' => 58,
                'id_kepangkatan' => 2,
            ]
        ]);
    }
}
