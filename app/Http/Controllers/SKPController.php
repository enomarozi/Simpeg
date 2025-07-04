<?php

namespace App\Http\Controllers;

use App\Models\{ SKPPeriode, Pegawai };
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
        $atasan = Pegawai::find($pegawai->atasan_id);
        return view('skp.index', compact('title','user','SKPperiode','pegawai','atasan'));
    }
    public function rhkAdd(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'periode_id_rhk'=>'required',
            'intervensi_rhk_id'=>'',
            'jenis_rhk'=>'required|min:1|max:2',
            'rhk'=>'required',
        ]);

        dd($request->all());

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
