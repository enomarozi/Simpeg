<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use DB;

class PegawaiController extends Controller
{
    public function Data_pegawai(){
        $title = "Data Pegawai";
        return view('admin/index',compact('title'));
    }
    public function Detail_pegawai($id){
        $pegawai = DB::table('pegawai')
            ->join('departemen', 'pegawai.id_departemen', '=', 'departemen.id')
            ->join('fakultas', 'departemen.id_fakultas', '=', 'fakultas.id')
            ->join('kepangkatan', 'kepangkatan.id', '=', 'pegawai.id_kepangkatan')
            ->join('kategori_kepegawaian', 'pegawai.id_kategori_kepegawaian','=','kategori_kepegawaian.id')
            ->select('pegawai.id', 'pegawai.nip', 'pegawai.nama', 'pegawai.jenis_kelamin', 'pegawai.tempat_lahir', 'pegawai.tanggal_lahir', 'pegawai.status', 'fakultas.nama_fakultas', 'kategori_kepegawaian.nama_kategori_kepegawaian', 'departemen.nama_departemen', 'kepangkatan.golongan', 'kepangkatan.pangkat')
            ->where('pegawai.id', 1)
            ->first();
        $title = "Detail ".$pegawai->nama;
        return view('admin/detail',compact('title','pegawai'));
    }

    public function Json_pegawai(){
        $pegawai = DB::table('pegawai')
            ->join('departemen', 'pegawai.id_departemen', '=', 'departemen.id')
            ->join('fakultas', 'departemen.id_fakultas', '=', 'fakultas.id')
            ->join('kepangkatan', 'kepangkatan.id', '=', 'pegawai.id_kepangkatan')
            ->join('kategori_kepegawaian', 'pegawai.id_kategori_kepegawaian','=','kategori_kepegawaian.id')
            ->select('pegawai.id', 'pegawai.nip', 'pegawai.nama', 'pegawai.jenis_kelamin', 'pegawai.tempat_lahir', 'pegawai.status', 'fakultas.nama_fakultas', 'kategori_kepegawaian.nama_kategori_kepegawaian', 'departemen.nama_departemen', 'kepangkatan.golongan', 'kepangkatan.pangkat')
            ->get();

        return response()->json($pegawai);
    }
}
