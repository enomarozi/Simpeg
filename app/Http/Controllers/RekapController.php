<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\{ SKPPeriode, SKP, Kalender};
use Carbon\Carbon;

class RekapController extends Controller
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
    public function index(){
        $title = "Rekap & Capaian";
        $SKPPeriode = [];
        if ($this->user->hasRole('pegawai') || $this->user->hasRole('atasan')){
            $SKPPeriode = SKPPeriode::where('is_active', 1)->get();
        }
        return view("log_harian.rekap",[
            'title'=> $title,
            'user'=> $this->user,
            'SKPPeriode'=> $SKPPeriode,
            'periode'=> $request->periode_id ?? null,
        ]);
    }
    public function periode(Request $request)
    {
        if ($this->user->hasRole('pegawai') || $this->user->hasRole('atasan')){
            $SKPPeriode = SKPPeriode::where('is_active', 1)->get();
        }
        $title = "Rekap & Capaian";
        $namaBulan = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        $perBulan = [];
        foreach ($namaBulan as $num => $nama) {
        $perBulan[$nama] = Kalender::with(['periode', 'skpRelasi'])
            ->where('pegawai_id', $this->user->pegawai_id)
            ->where('atasan_id', $this->user->pegawai->atasan_id)
            ->where('periode_id', $request->periode_id)
            ->whereMonth('tanggal', $num)
            ->get();
        }
        return view('log_harian.rekap',[
            'title'=> $title,
            'periode'=> $request->periode_id ?? null,
            'perBulan'=> $perBulan,
            'user'=> $this->user,
            'SKPPeriode' => $SKPPeriode,
        ]);
    }
}
