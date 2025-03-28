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
                'id'=>1,            
                'nama_departemen'=>'S1 SASTRA JEPANG',            
                'id_fakultas'=>2             
            ],
            [            
                'id'=>2,            
                'nama_departemen'=>'S1 SASTRA INGGRIS',            
                'id_fakultas'=>2             
            ],
            [            
                'id'=>3,            
                'nama_departemen'=>'Farmasi',            
                'id_fakultas'=>7             
            ],
            [            
                'id'=>4,            
                'nama_departemen'=>'Hukum Internasional',            
                'id_fakultas'=>8             
            ],
            [            
                'id'=>5,            
                'nama_departemen'=>'Nutrisi dan Teknologi Pakan',            
                'id_fakultas'=>14             
            ],
            [            
                'id'=>6,            
                'nama_departemen'=>'Kebidanan',            
                'id_fakultas'=>5             
            ],
            [            
                'id'=>7,            
                'nama_departemen'=>'Teknologi Industri Pertanian',            
                'id_fakultas'=>9             
            ],
            [            
                'id'=>8,            
                'nama_departemen'=>'Agroekoteknologi',            
                'id_fakultas'=>9             
            ],
            [            
                'id'=>9,            
                'nama_departemen'=>'Anatomi',            
                'id_fakultas'=>5             
            ],
            [            
                'id'=>10,            
                'nama_departemen'=>'Anestesi',            
                'id_fakultas'=>5             
            ],
            [            
                'id'=>11,            
                'nama_departemen'=>'S2 KAJIAN BUDAYA',            
                'id_fakultas'=>2             
            ],
            [            
                'id'=>12,            
                'nama_departemen'=>'Antropologi',            
                'id_fakultas'=>1             
            ],
            [            
                'id'=>13,            
                'nama_departemen'=>'Akuntansi Diploma III',            
                'id_fakultas'=>11             
            ],
            [            
                'id'=>14,            
                'nama_departemen'=>'Informatika',            
                'id_fakultas'=>12             
            ],
            [            
                'id'=>15,            
                'nama_departemen'=>'Manajemen (Kampus 2 Payakumbuh)',       
                'id_fakultas'=>11            
            ],
            [            
                'id'=>16,            
                'nama_departemen'=>'Histologi',            
                'id_fakultas'=>5             
            ],
            [            
                'id'=>17,            
                'nama_departemen'=>'Manajemen (Kampus II Payakumbuh)',         
                'id_fakultas'=>11             
            ],
            [            
                'id'=>18,            
                'nama_departemen'=>'Neurologi ',            
                'id_fakultas'=>5             
            ],
            [            
                'id'=>19,            
                'nama_departemen'=>'Teknologi Pangan dan Hasil Pertanian',     
                'id_fakultas'=>9             
            ],
            [            
                'id'=>20,            
                'nama_departemen'=>'Patologi Klinik dan Ked. Laboratorium',        
                'id_fakultas'=>5             
            ],
            [            
                'id'=>21,            
                'nama_departemen'=>'Hukum Tata Negara',            
                'id_fakultas'=>8             
            ],
            [            
                'id'=>22,            
                'nama_departemen'=>'Lingkungan',            
                'id_fakultas'=>10             
            ],
            [            
                'id'=>23,            
                'nama_departemen'=>'Hukum Pidana',            
                'id_fakultas'=>8             
            ],
            [            
                'id'=>24,            
                'nama_departemen'=>'Pembangunan dan Bisnis Peternakan',        
                'id_fakultas'=>14             
            ],
            [            
                'id'=>25,            
                'nama_departemen'=>'Mikrobiologi',            
                'id_fakultas'=>5             
            ],
            [            
                'id'=>26,            
                'nama_departemen'=>'Ilmu Bedah',            
                'id_fakultas'=>5             
            ],
            [            
                'id'=>27,            
                'nama_departemen'=>'Ekonomi',            
                'id_fakultas'=>11             
            ],
            [            
                'id'=>28,            
                'nama_departemen'=>'Matematika dan Sains Data',            
                'id_fakultas'=>3             
            ],
            [            
                'id'=>29,            
                'nama_departemen'=>'Ilmu Kesehatan Mata',            
                'id_fakultas'=>5             
            ],
            [            
                'id'=>30,            
                'nama_departemen'=>'Ilmu Kesehatan Anak',            
                'id_fakultas'=>5             
            ],
            [            
                'id'=>31,            
                'nama_departemen'=>'Kimia',            
                'id_fakultas'=>3             
            ],
            [            
                'id'=>32,            
                'nama_departemen'=>'Hukum Administrasi Negara',            
                'id_fakultas'=>8             
            ],
            [            
                'id'=>33,            
                'nama_departemen'=>'Kardiologi',            
                'id_fakultas'=>8             
            ],
            [            
                'id'=>34,            
                'nama_departemen'=>'Elektro',            
                'id_fakultas'=>10             
            ],
            [            
                'id'=>35,            
                'nama_departemen'=>'Patologi Klinik',            
                'id_fakultas'=>5             
            ],
            [            
                'id'=>36,            
                'nama_departemen'=>'Sosiologi',            
                'id_fakultas'=>1             
            ],
            [            
                'id'=>37,            
                'nama_departemen'=>'Hukum Perdata ',            
                'id_fakultas'=>8             
            ],
            [            
                'id'=>38,            
                'nama_departemen'=>'Farmakologi',            
                'id_fakultas'=>7             
            ],
            [            
                'id'=>39,            
                'nama_departemen'=>'Fisika',            
                'id_fakultas'=>3             
            ],
            [            
                'id'=>40,            
                'nama_departemen'=>'Pendidikan Kedokteran',            
                'id_fakultas'=>5             
            ],
            [            
                'id'=>41,            
                'nama_departemen'=>'Ilmu Komunikasi',            
                'id_fakultas'=>1             
            ],
            [            
                'id'=>42,            
                'nama_departemen'=>'Industri',            
                'id_fakultas'=>10             
            ],
            [            
                'id'=>43,            
                'nama_departemen'=>'Teknik Pertanian dan Biosistem',           
                'id_fakultas'=>13             
            ],
            [            
                'id'=>44,            
                'nama_departemen'=>'THT-KL',            
                'id_fakultas'=>5             
            ],
            [            
                'id'=>45,            
                'nama_departemen'=>'S1 SASTRA INDONESIA',            
                'id_fakultas'=>2            
            ],
            [            
                'id'=>46,            
                'nama_departemen'=>'Kardiologi ',            
                'id_fakultas'=>5             
            ],
            [            
                'id'=>47,            
                'nama_departemen'=>'Sipil',            
                'id_fakultas'=>10             
            ],
            [            
                'id'=>48,            
                'nama_departemen'=>'Ilmu Tanah Dan Sumberdaya Lahan',          
                'id_fakultas'=>9             
            ],
            [            
                'id'=>49,            
                'nama_departemen'=>'Program Diploma III',            
                'id_fakultas'=>11             
            ],
            [            
                'id'=>50,            
                'nama_departemen'=>'Arsitektur',            
                'id_fakultas'=>10             
            ],
            [            
                'id'=>51,            
                'nama_departemen'=>'Akuntansi',            
                'id_fakultas'=>11             
            ],
            [            
                'id'=>52,            
                'nama_departemen'=>'Prodi S1 & Profesi Kedokteran Gigi',       
                'id_fakultas'=>15             
            ],
            [            
                'id'=>53,            
                'nama_departemen'=>'Ekonomi (Kampus 2 Payakumbuh)',            
                'id_fakultas'=>11            
            ],
            [            
                'id'=>54,            
                'nama_departemen'=>'Gizi',            
                'id_fakultas'=>16             
            ],
            [            
                'id'=>55,            
                'nama_departemen'=>'Manajemen',            
                'id_fakultas'=>11             
            ],
            [            
                'id'=>56,            
                'nama_departemen'=>'Parasitologi',            
                'id_fakultas'=>5             
            ],
            [            
                'id'=>57,            
                'nama_departemen'=>'Dermatologi, Venereologi dan Estetika',
                'id_fakultas'=>5             
            ],
            [            
                'id'=>58,            
                'nama_departemen'=>'Biokimia',            
                'id_fakultas'=>5             
            ],
            [            
                'id'=>59,            
                'nama_departemen'=>'Hubungan Internasional',            
                'id_fakultas'=>1             
            ],
            [            
                'id'=>60,            
                'nama_departemen'=>'Obgyn',            
                'id_fakultas'=>5             
            ],
            [            
                'id'=>61,            
                'nama_departemen'=>'S1 SEJARAH',            
                'id_fakultas'=>2             
            ],
            [            
                'id'=>62,            
                'nama_departemen'=>'Ilmu Penyakit Dalam',            
                'id_fakultas'=>5             
            ],
            [            
                'id'=>63,            
                'nama_departemen'=>'Psikologi',            
                'id_fakultas'=>5             
            ],
            [            
                'id'=>64,            
                'nama_departemen'=>'Sistem Informasi',            
                'id_fakultas'=>12             
            ],
            [            
                'id'=>65,            
                'nama_departemen'=>'S2 KAJIAN SEJARAH',            
                'id_fakultas'=>2             
            ],
            [            
                'id'=>66,            
                'nama_departemen'=>'Ilmu Politik',            
                'id_fakultas'=>1             
            ],
            [            
                'id'=>67,            
                'nama_departemen'=>'Teknologi Produksi Ternak',            
                'id_fakultas'=>14             
            ],
            [            
                'id'=>68,            
                'nama_departemen'=>'Teknik Komputer',            
                'id_fakultas'=>12            
            ],
            [            
                'id'=>69,            
                'nama_departemen'=>'Ilmu Kesehatan Masyarakat',            
                'id_fakultas'=>16             
            ],
            [            
                'id'=>70,            
                'nama_departemen'=>'Patologi Anatomi',            
                'id_fakultas'=>5             
            ],
            [            
                'id'=>71,            
                'nama_departemen'=>'S2 SUSASTRA',            
                'id_fakultas'=>2             
            ],
            [            
                'id'=>72,            
                'nama_departemen'=>'Prodi S1 Biomedis',            
                'id_fakultas'=>5             
            ],
            [            
                'id'=>73,            
                'nama_departemen'=>'Agronomi',            
                'id_fakultas'=>9             
            ],
            [            
                'id'=>74,            
                'nama_departemen'=>'Radiologi',            
                'id_fakultas'=>5             
            ],
            [            
                'id'=>75,            
                'nama_departemen'=>'Fisiologi',            
                'id_fakultas'=>5             
            ],
            [            
                'id'=>76,            
                'nama_departemen'=>'S1 SASTRA MINANGKABAU',            
                'id_fakultas'=>2             
            ],
            [            
                'id'=>77,            
                'nama_departemen'=>'IKM-KK',            
                'id_fakultas'=>5             
            ],
            [            
                'id'=>78,            
                'nama_departemen'=>'Psikiatri',            
                'id_fakultas'=>5             
            ],
            [            
                'id'=>79,            
                'nama_departemen'=>'Administrasi Publik',            
                'id_fakultas'=>1            
            ],
            [            
                'id'=>80,            
                'nama_departemen'=>'Mesin',            
                'id_fakultas'=>10             
            ],
            [            
                'id'=>81,            
                'nama_departemen'=>'Pulmunologi',            
                'id_fakultas'=>5             
            ],
            [            
                'id'=>82,            
                'nama_departemen'=>'Profesi Apoteker',            
                'id_fakultas'=>7             
            ],
            [            
                'id'=>83,            
                'nama_departemen'=>'Keperawatan',            
                'id_fakultas'=>4             
            ],
            [            
                'id'=>84,            
                'nama_departemen'=>'Proteksi Tanaman',            
                'id_fakultas'=>9             
            ],
            [            
                'id'=>85,            
                'nama_departemen'=>'Sosial Ekonomi Pertanian',            
                'id_fakultas'=>9             
            ],
            [            
                'id'=>86,            
                'nama_departemen'=>'S2 LINGUISTIK',            
                'id_fakultas'=>2             
            ],
            [            
                'id'=>87,            
                'nama_departemen'=>'Biologi',            
                'id_fakultas'=>3             
            ],
            [            
                'id'=>88,            
                'nama_departemen'=>'Forensik',            
                'id_fakultas'=>5             
            ],
            [            
                'id'=>89,            
                'nama_departemen'=>'Hukum Perdata',            
                'id_fakultas'=>8             
            ],
            [            
                'id'=>90,            
                'nama_departemen'=>'Ilmu Gizi',            
                'id_fakultas'=>5             
            ],
            [            
                'id'=>91,            
                'nama_departemen'=>'Teknologi Pengolahan Hasil Ternak',        
                'id_fakultas'=>14             
            ],
        ]);
    }
}
