<?php

namespace App\Http\Controllers;

use App\Models\{Triwulan, SKPPeriode, Kalender, SKPAtasanPegawai};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TriwulanController extends Controller
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
        $title = "Laporan Triwulan";
        $SKPPeriode = [];
        if ($this->user->hasRole('pegawai') || $this->user->hasRole('atasan')){
            $SKPPeriode = SKPPeriode::where('is_active', 1)->get();
        }
        return view('penilaian_staff.triwulan', [
            'title'=> $title,
            'user'=> $this->user,
            'triwulan'=>$request->triwulan ?? null,
            'SKPPeriode'=> $SKPPeriode,
        ]);
    }
    public function periode(Request $request)
    {
        if($this->user->pegawai->atasan_id === null){
            return redirect()->back()->with('error', 'Atasan anda belum ada.');
        }
        if ($this->user->hasRole('pegawai') || $this->user->hasRole('atasan')){
            $SKPPeriode = SKPPeriode::where('is_active', 1)->get();
        }
        $title = "Laporan Triwulan";
        $triwulan = $request->triwulan ?? 1;
        $staffs = SKPAtasanPegawai::where('atasan_id', $this->user->pegawai_id)
            ->where('periode_id',$request->periode_id)
            ->get()
            ->map(function($staff) use ($triwulan) {
                $staff->triwulan = $triwulan;
                return $staff;
            });
        return view('penilaian_staff.triwulan',[
            'title'=> $title,
            'periode'=> $request->periode_id ?? null,
            'triwulan'=>$triwulan,
            'staffs'=> $staffs ?? null,
            'user'=> $this->user,
            'SKPPeriode' => $SKPPeriode,
        ]);
    }
    public function getTriwulanData($id,$periode,$triwulan){
        $triwulan = (int) $triwulan;
        $logHarian = Kalender::with(['periode','skpRelasi'])
            ->where('pegawai_id', $id)
            ->where('atasan_id',$this->user->pegawai_id)
            ->where('periode_id', $periode)
            ->get()
            ->filter(function ($item) use ($triwulan) {
                $bulan = \Carbon\Carbon::parse($item->tanggal)->month;
                if ($triwulan === 1) return $bulan >= 1 && $bulan <= 3;
                if ($triwulan === 2) return $bulan >= 4 && $bulan <= 6;
                if ($triwulan === 3) return $bulan >= 7 && $bulan <= 9;
                if ($triwulan === 4) return $bulan >= 10 && $bulan <= 12;
                return false;
            })
            ->map(function($item){
                return [
                    'id' => $item->id,
                    'tanggal' => $item->tanggal,
                    'nama_aktivitas' => $item->nama_aktivitas,
                    'deskripsi' => $item->deskripsi,
                    'periode_id' => $item->periode_id,
                    'skp' => $item->skpRelasi->skp ?? null,
                    'link' => $item->link,
                ];
            });
        return response()->json($logHarian);
    }
}
