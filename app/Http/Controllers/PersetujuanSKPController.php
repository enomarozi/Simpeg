<?php

namespace App\Http\Controllers;

use App\Models\{ PenilaianStaff, SKPPeriode, SKPAtasanPegawai};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PersetujuanSKPController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function($request, $next){
            $this->user = Auth::user();
            if (!$this->user->hasRole('pegawai') && !$this->user->hasRole('atasan')) {
                abort(403, 'Unauthorized');
            }
            $_periode = SKPPeriode::where('tahun',date('Y'))->first();
            if($_periode !== null){
                return $next($request);
            }
            else{
                return redirect()->route('index')->with('error', 'Periode Sekarang belum ada...');
            }
        });
    }
    public function index()
    {
        $title = "Persetujuan SKP";
        $SKPPeriode = [];
        if ($this->user->hasRole('pegawai') || $this->user->hasRole('atasan')){
            $SKPPeriode = SKPPeriode::where('is_active', 1)->get();
        }
        return view('penilaian_staff.persetujuan_skp',[
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
            $SKPPeriode = SKPPeriode::where('is_active', 1)->get();
        }
        $title = "Persetujuan SKP";
        $staffs = SKPAtasanPegawai::with('pegawai')
            ->where('atasan_id', $this->user->pegawai_id)
            ->where('periode_id',$request->periode_id)
            ->get();
        return view('penilaian_staff.persetujuan_skp',[
            'title'=>$title,
            'periode'=>$request->periode_id ?? null,
            'user'=>$this->user,
            'SKPPeriode'=>$SKPPeriode,
            'staffs'=>$staffs,
        ]);
    }
}
