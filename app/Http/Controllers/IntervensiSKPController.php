<?php

namespace App\Http\Controllers;

use App\Models\{ SKPPeriode, Pegawai, SKP, SKPIntervensi};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

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
        $daftarIntervensi = SKPIntervensi::with(['periode'])
            ->where('pegawai_id', $user->pegawai_id)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('skp.intervensi', compact('title','periode','user','SKPperiode','daftarSkp','daftarBawahan','daftarIntervensi'));
    }

    public function intervensiAdd(Request $request){
        $pegawai_id = Auth::user()->pegawai_id;
        $bawahan_id = Pegawai::where('id', $request->bawahan_id)->value('atasan_id');
        if(!$bawahan_id){
            return redirect()->back()->with('error', 'Bawahan tidak ditemukan.');
        }
        $request->validate([
            'bawahan_id'=>'required|integer',
            'periode_id'=>[
                'required',
                'integer',
                Rule::exists('skp_periode', 'id')->where(function ($query) {
                    $query->where('status', 'aktif');
                }),
            ],
            'skp_intervensi'=>'required|string',
        ]);
        $intervensi = SkpIntervensi::create([
            'pegawai_id' => $pegawai_id,
            'bawahan_id' => $request->bawahan_id,
            'periode_id' => $request->periode_id,
            'skp_id' => $request->skp_intervensi,
        ]);
        return redirect()->back()->with('success', 'Intervensi SKP berhasil ditambahkan.');
    }
}
