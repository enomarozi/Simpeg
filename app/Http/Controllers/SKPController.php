<?php

namespace App\Http\Controllers;

use App\Models\{ SKPPeriode, Pegawai, SKP, SKPIndikator};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SKPController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $title = "SKP";
        $user = Auth::user();
        $SKPperiode = [];
        if ($user->hasRole('pegawai') || $user->hasRole('atasan')){
            $SKPperiode = SKPPeriode::all();
        }
        $pegawai = Pegawai::find($user->pegawai_id);
        return view('skp.index', compact('title','user','SKPperiode','pegawai'));
    }
    public function skpadd(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'pegawai_id'=>'required',
            'atasan_id'=>'required',
            'periode_id'=>'required',
            'pelaksanaan_skp'=>'',
            'jenis_skp'=>'required|min:1|max:2',
            'skp'=>'required|string',
        ]);
        SKP::create([
            'pegawai_id' => $request->pegawai_id,
            'atasan_id'=> $request->atasan_id,
            'periode_id' => $request->periode_id,
            'pelaksanaan_skp' => $request->pelaksanaan_skp,
            'jenis_skp' => $request->jenis_skp,
            'skp' => $request->skp,
        ]);
        return redirect()->back()->with('success', 'SKP berhasil ditambah.');

    }
    public function periode(Request $request)
    {
        $title = "SKP";
        $periode = $request->periode_id;
        $user = Auth::user();
        $SKPperiode = [];
        if ($user->hasRole('pegawai') || $user->hasRole('atasan')){
            $SKPperiode = SKPPeriode::all();
        }
        $daftarSkp = Skp::with(['periode', 'indikatorList'])
            ->where('pegawai_id', $user->pegawai_id)
            ->where('atasan_id', $user->pegawai->atasan->id)
            ->orderBy('created_at', 'desc')
            ->get();
        $statusSkp = $daftarSkp[0]->status;
        $pegawai = $user->pegawai; 
        $atasan = $pegawai->atasan;
        return view('skp.index', compact('title','periode','user','SKPperiode','daftarSkp','statusSkp','pegawai','atasan'));
    }
    public function skpIndikator(Request $request)
    {
        $validated = $request->validate([
            'skp_id' => ['required', 'integer', 'exists:skp,id'],
            'indikator' => ['required', 'string', 'max:255'],
        ]);
        SKPIndikator::create([
            'skp_id'   => $validated['skp_id'],
            'indikator' => $validated['indikator'],
        ]);
        return redirect()->back()->with('success', 'Poin indikator berhasil ditambahkan.');
    }
    public function skp_periode(){
        $user = Auth::user();
        $title = "SKP Periode";
        $periodeList = SKPPeriode::all(); 
        return view('admin.skp_periode', compact('title','user','periodeList'));
    }
    public function skp_periodeAction(Request $request){
        $user = Auth::user();
        $request->validate([
            'tahun' => 'required|numeric|min:2000|max:2100',
            'mulai' => 'required|date',
            'selesai' => 'required|date|after_or_equal:mulai',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        SKPPeriode::create([
            'tahun' => $request->tahun,
            'tanggal_mulai' => $request->mulai,
            'tanggal_selesai' => $request->selesai,
            'status' => $request->status,
        ]);
        return redirect()->back()->with('success', 'Periode SKP berhasil ditambah.');
    }
    public function skp_periode_del($id){
        $periode = SKPPeriode::find($id);
        if (!$periode) {
            return redirect()->back()->withErrors(['error' => 'Periode tidak ditemukan.']);
        }
        $periode->delete();
        return redirect()->back()->with('success', 'Periode berhasil dihapus.');
        }
    }
