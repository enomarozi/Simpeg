<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\{Pegawai, Agama, Jabatan, StatusPerkawinan, GolonganDarah, Kewarganegaraan, Negara, Kepangkatan, KategoriPegawai, JenisPegawai, Fakultas, PegawaiDepartemen, User};
use Spatie\Permission\Models\Role;
use App\Models\{PegawaiAlamat};
use DB;

class PegawaiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function Data_pegawai(){
        $user = Auth::user();
        $title = "Data Pegawai";
        return view('admin/index',compact('title','user'));
    }
    public function Detail_pegawai($id){
        $user = Auth::user();
        $pegawai = DB::table('pegawai')
            ->leftJoin('pegawai_departemen', 'pegawai.departemen_id', '=', 'pegawai_departemen.id')
            ->leftJoin('pegawai_jenis_kepegawaian', 'pegawai.jenis_kepegawaian_id','=','pegawai_jenis_kepegawaian.id')
            ->leftJoin('pegawai_informasi_alamat', 'pegawai_informasi_alamat.pegawai_id','=','pegawai.id')
            ->select(
                'pegawai.id', 
                'pegawai.nip', 
                'pegawai.nama', 
                'pegawai.gelar_depan', 
                'pegawai.gelar_belakang', 
                'pegawai.jenis_kelamin', 
                'pegawai.tempat_lahir', 
                'pegawai.tanggal_lahir', 
                'agama_id', 
                'pegawai.status', 
                'pegawai_jenis_kepegawaian.nama_jenis_kepegawaian',
                'kategori_kepegawaian_id', 
                'pegawai_departemen.nama_departemen',
                'pegawai_departemen.fakultas_id',
                'kepangkatan_id',
                'tmt_pangkat',
                'perkawinan_id',
                'jabatan_id',
                'kewarganegaraan_id',
                'negara_id',
                'pegawai.atasan_id',
                'pegawai_informasi_alamat.provinsi',
                'pegawai_informasi_alamat.kabupaten_kota',
                'pegawai_informasi_alamat.kecamatan'
            )
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
        $pegawai_as_atasan = Pegawai::select('id', 'nama')->get();
        return view('admin/detail',compact('user','title','pegawai','agama','kategoriPegawai','jenisPegawai','fakultas','pegawaiDepartemen','perkawinan','golonganDarah','kewarganegaraan','negara','kepangkatan','jabatan','pegawai_as_atasan'));
    }

    public function json_pegawai(){
        $user = Auth::user();
        $pegawai = DB::table('pegawai')
            ->leftJoin('pegawai_departemen', 'pegawai.departemen_id', '=', 'pegawai_departemen.id')
            ->leftJoin('pegawai_fakultas', 'pegawai_departemen.fakultas_id', '=', 'pegawai_fakultas.id')
            ->leftJoin('pegawai_kepangkatan', 'pegawai_kepangkatan.id', '=', 'pegawai.kepangkatan_id')
            ->leftJoin('pegawai_kategori_kepegawaian', 'pegawai.kategori_kepegawaian_id','=','pegawai_kategori_kepegawaian.id')
            ->select('pegawai.id', 'pegawai.nip', 'pegawai.nama', 'pegawai.jenis_kelamin', 'pegawai.tempat_lahir', 'pegawai.status', 'pegawai_fakultas.nama_fakultas', 'pegawai_kategori_kepegawaian.nama_kategori_kepegawaian', 'pegawai_departemen.nama_departemen', 'pegawai_kepangkatan.golongan', 'pegawai_kepangkatan.pangkat')
            ->get();

        return response()->json($pegawai);
    }

    public function Json_departemen(){
        $departemen = DB::table('pegawai_departemen');

    }

    public function update_pegawai(Request $request){
        $pegawai = Pegawai::find($request->pegawai_id);
        if (!$pegawai) {
            return redirect()->back()->with('error', 'Pegawai tidak ditemukan.');
        }
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

        return redirect()->back()->with('success', 'Data '.$pegawai->nama.' Berhasil diupdate.');
    }
    public function data_user(){
        $user = Auth::user();
        $title = "Managemen User";
        $users = User::with('roles:id,name')->select('id', 'name', 'username', 'email', 'pegawai_id', 'is_active')->get();
        $pegawai = Pegawai::select('id', 'nama')->get();
        $roles = Role::where('name', '!=', 'admin')->select('id', 'name')->get();
        return view('admin/managemen_user',compact('title','users','pegawai','user','roles'));
    }
    public function set_id_pegawai(Request $request){
        $request->validate([
            'username' => 'required|string|exists:users,username',
            'pegawai_id' => 'nullable|exists:pegawai,id',
        ]);

        $user = User::where('username', $request->username)->first();
        if ($user->username === 'administrator') {
            return back()->withErrors(['error' => 'Action not allowed on administrator account.']);
        }
        elseif($user){
            $user->update([
                'pegawai_id' => $request->pegawai_id,
            ]);
            return redirect()->back()->with('success', 'Pegawai ID berhasil diperbarui.');
        }
        return redirect()->back()->with('error', 'User tidak ditemukan.');
    }
    public function set_role_pegawai(Request $request)
    {
        $user = User::find($request->user_id);

        if ($user->username === 'administrator') {
            return back()->withErrors(['error' => 'Action not allowed on administrator account.']);
        }

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role' => 'required|exists:roles,name',
        ]);

        $user = User::find($request->user_id);
        $user->syncRoles([$request->role]);

        return redirect()->back()->with('success', 'Role updated successfully.');
    }
    public function set_active_pegawai($id){
        $user = User::findOrFail($id);
        if ($user->username === 'administrator') {
            return back()->withErrors(['error' => 'Action not allowed on administrator account.']);
        }
        $user->is_active = $user->is_active ? 0 : 1;
        $user->save();

        $status = $user->is_active ? 'aktif' : 'nonaktif';

        return redirect()->back()->with('success', "User {$user->name} berhasil diubah menjadi {$status}.");
    }
    
    
    public function update_atasan(Request $request){
        $user = Auth::user();
        $pegawai = Pegawai::find($request->pegawai);
        if (!$pegawai) {
            return redirect()->back()->with('error', 'Pegawai tidak ditemukan.');
        }
        $pegawai->update([
            'atasan_id'=> $request->atasan_id,
        ]);
        return redirect()->back()->with('success', 'Atasan '.$pegawai->nama.' Berhasil diupdate.');
    }
}
