<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Pegawai, Agama, StatusPerkawinan, GolonganDarah, Kewarganegaraan, Negara, Kepangkatan};
use App\Models\{PegawaiAlamat};
use DB;

class PegawaiController extends Controller
{
    public function Data_pegawai(){
        $title = "Data Pegawai";
        return view('admin/index',compact('title'));
    }
    public function Detail_pegawai($id){
        $pegawai = DB::table('pegawai')
            ->leftJoin('pegawai_departemen', 'pegawai.departemen_id', '=', 'pegawai_departemen.id')
            ->leftJoin('fakultas', 'pegawai_departemen.fakultas_id', '=', 'fakultas.id')
            ->leftJoin('pegawai_kategori_kepegawaian', 'pegawai.kategori_kepegawaian_id','=','pegawai_kategori_kepegawaian.id')
            ->leftJoin('pegawai_jenis_kepegawaian', 'pegawai.jenis_kepegawaian_id','=','pegawai_jenis_kepegawaian.id')
            ->leftJoin('pegawai_informasi_alamat', 'pegawai_informasi_alamat.pegawai_id','=','pegawai.id')
            ->select('pegawai.id', 'pegawai.nip', 'pegawai.nama', 'pegawai.gelar_depan', 'pegawai.gelar_belakang', 'pegawai.jenis_kelamin', 'pegawai.tempat_lahir', 'pegawai.tanggal_lahir', 'agama_id', 'pegawai.status', 'fakultas.nama_fakultas', 'pegawai_jenis_kepegawaian.nama_jenis_kepegawaian','pegawai_kategori_kepegawaian.nama_kategori_kepegawaian', 'pegawai_departemen.nama_departemen', 'kepangkatan_id','tmt_pangkat','perkawinan_id','kewarganegaraan_id','negara_id','pegawai_informasi_alamat.provinsi','pegawai_informasi_alamat.kabupaten_kota','pegawai_informasi_alamat.kecamatan')
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
            ->leftJoin('pegawai_departemen', 'pegawai.departemen_id', '=', 'pegawai_departemen.id')
            ->leftJoin('fakultas', 'pegawai_departemen.fakultas_id', '=', 'fakultas.id')
            ->leftJoin('pegawai_kepangkatan', 'pegawai_kepangkatan.id', '=', 'pegawai.kepangkatan_id')
            ->leftJoin('pegawai_kategori_kepegawaian', 'pegawai.kategori_kepegawaian_id','=','pegawai_kategori_kepegawaian.id')
            ->select('pegawai.id', 'pegawai.nip', 'pegawai.nama', 'pegawai.jenis_kelamin', 'pegawai.tempat_lahir', 'pegawai.status', 'fakultas.nama_fakultas', 'pegawai_kategori_kepegawaian.nama_kategori_kepegawaian', 'pegawai_departemen.nama_departemen', 'pegawai_kepangkatan.golongan', 'pegawai_kepangkatan.pangkat')
            ->get();

        return response()->json($pegawai);
    }

    public function update_pegawai(Request $request){
        $pegawai = Pegawai::find($request->pegawai_id);
        if (!$pegawai) {
            return response()->json(['message' => 'Pegawai tidak ditemukan'], 404);
        }
        $pegawai->update([
            'jenis_kelamin' => $request->gender,
            'agama_id' => $request->agama,
            'perkawinan_id' => $request->perkawinan,
            'kewarganegaraan_id' => $request->status_kewarganegaraan,
            'negara_id' => $request->kewarganegaraan,
            'usia_pensiun' => $request->usia_pensiun,
            'telepon' => $request->telepon,
            'hp' => $request->hp,
            'email' => $request->email,
            'kepangkatan_id' => $request->pangkat,
            'tmt_pangkat' => $request->tmt_pangkat,
            'jabatan_id' => $request->jabatan_f,
        ]);

        PegawaiAlamat::updateOrCreate(
            ['pegawai_id' => $request->pegawai_id],
            [
                'provinsi'       => $request->provinsi,
                'kabupaten_kota' => $request->kabupaten_kota,
                'kecamatan'      => $request->kecamatan,
                'alamat_lengkap' => $request->alamat_lengkap,
            ]
        );

        return response()->json(['message' => 'Pegawai berhasil diupdate']);
    }
}
