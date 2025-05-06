<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Pegawai, Agama, StatusPerkawinan, GolonganDarah, Kewarganegaraan, Negara, Kepangkatan};
use DB;

class PegawaiController extends Controller
{
    public function Data_pegawai(){
        $title = "Data Pegawai";
        return view('admin/index',compact('title'));
    }
    public function Detail_pegawai($id){
        $pegawai = DB::table('pegawai')
            ->join('pegawai_departemen', 'pegawai.departemen_id', '=', 'pegawai_departemen.id')
            ->join('fakultas', 'pegawai_departemen.fakultas_id', '=', 'fakultas.id')
            ->join('pegawai_kategori_kepegawaian', 'pegawai.kategori_kepegawaian_id','=','pegawai_kategori_kepegawaian.id')
            ->join('pegawai_jenis_kepegawaian', 'pegawai.jenis_kepegawaian_id','=','pegawai_jenis_kepegawaian.id')
            ->select('pegawai.id', 'pegawai.nip', 'pegawai.nama', 'pegawai.gelar_depan', 'pegawai.gelar_belakang', 'pegawai.jenis_kelamin', 'pegawai.tempat_lahir', 'pegawai.tanggal_lahir', 'agama_id', 'pegawai.status', 'fakultas.nama_fakultas', 'pegawai_jenis_kepegawaian.nama_jenis_kepegawaian','pegawai_kategori_kepegawaian.nama_kategori_kepegawaian', 'pegawai_departemen.nama_departemen', 'kepangkatan_id')
            ->where('pegawai.id', $id)
            ->first();
        // dd($pegawai);
        $title = "Detail ".$pegawai->nama;
        $agama = Agama::all();
        $perkawinan = StatusPerkawinan::all();
        $golonganDarah = GolonganDarah::all();
        $kewarganegaraan = Kewarganegaraan::all();
        $negara = Negara::all();
        $kepangkatan = Kepangkatan::all();
        return view('admin/detail',compact('title','pegawai','agama','perkawinan','golonganDarah','kewarganegaraan','negara','kepangkatan'));
    }

    public function Json_pegawai(){
        $pegawai = DB::table('pegawai')
            ->join('pegawai_departemen', 'pegawai.departemen_id', '=', 'pegawai_departemen.id')
            ->join('fakultas', 'pegawai_departemen.fakultas_id', '=', 'fakultas.id')
            ->join('pegawai_kepangkatan', 'pegawai_kepangkatan.id', '=', 'pegawai.kepangkatan_id')
            ->join('pegawai_kategori_kepegawaian', 'pegawai.kategori_kepegawaian_id','=','pegawai_kategori_kepegawaian.id')
            ->select('pegawai.id', 'pegawai.nip', 'pegawai.nama', 'pegawai.jenis_kelamin', 'pegawai.tempat_lahir', 'pegawai.status', 'fakultas.nama_fakultas', 'pegawai_kategori_kepegawaian.nama_kategori_kepegawaian', 'pegawai_departemen.nama_departemen', 'pegawai_kepangkatan.golongan', 'pegawai_kepangkatan.pangkat')
            ->get();

        return response()->json($pegawai);
    }
}
