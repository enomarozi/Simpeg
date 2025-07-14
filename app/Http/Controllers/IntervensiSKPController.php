<?php

namespace App\Http\Controllers;

use App\Models\{ SKPPeriode, Pegawai, SKP, SKPIndikator};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IntervensiSKPController extends Controller
{
    public function index(){
        $title = "Intervensi";
        $user = Auth::user();
        $SKPperiode = [];
        if ($user->hasRole('pegawai') || $user->hasRole('atasan')){
            $SKPperiode = SKPPeriode::all();
        }
        return view('skp.intervensi',compact('title','user','SKPperiode'));
    }

    public function periode(Request $request){
        $title = "Intervensi";
        $periode = $request->periode_id;
        $user = Auth::user();
        $SKPperiode = [];
        if ($user->hasRole('pegawai') || $user->hasRole('atasan')){
            $SKPperiode = SKPPeriode::all();
        }
        $daftarSkp = Skp::with(['periode'])
            ->where('pegawai_id', $user->pegawai_id)
            ->orderBy('created_at', 'desc')
            ->get();
        $daftarBawahan = Pegawai::where('atasan_id', $user->pegawai_id)->get();
        return view('skp.intervensi', compact('title','periode','user','SKPperiode','daftarSkp','daftarBawahan'));
    }

    public function intervensiAdd(Request $request){
        $user = Auth::user()->pegawai_id;
        $bawahan_id = Pegawai::select("atasan_id")
            ->where('id', $request->bawahan_id)
            ->first();
        if($user === $bawahan_id->atasan_id){
            echo "Cocok";
        }
    }
}
