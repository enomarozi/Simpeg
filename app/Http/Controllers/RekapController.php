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
    public function getLogDetail($bulan)
    {
        $bulanMap = [
            'Januari' => 1,
            'Februari' => 2,
            'Maret' => 3,
            'April' => 4,
            'Mei' => 5,
            'Juni' => 6,
            'Juli' => 7,
            'Agustus' => 8,
            'September' => 9,
            'Oktober' => 10,
            'November' => 11,
            'Desember' => 12,
        ];
        $bulanAngka = $bulanMap[$bulan] ?? null;
        if (!$bulanAngka) {
            return response()->json(['error' => 'Bulan tidak valid'], 400);
        }
        $logHarian = Kalender::whereMonth('tanggal', $bulanAngka)
            ->with('skpRelasi','atasan')
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'tanggal' => $item->tanggal,
                    'nama_aktivitas' => $item->nama_aktivitas,
                    'deskripsi' => $item->deskripsi,
                    'periode_id' => $item->periode_id,
                    'atasan' => $item->atasan->nama,
                    'pegawai_id' => $item->pegawai_id,
                    'skp' => $item->skpRelasi->skp ?? null,
                    'link' => $item->link,
                    'created_at' => $item->created_at,
                    'updated_at' => $item->updated_at,
                ];
            });
        return response()->json($logHarian);
    }
}
