<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartemenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('departemen')->insert([
            [
                'nama_departemen' => 'Sosiologi',            
                'id_fakultas' => 1
            ],
            [
                'nama_departemen' => 'Antropologi',            
                'id_fakultas' => 1
            ],
            [
                'nama_departemen' => 'Hubungan Internasional',            
                'id_fakultas' => 1
            ],
            [
                'nama_departemen' => 'Ilmu Politik',            
                'id_fakultas' => 1
            ],
            [
                'nama_departemen' => 'Administrasi Publik',            
                'id_fakultas' => 1
            ],
            [
                'nama_departemen' => 'S1 SASTRA JEPANG',            
                'id_fakultas' => 2
            ],
            [
                'nama_departemen' => 'S1 SASTRA INGGRIS',            
                'id_fakultas' => 2
            ],
            [
                'nama_departemen' => 'S2 KAJIAN BUDAYA',            
                'id_fakultas' => 2
            ],
            [
                'nama_departemen' => 'S1 SEJARAH',            
                'id_fakultas' => 2
            ],
            [
                'nama_departemen' => 'S2 SUSASTRA',            
                'id_fakultas' => 2
            ],
            [
                'nama_departemen' => 'S1 SASTRA MINANGKABAU',            
                'id_fakultas' => 2
            ],
            [
                'nama_departemen' => 'S2 LINGUISTIK',            
                'id_fakultas' => 2
            ],
            [
                'nama_departemen' => 'Biologi',            
                'id_fakultas' => 3
            ],
            [
                'nama_departemen' => 'Fisika',            
                'id_fakultas' => 3
            ],
            [
                'nama_departemen' => 'Matematika dan Sains Data',            
                'id_fakultas' => 3
            ],
            [
                'nama_departemen' => 'Kimia',            
                'id_fakultas' => 3
            ],
            [
                'nama_departemen' => 'Keperawatan',            
                'id_fakultas' => 4
            ],
            [
                'nama_departemen' => 'Psikologi',            
                'id_fakultas' => 5
            ],
            [
                'nama_departemen' => 'Anatomi',            
                'id_fakultas' => 5
            ],
            [
                'nama_departemen' => 'Anestesi',            
                'id_fakultas' => 5
            ],
            [
                'nama_departemen' => 'Neurologi',            
                'id_fakultas' => 5
            ],
            [
                'nama_departemen' => 'Patologi Klinik dan Ked. Laboratorium',            
                'id_fakultas' => 5
            ],
            [
                'nama_departemen' => 'Histologi',            
                'id_fakultas' => 5
            ],
            [
                'nama_departemen' => 'Kardiologi',            
                'id_fakultas' => 5
            ],
            [
                'nama_departemen' => 'Farmakologi',            
                'id_fakultas' => 5
            ],
            [
                'nama_departemen' => 'Profesi Apoteker',            
                'id_fakultas' => 5
            ],
            [
                'nama_departemen' => 'Farmasi',            
                'id_fakultas' => 5
            ],
            [
                'nama_departemen' => 'Mikrobiologi',            
                'id_fakultas' => 5
            ],
            [
                'nama_departemen' => 'Ilmu Bedah',            
                'id_fakultas' => 5
            ],
            [
                'nama_departemen' => 'Biokimia',            
                'id_fakultas' => 5
            ],
            [
                'nama_departemen' => 'Fisiologi',            
                'id_fakultas' => 5
            ],
            [
                'nama_departemen' => 'Radiologi',            
                'id_fakultas' => 5
            ],
            [
                'nama_departemen' => 'Forensik',            
                'id_fakultas' => 5
            ],
            [
                'nama_departemen' => 'Dermatologi, Venereologi dan Estetika',            
                'id_fakultas' => 5
            ],
            [
                'nama_departemen' => 'Ilmu Kesehatan Anak',            
                'id_fakultas' => 5
            ],
            [
                'nama_departemen' => 'Ilmu Kesehatan Mata',            
                'id_fakultas' => 5
            ],
            [
                'nama_departemen' => 'Farmakologi',            
                'id_fakultas' => 7
            ],
            [
                'nama_departemen' => 'Profesi Apoteker',            
                'id_fakultas' => 7
            ],
            [
                'nama_departemen' => 'Farmasi',            
                'id_fakultas' => 7
            ],
            [
                'nama_departemen' => 'Hukum Tata Negara',            
                'id_fakultas' => 8
            ],
            [
                'nama_departemen' => 'Hukum Pidana',            
                'id_fakultas' => 8
            ],
            [
                'nama_departemen' => 'Hukum Perdata',            
                'id_fakultas' => 8
            ],
            [
                'nama_departemen' => 'Hukum Administrasi Negara',            
                'id_fakultas' => 8
            ],
            [
                'nama_departemen' => 'Kardiologi',            
                'id_fakultas' => 8
            ],
            [
                'nama_departemen' => 'Hukum Internasional',            
                'id_fakultas' => 8
            ],
            [
                'nama_departemen' => 'Teknologi Pertanian dan Biosistem',            
                'id_fakultas' => 9
            ],
            [
                'nama_departemen' => 'Pembangunan dan Bisnis Peternakan',            
                'id_fakultas' => 9
            ],
            [
                'nama_departemen' => 'Teknologi Pangan dan Hasil Pertanian',            
                'id_fakultas' => 9
            ],
            [
                'nama_departemen' => 'Agroekoteknologi',            
                'id_fakultas' => 9
            ],
            [
                'nama_departemen' => 'Proteksi Tanaman',            
                'id_fakultas' => 9
            ],
            [
                'nama_departemen' => 'Sosial Ekonomi Pertanian',            
                'id_fakultas' => 9
            ],
            [
                'nama_departemen' => 'Ilmu Tanah Dan Sumberdaya Lahan',            
                'id_fakultas' => 9
            ],
            [
                'nama_departemen' => 'Industri',            
                'id_fakultas' => 10
            ],
            [
                'nama_departemen' => 'Elektro',            
                'id_fakultas' => 10
            ],
            [
                'nama_departemen' => 'Sipil',            
                'id_fakultas' => 10
            ],
            [
                'nama_departemen' => 'Arsitektur',            
                'id_fakultas' => 10
            ],
            [
                'nama_departemen' => 'Manajemen',            
                'id_fakultas' => 11
            ],
            [
                'nama_departemen' => 'Ekonomi',            
                'id_fakultas' => 11
            ],
            [
                'nama_departemen' => 'Akuntansi',            
                'id_fakultas' => 11
            ],
            [
                'nama_departemen' => 'Program Diploma III',            
                'id_fakultas' => 11
            ],
            [
                'nama_departemen' => 'Ekonomi (Kampus 2 Payakumbuh)',            
                'id_fakultas' => 11
            ],
            [
                'nama_departemen' => 'Manajemen (Kampus 2 Payakumbuh)',            
                'id_fakultas' => 11
            ],
            [
                'nama_departemen' => 'Sistem Informasi',            
                'id_fakultas' => 12
            ],
            [
                'nama_departemen' => 'Informatika',            
                'id_fakultas' => 12
            ],
            [
                'nama_departemen' => 'Teknik Komputer',            
                'id_fakultas' => 12
            ],

            [
                'nama_departemen' => 'Teknologi Pertanian dan Biosistem',            
                'id_fakultas' => 13
            ],
            [
                'nama_departemen' => 'Pembangunan dan Bisnis Peternakan',            
                'id_fakultas' => 14
            ],
            [
                'nama_departemen' => 'Teknologi Produksi Ternak',            
                'id_fakultas' => 14
            ],
            [
                'nama_departemen' => 'Prodi S1 & Profesi Kedokteran Gigi',            
                'id_fakultas' => 15
            ],
            [
                'nama_departemen' => 'Ilmu Kesehatan Masyarakat',            
                'id_fakultas' => 16
            ],
            [
                'nama_departemen' => 'Gizi',            
                'id_fakultas' => 16
            ]
        ]);
    }
}
