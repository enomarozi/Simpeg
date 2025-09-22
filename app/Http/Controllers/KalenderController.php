<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\{ SKPPeriode, SKP };

class KalenderController extends Controller
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
        $title = "Kalender";
        $SKPPeriode = [];
        if ($this->user->hasRole('pegawai') || $this->user->hasRole('atasan')){
            $SKPPeriode = SKPPeriode::where('is_active', 1)->get();
        }
        return view("log_harian.kalender",[
            'title'=> $title,
            'user'=> $this->user,
            'SKPPeriode'=> $SKPPeriode,
            'periode'=> $request->periode_id ?? null,
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
        $title = "SKP";
        $daftarSkp = SKP::with(['periode'])
            ->where('pegawai_id', $this->user->pegawai_id)
            ->where('atasan_id',$this->user->pegawai->atasan_id)
            ->where('periode_id', $request->periode_id)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('log_harian.kalender',[
            'title'=> $title,
            'periode'=> $request->periode_id ?? null,
            'daftarSkp'=> $daftarSkp,
            'user'=> $this->user,
            'SKPPeriode' => $SKPPeriode,
        ]);
    }
    public function kalenderAdd(request $request)
    {
        $request->validate([
            'periode_id'=>'required',
            'tanggal'=>'required|date',
            'nama_aktivitas'=>'required|string|min:3|max:255',
            'deskripsi'=>'required|string|min:5',
            'skp'=>'nullable|string',
            'link'=>'nullable|url',
        ]);
        KalenderLog::create([
            'pegawai_id' => $this->user->pegawai_id,
            'atasan_id'=> $this->user->pegawai->atasan_id,
            'periode_id' => $request->periode_id,
            'pelaksanaan_skp' => $request->pelaksanaan_skp,
            'intervensi_skp' => $skp ?? $skp_intervensi->intervensi_skp,
            'jenis_skp' => $request->jenis_skp,
            'skp' => $request->skp ?? $skp_intervensi->skp,
        ]);
    }
}
