<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use App\Models\{Pegawai, Agama, Jabatan, StatusPerkawinan, GolonganDarah, Kewarganegaraan, Negara, Kepangkatan, KategoriPegawai, JenisPegawai, Fakultas, PegawaiDepartemen, PegawaiAlamat, PegawaiInformasiId, PegawaiInformasiMedis, PegawaiInformasiBank, NamaBank,
    UnitKerja};
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
            ->leftJoin('pegawai_informasi_id', 'pegawai_informasi_id.pegawai_id','=','pegawai.id')
            ->leftJoin('pegawai_informasi_medis','pegawai_informasi_medis.pegawai_id','=','pegawai.id')
            ->leftJoin('pegawai_informasi_bank','pegawai_informasi_bank.pegawai_id','=','pegawai.id')
            ->leftJoin('pegawai_informasi_unit_kerja','pegawai_informasi_unit_kerja.pegawai_id','=','pegawai.id')
            ->leftJoin('pegawai_fakultas', 'pegawai.fakultas_id', '=', 'pegawai_fakultas.id')
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
                'pegawai.departemen_id',
                'pegawai.jenis_kepegawaian_id',
                'pegawai.agama_id', 
                'pegawai.status', 
                'pegawai.kategori_kepegawaian_id',
                'pegawai.kepangkatan_id',
                'pegawai.tmt_cpns',
                'pegawai.tmt_pangkat',
                'pegawai.perkawinan_id',
                'pegawai.jabatan_id',
                'pegawai.kewarganegaraan_id',
                'pegawai.negara_id',
                'pegawai.usia_pensiun',
                'pegawai.atasan_id',
                'pegawai.telepon',
                'pegawai.hp',
                'pegawai.email',
                'pegawai_fakultas.nama_fakultas',
                'pegawai_jenis_kepegawaian.nama_jenis_kepegawaian',
                'pegawai_departemen.nama_departemen',
                'pegawai_informasi_alamat.provinsi',
                'pegawai_informasi_alamat.kabupaten_kota',
                'pegawai_informasi_alamat.kecamatan',
                'pegawai_informasi_alamat.alamat_lengkap',
                'pegawai_informasi_id.no_ktp',
                'pegawai_informasi_id.no_npwp',
                'pegawai_informasi_id.no_bpjs_tenaga_kerja',
                'pegawai_informasi_medis.golongan_darah_id',
                'pegawai_informasi_medis.tinggi_badan',
                'pegawai_informasi_medis.berat_badan',
                'pegawai_informasi_medis.cacat',
                'pegawai_informasi_bank.bank_id',
                'pegawai_informasi_bank.no_rekening',
                'pegawai_informasi_bank.nama_penerima',
                'pegawai_informasi_unit_kerja.tgl_masuk',
                'pegawai_informasi_unit_kerja.putusan',
                'pegawai_informasi_unit_kerja.no_surat_u',
                'pegawai_informasi_unit_kerja.tgl_sk',

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
            'namaBank'          => NamaBank::all(),
            'unitKerja'         => UnitKerja::all(),
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
            ->leftJoin('pegawai_fakultas', 'pegawai.fakultas_id', '=', 'pegawai_fakultas.id')
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
                'pegawai_departemen.nama_departemen',
                'pegawai_kategori_kepegawaian.nama_kategori_kepegawaian', 
                'pegawai_kepangkatan.golongan', 
                'pegawai_kepangkatan.pangkat')
            ->get();

        return response()->json($pegawai);
    }

    public function Json_departemen(){
        $departemen = DB::table('pegawai_departemen');
    }

    public function update_pegawai(Request $request){
        // return response()->json([
        //     'status' => 'error',
        //     'message' => $request->tgl_sk,
        // ], 200);
        $pegawai = Pegawai::find($request->pegawai_id);
        if (!$pegawai) {
            return response()->json([
                'status' => 'error',
                'message' => 'Pegawai tidak ditemukan.'
            ], 404);
        }
        if($request->jabatan_id == 1){
            $check_dept = DB::table('pegawai_departemen')
                ->where('fakultas_id', $request->fakultas_id)
                ->where('id', $request->departemen_id)
                ->where('id','!=', 75)
                ->where('id','!=', 76)
                ->first();
            if(!$check_dept){
                return response()->json([
                    'status' => 'error',
                    'message' => 'Gagal.'
                ], 404);
            }
        }
        $pegawai->update([
            'nip' => $request->nip,
            'gelar_depan'=> $request->gelar_depan,
            'nama'=> $request->nama,
            'gelar_belakang' => $request->gelar_belakang,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'kategori_kepegawaian_id' => $request->status_kepegawaian,
            'jabatan_id' => $request->jabatan_id,
            'fakultas_id' => $request->fakultas_id,
            'departemen_id'=> $request->departemen_id,
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
        PegawaiInformasiId::updateOrCreate(
            ['pegawai_id' => $request->pegawai_id],
            [
                'no_ktp'                    => $request->no_ktp,
                'no_npwp'                   => $request->no_npwp,
                'no_bpjs_tenaga_kerja'      => $request->no_bpjs_tenaga_kerja,
            ]
        );

        PegawaiInformasiMedis::updateOrCreate(
            ['pegawai_id' => $request->pegawai_id],
            [
                'golongan_darah_id'     => $request->golongan_darah_id,
                'tinggi_badan'          => $request->tinggi_badan,
                'berat_badan'           => $request->berat_badan,
                'cacat'                 => $request->cacat,
            ]
        );
        PegawaiInformasiBank::updateOrCreate(
            ['pegawai_id' => $request->pegawai_id],
            [
                'bank_id'               => $request->bank_id,
                'no_rekening'           => $request->no_rekening,
                'nama_penerima'         => $request->nama_penerima,
            ]
        );
        UnitKerja::updateOrCreate(
            ['pegawai_id' => $request->pegawai_id],
            [
                'tgl_masuk'             => $request->tgl_masuk,
                'putusan'               => $request->putusan,
                'no_surat_u'            => $request->no_surat_u,
                'tgl_sk'                => $request->tgl_sk,
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

    public function getDepartemen($id){
        $departemen = DB::table('pegawai_departemen')
            ->where('fakultas_id', $id)
            ->select('id', 'nama_departemen')
            ->get();
        return response()->json($departemen);
    }
}
