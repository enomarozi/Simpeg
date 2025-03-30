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

    public function Json_pegawai(){
        $pegawai = DB::table('pegawai')
            ->join('departemen', 'pegawai.id_departemen', '=', 'departemen.id')
            ->join('fakultas', 'departemen.id_fakultas', '=', 'fakultas.id')
            ->join('kepangkatan', 'kepangkatan.id', '=', 'pegawai.id_kepangkatan')
            ->select('pegawai.nip', 'pegawai.nama', 'pegawai.jenis_kelamin', 'pegawai.tempat_lahir', 'pegawai.status', 'fakultas.nama_fakultas', 'departemen.nama_departemen', 'kepangkatan.golongan', 'kepangkatan.pangkat')
            ->get();

        return response()->json($pegawai);
    }
}
