<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Pegawai, Agama};
use DB;

class PegawaiController extends Controller
{
    public function Data_pegawai(){
        $title = "Data Pegawai";
        return view('admin/index',compact('title'));
    }
    public function Detail_pegawai($id){
        $pegawai = DB::table('pegawai')
            ->join('agama','pegawai.agama_id','=','agama.id')
            ->join('departemen', 'pegawai.departemen_id', '=', 'departemen.id')
            ->join('fakultas', 'departemen.fakultas_id', '=', 'fakultas.id')
            ->join('kepangkatan', 'kepangkatan.id', '=', 'pegawai.kepangkatan_id')
            ->join('kategori_kepegawaian', 'pegawai.kategori_kepegawaian_id','=','kategori_kepegawaian.id')
            ->join('jenis_kepegawaian', 'pegawai.jenis_kepegawaian_id','=','jenis_kepegawaian.id')
            ->select('pegawai.id', 'pegawai.nip', 'pegawai.nama', 'pegawai.gelar_depan', 'pegawai.gelar_belakang', 'pegawai.jenis_kelamin', 'pegawai.tempat_lahir', 'pegawai.tanggal_lahir', 'agama.nama as agama', 'pegawai.status', 'fakultas.nama_fakultas', 'jenis_kepegawaian.nama_jenis_kepegawaian','kategori_kepegawaian.nama_kategori_kepegawaian', 'departemen.nama_departemen', 'kepangkatan.golongan', 'kepangkatan.pangkat')
            ->where('pegawai.id', $id)
            ->first();
        $title = "Detail ".$pegawai->nama;
        $agama = Agama::all();
        return view('admin/detail',compact('title','pegawai','agama'));
    }

    public function Json_pegawai(){
        $pegawai = DB::table('pegawai')
            ->join('departemen', 'pegawai.departemen_id', '=', 'departemen.id')
            ->join('fakultas', 'departemen.fakultas_id', '=', 'fakultas.id')
            ->join('kepangkatan', 'kepangkatan.id', '=', 'pegawai.kepangkatan_id')
            ->join('kategori_kepegawaian', 'pegawai.kategori_kepegawaian_id','=','kategori_kepegawaian.id')
            ->select('pegawai.id', 'pegawai.nip', 'pegawai.nama', 'pegawai.jenis_kelamin', 'pegawai.tempat_lahir', 'pegawai.status', 'fakultas.nama_fakultas', 'kategori_kepegawaian.nama_kategori_kepegawaian', 'departemen.nama_departemen', 'kepangkatan.golongan', 'kepangkatan.pangkat')
            ->get();

        return response()->json($pegawai);
    }
}
