<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Pegawai, Agama, Jabatan, StatusPerkawinan, GolonganDarah, Kewarganegaraan, Negara, Kepangkatan, KategoriPegawai, JenisPegawai, Fakultas, PegawaiDepartemen};
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
            ->leftJoin('pegawai_jenis_kepegawaian', 'pegawai.jenis_kepegawaian_id','=','pegawai_jenis_kepegawaian.id')
            ->leftJoin('pegawai_informasi_alamat', 'pegawai_informasi_alamat.pegawai_id','=','pegawai.id')
            ->select('pegawai.id', 'pegawai.nip', 'pegawai.nama', 'pegawai.gelar_depan', 'pegawai.gelar_belakang', 'pegawai.jenis_kelamin', 'pegawai.tempat_lahir', 'pegawai.tanggal_lahir', 'agama_id', 'pegawai.status', 'pegawai_jenis_kepegawaian.nama_jenis_kepegawaian','kategori_kepegawaian_id', 'pegawai_departemen.nama_departemen','fakultas_id','kepangkatan_id','tmt_pangkat','perkawinan_id','jabatan_id','kewarganegaraan_id','negara_id','pegawai_informasi_alamat.provinsi','pegawai_informasi_alamat.kabupaten_kota','pegawai_informasi_alamat.kecamatan')
            ->where('pegawai.id', $id)
            ->first();
        // dd($pegawai);
        $title = "Detail ".$pegawai->nama;
        $agama = Agama::all();
        $kategoriPegawai =  KategoriPegawai::all();
        $jenisPegawai = JenisPegawai::all();
        $fakultas = Fakultas::all();
        $pegawaiDepartemen = PegawaiDepartemen::all();
        $perkawinan = StatusPerkawinan::all();
        $golonganDarah = GolonganDarah::all();
        $kewarganegaraan = Kewarganegaraan::all();
        $negara = Negara::all();
        $kepangkatan = Kepangkatan::all();
        $jabatan = Jabatan::all();
        return view('admin/detail',compact('title','pegawai','agama','kategoriPegawai','jenisPegawai','fakultas','pegawaiDepartemen','perkawinan','golonganDarah','kewarganegaraan','negara','kepangkatan','jabatan'));
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

    public function Json_departemen(){
        $departemen = DB::table('pegawai_departemen');

    }

    public function update_pegawai(Request $request){
        $pegawai = Pegawai::find($request->pegawai_id);
        if (!$pegawai) {
            return response()->json(['message' => 'Pegawai tidak ditemukan'], 404);
        }
        // return response()->json([$request->all()]);
        $pegawai->update([
            'nip' => $request->nip,
            'gelar_depan'=> $request->gelar_depan,
            'nama'=> $request->nama,
            'gelar_belakang' => $request->gelar_belakang,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'kategori_kepegawaian_id' => $request->status_kepegawaian,
            'fakultas_id' => $request->fakultas_id,
            'departemen_id' => $request->departemen_id,
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
