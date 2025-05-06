<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JabatanTendikSeeder extends Seeder
{
    public function run()
    {
        $jabatans = [
            'Pengadministrasi Sarana dan Prasarana', 'Pramu Bakti', 'Pengemudi', 'Pengelola Barang Milik Negara', 
            'Pengelola Informasi Akademik', 'Pustakawan Ahli Muda', 'Pengembang Teknologi Pembelajaran Ahli Pertama',
            'Pengelola Keuangan', 'Pengadministrasi Akademik', 'Kepala Seksi Keuangan dan Aset FEB Universitas Andalas',
            'Analis Sumbar Daya Manusia Aparatur Ahli Madya', 'Pengadministrasi Akademik Kampus II Payakumbuh',
            'Keamanan', 'Tenaga Kebersihan Kampus II Payakumbuh', 'Pengadministrasian Akademik dan Kemahasiswaan Kampus II Payakumbuh',
            'Pengadministrasi Akademik Program Magister dan Doktor', 'Pengadministrasi Akademik Program Ekonomi Islam',
            'Pengadministrasi pada Bagian Akademik', 'Pengadministrasi pada Kampus II Payakumbuh', 'Teknisi',
            'Pengadministrasi Pustaka', 'Pengadministrasi', 'Pelaksana', 'PLP Penyelia', 'PLP Ahli Muda',
            'Pranata Komputer Ahli Muda', 'Arsiparis Pelaksana Lanjutan', 'Analis Sumber Daya Manusia Aparatur',
            'Kepala Seksi Keuangan dan Aset', 'Pengolah Data', 'Sekretaris Pimpinan', 'Pengadministrasi Kepegawaian',
            'Pengadministrasi Umum', 'Pustakawan Muda', 'Kepala Seksi Administrasi Umum', 'Kepala Seksi Aset dan Keuangan',
            'Pengadministrasian Akademik', 'Staf Administrasi Ruang baca', 'Pustakawan Mahir', 'Tenaga Pramusaji dan Pengadministrasian Umum',
            'Pengadministrasian', 'Pengadministrasi', 'Pengadministrasian Umum dan Sopir Operasional', 'Kepala Kantor Sekretariat',
            'Kepala Seksi Keuangan dan Aset', 'Kepala Seksi Administrasi Umum', 'Pengembang Teknologi Pembelajaran Pertama',
            'Perawat Gigi', 'Perekam Medis Pelaksana Lanjutan/Mahir', 'Perawat Gigi Mahir', 'Supir Dekan',
            'Pengadministrasi Persuratan', 'Pengadministrasi Kemahasiswaan dan Alumni', 'Teknisi RSGM', 'Perawat OK',
            'Perawat Umum', 'staf CSSD (Central Sterile Supply Department)', 'staf Apoteker', 'staf Radiografer',
            'staf Kesehatan Lingkungan', 'Dokter Umum', 'Staf K3RS', 'Pengadministrasi Kerumahtanggan', 'Staf Gizi',
            'Staf Bidan', 'Staf Radiologi', 'Staf Analis Kesehatan', 'Security', 'Asisten Apoteker Terampil',
            'Perekam Medis Terampil', 'Terapis Gigi dan Mulut Terampil', 'Bidan Terampil', 'Dokter Gigi Ahli Pertama',
            'Perawat Ahli Pertama', 'Apoteker Ahli Pertama', 'Teknisi Gigi Terampil', 'Teknis Gigi Terampil',
            'Penata Anestesi Ahli Pertama', 'Pranata Laboratorium Kesehatan Terampil', 'Analis Kepegawaian Ahli Muda',
            'PLP Ahli Madya', 'Perawat Pelaksana Lanjutan/Mahir', 'Perawat Pelaksana Lanjutan', 'Analis/Laboran',
            'Petugas Lapangan', 'Driver', 'Perawat Terampil', 'Teknisi Laboratorium', 'Penata Usaha Pimpinan',
            'Tenaga IT', 'Sekretariat', 'Kasi Keuangan dan Aset', 'Pengadministrasi Kepegawaian', 'Pengadministrasi Akademik dan Kemahasiswaan',
            'Pengadministrasi Umum Barang dan Jasa', 'Pengadministrasi Akademik S2 Epid', 'Pengadministrasi Akademik S1 Kesmas',
            'Laboran S1 Gizi', 'Pengadministrasi Akademik S1 Gizi', 'Pengadministrasi Persedian Barang dan E-Office',
            'Sopir Operasional', 'APKAPBN', 'PLP MADYA', 'PELAKSANA', 'Pranata Laboratorium Pendidikan', 
            'Persuratan', 'Pengelola Data Akademik', 'Bendahara Pengeluaran UKPA', 'Pengelola Kepegawaian',
            'Teknisi Laboratorium Fisika', 'Tenaga Teknisi Informasi Teknologi', 'Pengadminstrasi Kemahasiswaan S1',
            'Pengadminstrasi Akademik Departemen Matematika', 'Analis Laboratorium Dep. Biologi', 'Teknisi',
            'Pengelola Media Sosial', 'Pengadministrasi Departemen Biologi', 'Analis Departemen Biologi',
            'Pengelola Data Akademik (Kampus II Payakumbuh)', 'Pengadministrasi Akademik (Ruang Baca)', 
            'Laboran Komputerisasi', 'Pelaksana (Pengelola Keuangan)', 'Petugas Kandang', 'Penata Usaha Pimpinan / Resepsionis',
            'Pranata Laboratorium Pendidikan Madya', 'Staff Data, Informasi dan Humas', 'Pranata Laboratorium Pendidikan Ahli Muda',
            'Analis Kerja Sama', 'Pengadministrasian Persuratan', 'Pengadministrasi Kemahasiswaan', 'Pengadministrasian Keuangan',
            'Inventaris Gudang dan BMN', 'Staff Perencanaan, Kerjasama, & Hubungan Alumni', 'Staff SDM dan TI', 
            'Staff Penelitian dan Pengabdian', 'Petugas Ruang Baca', 'Pengadministrasi SDM dan TI', 'Pengadministrasi Keuangan',
            'Pengadministrasi PKM', 'Bagian Umum', 'Analis Kepegawaian Madya', 'Pengadministrasi Kerumahtanggaan', 'Penata Dokumen Keuangan'
        ];

        // Menyisipkan data ke tabel jabatan
        foreach ($jabatans as $jabatan) {
            DB::table('pegawai_jabatan_tendik')->insert([
                'nama_jabatan' => $jabatan
            ]);
        }
    }
}
