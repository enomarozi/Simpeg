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
        DB::table('pegawai_departemen')->insert([
            [
                'nama_departemen' => 'Sosiologi',            
                'fakultas_id' => 1
            ],
            [
                'nama_departemen' => 'Antropologi',            
                'fakultas_id' => 1
            ],
            [
                'nama_departemen' => 'Hubungan Internasional',            
                'fakultas_id' => 1
            ],
            [
                'nama_departemen' => 'Ilmu Politik',            
                'fakultas_id' => 1
            ],
            [
                'nama_departemen' => 'Administrasi Publik',            
                'fakultas_id' => 1
            ],
            [
                'nama_departemen' => 'S1 SASTRA JEPANG',            
                'fakultas_id' => 2
            ],
            [
                'nama_departemen' => 'S1 SASTRA INGGRIS',            
                'fakultas_id' => 2
            ],
            [
                'nama_departemen' => 'S2 KAJIAN BUDAYA',            
                'fakultas_id' => 2
            ],
            [
                'nama_departemen' => 'S1 SEJARAH',            
                'fakultas_id' => 2
            ],
            [
                'nama_departemen' => 'S2 SUSASTRA',            
                'fakultas_id' => 2
            ],
            [
                'nama_departemen' => 'S1 SASTRA MINANGKABAU',            
                'fakultas_id' => 2
            ],
            [
                'nama_departemen' => 'S2 LINGUISTIK',            
                'fakultas_id' => 2
            ],
            [
                'nama_departemen' => 'Biologi',            
                'fakultas_id' => 3
            ],
            [
                'nama_departemen' => 'Fisika',            
                'fakultas_id' => 3
            ],
            [
                'nama_departemen' => 'Matematika dan Sains Data',            
                'fakultas_id' => 3
            ],
            [
                'nama_departemen' => 'Kimia',            
                'fakultas_id' => 3
            ],
            [
                'nama_departemen' => 'Keperawatan',            
                'fakultas_id' => 4
            ],
            [
                'nama_departemen' => 'Psikologi',            
                'fakultas_id' => 5
            ],
            [
                'nama_departemen' => 'Anatomi',            
                'fakultas_id' => 5
            ],
            [
                'nama_departemen' => 'Anestesi',            
                'fakultas_id' => 5
            ],
            [
                'nama_departemen' => 'Neurologi',            
                'fakultas_id' => 5
            ],
            [
                'nama_departemen' => 'Patologi Klinik dan Ked. Laboratorium',            
                'fakultas_id' => 5
            ],
            [
                'nama_departemen' => 'Histologi',            
                'fakultas_id' => 5
            ],
            [
                'nama_departemen' => 'Kardiologi',            
                'fakultas_id' => 5
            ],
            [
                'nama_departemen' => 'Farmakologi',            
                'fakultas_id' => 5
            ],
            [
                'nama_departemen' => 'Profesi Apoteker',            
                'fakultas_id' => 5
            ],
            [
                'nama_departemen' => 'Farmasi',            
                'fakultas_id' => 5
            ],
            [
                'nama_departemen' => 'Mikrobiologi',            
                'fakultas_id' => 5
            ],
            [
                'nama_departemen' => 'Ilmu Bedah',            
                'fakultas_id' => 5
            ],
            [
                'nama_departemen' => 'Biokimia',            
                'fakultas_id' => 5
            ],
            [
                'nama_departemen' => 'Fisiologi',            
                'fakultas_id' => 5
            ],
            [
                'nama_departemen' => 'Radiologi',            
                'fakultas_id' => 5
            ],
            [
                'nama_departemen' => 'Forensik',            
                'fakultas_id' => 5
            ],
            [
                'nama_departemen' => 'Dermatologi, Venereologi dan Estetika',            
                'fakultas_id' => 5
            ],
            [
                'nama_departemen' => 'Ilmu Kesehatan Anak',            
                'fakultas_id' => 5
            ],
            [
                'nama_departemen' => 'Ilmu Kesehatan Mata',            
                'fakultas_id' => 5
            ],
            [
                'nama_departemen' => 'Farmakologi',            
                'fakultas_id' => 7
            ],
            [
                'nama_departemen' => 'Profesi Apoteker',            
                'fakultas_id' => 7
            ],
            [
                'nama_departemen' => 'Farmasi',            
                'fakultas_id' => 7
            ],
            [
                'nama_departemen' => 'Hukum Tata Negara',            
                'fakultas_id' => 8
            ],
            [
                'nama_departemen' => 'Hukum Pidana',            
                'fakultas_id' => 8
            ],
            [
                'nama_departemen' => 'Hukum Perdata',            
                'fakultas_id' => 8
            ],
            [
                'nama_departemen' => 'Hukum Administrasi Negara',            
                'fakultas_id' => 8
            ],
            [
                'nama_departemen' => 'Kardiologi',            
                'fakultas_id' => 8
            ],
            [
                'nama_departemen' => 'Hukum Internasional',            
                'fakultas_id' => 8
            ],
            [
                'nama_departemen' => 'Teknologi Pertanian dan Biosistem',            
                'fakultas_id' => 9
            ],
            [
                'nama_departemen' => 'Pembangunan dan Bisnis Peternakan',            
                'fakultas_id' => 9
            ],
            [
                'nama_departemen' => 'Teknologi Pangan dan Hasil Pertanian',            
                'fakultas_id' => 9
            ],
            [
                'nama_departemen' => 'Agroekoteknologi',            
                'fakultas_id' => 9
            ],
            [
                'nama_departemen' => 'Proteksi Tanaman',            
                'fakultas_id' => 9
            ],
            [
                'nama_departemen' => 'Sosial Ekonomi Pertanian',            
                'fakultas_id' => 9
            ],
            [
                'nama_departemen' => 'Ilmu Tanah Dan Sumberdaya Lahan',            
                'fakultas_id' => 9
            ],
            [
                'nama_departemen' => 'Industri',            
                'fakultas_id' => 10
            ],
            [
                'nama_departemen' => 'Elektro',            
                'fakultas_id' => 10
            ],
            [
                'nama_departemen' => 'Sipil',            
                'fakultas_id' => 10
            ],
            [
                'nama_departemen' => 'Mesin',            
                'fakultas_id' => 10
            ],
            [
                'nama_departemen' => 'Lingkungan',            
                'fakultas_id' => 10
            ],
            [
                'nama_departemen' => 'Arsitektur',            
                'fakultas_id' => 10
            ],
            [
                'nama_departemen' => 'Manajemen',            
                'fakultas_id' => 11
            ],
            [
                'nama_departemen' => 'Ekonomi',            
                'fakultas_id' => 11
            ],
            [
                'nama_departemen' => 'Akuntansi',            
                'fakultas_id' => 11
            ],
            [
                'nama_departemen' => 'Program Diploma III',            
                'fakultas_id' => 11
            ],
            [
                'nama_departemen' => 'Ekonomi (Kampus 2 Payakumbuh)',            
                'fakultas_id' => 11
            ],
            [
                'nama_departemen' => 'Manajemen (Kampus 2 Payakumbuh)',            
                'fakultas_id' => 11
            ],
            [
                'nama_departemen' => 'Akuntansi Diploma III',            
                'fakultas_id' => 11
            ],
            [
                'nama_departemen' => 'Sistem Informasi',            
                'fakultas_id' => 12
            ],
            [
                'nama_departemen' => 'Informatika',            
                'fakultas_id' => 12
            ],
            [
                'nama_departemen' => 'Teknik Komputer',            
                'fakultas_id' => 12
            ],

            [
                'nama_departemen' => 'Teknologi Pertanian dan Biosistem',            
                'fakultas_id' => 13
            ],
            [
                'nama_departemen' => 'Pembangunan dan Bisnis Peternakan',            
                'fakultas_id' => 14
            ],
            [
                'nama_departemen' => 'Teknologi Produksi Ternak',            
                'fakultas_id' => 14
            ],
            [
                'nama_departemen' => 'Prodi S1 & Profesi Kedokteran Gigi',            
                'fakultas_id' => 15
            ],
            [
                'nama_departemen' => 'Ilmu Kesehatan Masyarakat',            
                'fakultas_id' => 16
            ],
            [
                'nama_departemen' => 'Gizi',            
                'fakultas_id' => 16
            ]
        ]);
    }
}
