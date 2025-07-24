<?php

namespace App\Http\Controllers;

use App\Models\{SKPPeriode, SKPAtasanPegawai, Pegawai, SKPIntervensi, SKP};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SKPEvaluasi extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function($request, $next){
            $this->user = Auth::user();
            if (!$this->user->hasRole('pegawai') && !$this->user->hasRole('atasan')) {
                abort(403, 'Unauthorized');
            }
            return $next($request);
        });
    }
    public function index(){
        $title = "Evaluasi SKP";
        $SKPPeriode = SKPPeriode::all();
        return view('skp.evaluasi',[
            'title'=>$title,
            'user'=>$this->user,
            'SKPPeriode'=>$SKPPeriode,
        ]);
    }
    public function periode(Request $request){
        if($this->user->pegawai->atasan_id === null){
            return redirect()->back()->with('error', 'Atasan anda belum ada.');
        }
        if ($this->user->hasRole('pegawai') || $this->user->hasRole('atasan')){
            $SKPPeriode = SKPPeriode::all();
        }
        $title = "Intervensi";
        $checkAtasan = SKPAtasanPegawai::Where('pegawai_id', $this->user->pegawai_id)
            ->where('atasan_id', $this->user->pegawai->atasan_id)
            ->where('periode_id', $request->periode_id)
            ->first();
        if($checkAtasan == null){
            return redirect()->back()->with('error', 'Tidak ditemukan atasan untuk periode yang dipilih.');
        }
        $daftarSkp = SKP::with(['periode', 'indikatorList'])
            ->where('pegawai_id', $this->user->pegawai_id)
            ->where('atasan_id',$this->user->pegawai->atasan_id)
            ->where('periode_id', $request->periode_id)
            ->orderBy('created_at', 'desc')
            ->get();

        $statusSkp = null;
        $atasanId = null;
        if ($daftarSkp->isNotEmpty()) {
            $statusSkp = $daftarSkp[0]->status;
            $atasanId = Pegawai::find($daftarSkp[0]->atasan_id);
        }
        return view('skp.evaluasi',[
            'title'=>$title,
            'periode'=>$request->periode_id ?? null,
            'atasan_id'=> $request->atasan_id,
            'user'=>$this->user,
            'SKPPeriode'=>$SKPPeriode,
            'daftarSkp'=>$daftarSkp,
            'statusSkp'=>$statusSkp,
        ]);
    }
}
