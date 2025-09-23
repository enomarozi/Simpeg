<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\{ SKPPeriode, SKP, Kalender};
use Carbon\Carbon;

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
            'bulan'=>$request->bulan ?? null,
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
        $bulanIni = $request->bulan;
        $tanggal = Carbon::createFromDate($request->tahun, $bulanIni, 1);
        $daftarSkp = SKP::with(['periode'])
            ->where('pegawai_id', $this->user->pegawai_id)
            ->where('atasan_id',$this->user->pegawai->atasan_id)
            ->where('periode_id', $request->periode_id)
            ->orderBy('created_at', 'desc')
            ->get();
        $logHarian = Kalender::with(['periode','skpRelasi'])
            ->where('pegawai_id', $this->user->pegawai_id)
            ->where('atasan_id',$this->user->pegawai->atasan_id)
            ->where('periode_id', $request->periode_id)
            ->whereMonth('tanggal', $bulanIni)
            ->get();
        $terisi = count($logHarian);
        $belum_terisi = $tanggal->daysInMonth - $terisi;
        
    
        return view('log_harian.kalender',[
            'title'=> $title,
            'periode'=> $request->periode_id ?? null,
            'bulan'=>$request->bulan ?? null,
            'logHarian'=> $logHarian,
            'daftarSkp'=> $daftarSkp,
            'user'=> $this->user,
            'terisi'=> $terisi ?? null,
            'belum_terisi'=> $belum_terisi ?? null,
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
            'skp'=>'nullable|integer',
            'link'=>'nullable|url',
        ]);
        $skp_exist = SKP::with(['periode'])
                ->Where('id',$request->skp)
                ->Where('pegawai_id',$this->user->pegawai_id)
                ->Where('atasan_id',$this->user->pegawai->atasan_id)
                ->first();
        if(!$skp_exist){
            return redirect()->back()->with('error', 'Gagal Menambah Log Harian.');
        }    
        $kalender_exists = Kalender::where('tanggal', $request->tanggal)
                  ->where('periode_id', $request->periode_id)
                  ->where('pegawai_id', $this->user->pegawai_id)
                  ->exists();
        if($kalender_exists){
            return redirect()->back()->with('error', 'Log Harian sudah ada.');
        }
        Kalender::create([
            'pegawai_id' => $this->user->pegawai_id,
            'atasan_id'=> $this->user->pegawai->atasan_id,
            'periode_id' => $request->periode_id,
            'tanggal'=>$request->tanggal,
            'nama_aktivitas'=>$request->nama_aktivitas,
            'deskripsi' => $request->deskripsi,
            'skp' => $request->skp,
            'link' => $request->link,
        ]);
        return redirect()->back()->with('success', 'Log Harian berhasil ditambah.');
    }
    public function kalenderEdit(request $request){
        $kalender = Kalender::find($request->id);
        if (!$kalender) {
            return back()->with('error', 'Data tidak ditemukan.');
        }
        $request->validate([
            'nama_aktivitas'=>'required|string|min:3|max:255',
            'deskripsi'=>'required|string|min:5',
            'skp'=>'nullable|string',
            'link'=>'nullable|url',
        ]);
        $skp_exist = SKP::with(['periode'])
                ->Where('id',$request->skp)
                ->Where('pegawai_id',$this->user->pegawai_id)
                ->Where('atasan_id',$this->user->pegawai->atasan_id)
                ->first();
        if(!$skp_exist){
            return redirect()->back()->with('error', 'Gagal Menambah Log Harian.');
        }   
        $kalender_exists = Kalender::where('periode_id', $request->periode_id)
                  ->where('pegawai_id', $this->user->pegawai_id)
                  ->where('atasan_id', $this->user->pegawai->atasan_id)
                  ->exists();
        if(!$kalender_exists){
            return redirect()->back()->with('error', 'Log Harian gagal diupdate.');
        }
        $kalender->update([
            'nama_aktivitas'=>$request->nama_aktivitas,
            'deskripsi' => $request->deskripsi,
            'skp' => $request->skp,
            'link' => $request->link,
        ]);
        return redirect()->back()->with('success', 'Log Harian berhasil diupdate.');
    }
    public function kalenderHapus(request $request){
        dd(123);
    }
}
