<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use App\Models\{Pegawai, Agama, Jabatan, StatusPerkawinan, GolonganDarah, Kewarganegaraan, Negara, Kepangkatan, KategoriPegawai, JenisPegawai, Fakultas, PegawaiDepartemen, PegawaiAlamat};
use App\Models\{SKPAtasanPegawai, SKPPeriode};
use DB;

class PegawaiController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function($request, $next){
            $this->user = Auth::user();
            if (!$this->user->hasRole('admin')) {
                abort(403, 'Unauthorized');
            }
            return $next($request);
        });
    }
    public function Data_pegawai(){
        $title = "Data Pegawai";
        return view('admin.index',[
            'title' => $title,
            'user' => $this->user,
        ]);
    }
    public function Detail_pegawai($id){
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
                'pegawai.fakultas_id',
                'pegawai.jenis_kepegawaian_id',
                'agama_id', 
                'pegawai.status', 
                'pegawai_jenis_kepegawaian.nama_jenis_kepegawaian',
                'kategori_kepegawaian_id', 
                'pegawai_departemen.nama_departemen',
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
        if (!$pegawai) {
            abort(404, 'Pegawai tidak ditemukan.');
        }
        $title = "Detail ".$pegawai->nama;
        $referenceData = [
            'agama'             => Agama::all(),
            'kategoriPegawai'   => KategoriPegawai::all(),
            'jenisPegawai'      => JenisPegawai::all(),
            'fakultas'          => Fakultas::all(),
            'pegawaiDepartemen' => PegawaiDepartemen::all(),
            'perkawinan'        => StatusPerkawinan::all(),
            'golonganDarah'     => GolonganDarah::all(),
            'kewarganegaraan'   => Kewarganegaraan::all(),
            'negara'            => Negara::all(),
            'kepangkatan'       => Kepangkatan::all(),
            'jabatan'           => Jabatan::all(),
            'pegawai_as_atasan' => Pegawai::select('id', 'nama')->get(),
        ];
        return view('admin.detail', array_merge([
            'user'    => $this->user,
            'pegawai' => $pegawai,
            'title'   => $title,
        ], $referenceData));
    }

    public function json_pegawai(){
        $pegawai = DB::table('pegawai')
            ->leftJoin('pegawai_departemen', 'pegawai.departemen_id', '=', 'pegawai_departemen.id')
            ->leftJoin('pegawai_fakultas', 'pegawai_departemen.fakultas_id', '=', 'pegawai_fakultas.id')
            ->leftJoin('pegawai_kepangkatan', 'pegawai_kepangkatan.id', '=', 'pegawai.kepangkatan_id')
            ->leftJoin('pegawai_kategori_kepegawaian', 'pegawai.kategori_kepegawaian_id','=','pegawai_kategori_kepegawaian.id')
            ->select(
                'pegawai.id', 
                'pegawai.nip', 
                'pegawai.nama', 
                'pegawai.jenis_kelamin', 
                'pegawai.tempat_lahir', 
                'pegawai.status', 
                'pegawai_fakultas.nama_fakultas', 
                'pegawai_kategori_kepegawaian.nama_kategori_kepegawaian', 
                'pegawai_departemen.nama_departemen', 
                'pegawai_kepangkatan.golongan', 
                'pegawai_kepangkatan.pangkat')
            ->get();

        return response()->json($pegawai);
    }

    public function Json_departemen(){
        $departemen = DB::table('pegawai_departemen');
    }

    public function update_pegawai(Request $request){
        $pegawai = Pegawai::find($request->pegawai_id);
        if (!$pegawai) {
            return response()->json([
                'status' => 'error',
                'message' => 'Pegawai tidak ditemukan.'
            ], 404);
        }

        $pegawai->update([
            'nip' => $request->nip,
            'gelar_depan'=> $request->gelar_depan,
            'nama'=> $request->nama,
            'gelar_belakang' => $request->gelar_belakang,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'status_kepegawaian' => $request->status_kepegawaian,
            'jabatan_id' => $request->jabatan_id,
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
        return response()->json([
            'status' => 'success',
            'message' => 'Data ' . $pegawai->nama . ' berhasil diupdate.'
        ]);
    }
    
    public function update_atasan(Request $request){
        $pegawai = Pegawai::find($request->pegawai);
        if (!$pegawai) {
            return redirect()->back()->with('error', 'Pegawai tidak ditemukan.');
        }
        if ($request->pegawai === $request->atasan_id){
            return redirect()->back()->with('error', 'Pegawai dan Atasan sama.');
        }
        $periode_sekarang = SKPPeriode::where('tahun',now()->year)->first();
        if($periode_sekarang === null){
            return redirect()->back()->with('error', 'Periode '.(now()->year).' tidak ditemukan.');
        }
        $atasan_sekarang = SKPAtasanPegawai::where('pegawai_id', $request->pegawai)
                ->where('atasan_id', $request->atasan_id)
                ->where('periode_id', $periode_sekarang->id)
                ->first();
        if($atasan_sekarang === null){
            SKPAtasanPegawai::create([
                'pegawai_id' => $request->pegawai,
                'atasan_id' => $request->atasan_id,
                'periode_id' => $periode_sekarang->id,
            ]);
        }
        $pegawai->update([
            'atasan_id'=> $request->atasan_id,
        ]);
        return redirect()->back()->with('success', 'Atasan '.$pegawai->nama.' Berhasil diupdate.');
    }
}
