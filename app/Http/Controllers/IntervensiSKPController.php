<?php

namespace App\Http\Controllers;

use App\Models\{ SKPPeriode, Pegawai, SKP, SKPIntervensi, SKPAtasanPegawai, SKPIndikator};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class IntervensiSKPController extends Controller
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
        $title = "Intervensi";
        $SKPPeriode = [];
        if ($this->user->hasRole('pegawai') || $this->user->hasRole('atasan')){
            $SKPPeriode = SKPPeriode::where('is_active', 1)->get();
        }
        return view('skp.intervensi',[
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
        $title = "Intervensi";
        $daftarBawahan = Pegawai::where('atasan_id', $this->user->pegawai_id)->get();
        $daftarSkp = SKP::with(['periode', 'indikatorList'])
            ->where('pegawai_id', $this->user->pegawai_id)
            ->where('atasan_id', $this->user->pegawai->atasan_id)
            ->where('periode_id', $request->periode_id)
            ->orderBy('created_at', 'desc')
            ->get();
        $daftarIntervensi = SKPIntervensi::with(['periode'])
            ->where('atasan_id', $this->user->pegawai_id)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('skp.intervensi',[
            'title'=>$title,
            'periode'=>$request->periode_id ?? null,
            'user'=>$this->user,
            'SKPPeriode'=>$SKPPeriode,
            'daftarSkp'=>$daftarSkp,
            'daftarBawahan'=>$daftarBawahan,
            'daftarIntervensi'=>$daftarIntervensi,
        ]);
    }
    public function intervensiAdd(Request $request){
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
                    $query->where('is_active', 1);
                }),
            ],
            'skp_intervensi'=>'required|string',
        ]);

        $daftarIntervensi = SKPIntervensi::Where('skp_id',$request->skp_intervensi)
                ->Where('pegawai_id',$request->bawahan_id)
                ->Where('atasan_id',$this->user->pegawai_id)
                ->first();
        if($daftarIntervensi !== null){
            return redirect()->back()->with('error', 'SKP sudah diintervensi.');
        }
        $intervensi = SkpIntervensi::create([
            'atasan_id' => $this->user->pegawai_id,
            'pegawai_id' => $request->bawahan_id,
            'periode_id' => $request->periode_id,
            'skp_id' => $request->skp_intervensi,
        ]);
        return redirect()->back()->with('success', 'Intervensi SKP berhasil ditambahkan.');
    }
    public function intervensiSetuju(Request $request){
        $status = null;
        if($request->status === "setuju"){
            $status = "diterima";
        }elseif($request->status === "tolak"){
            $status = "ditolak";
        }
        if (!$status) {
            return back()->with('error', 'Status tidak valid.');
        }
        $indikator = SKPIntervensi::where('skp_id', $request->skp_setuju)
                ->where('id', $request->skpIndikator_setuju)
                ->where('pegawai_id', $this->user->pegawai_id)
                ->first();
        $skp = SKP::where('pegawai_id',$indikator->bawahan_id)
                ->where('bawahan_id',$indikator->pegawai_id)
                ->get();
        if ($indikator) {
            $indikator->status = $status;
            $indikator->save();
            return back()->with('success', 'Status intervensi berhasil diupdate.');
        } else {
            return back()->with('error', 'Indikator tidak ditemukan atau tidak valid.');
        }
    }
    public function intervensiDelete(Request $request){
        $intervensiDel = SKPIntervensi::where('id', $request->intervensi_id)
            ->where('skp_id', $request->skp_id)
            ->where('atasan_id', $this->user->pegawai_id)
            ->delete();
        if ($intervensiDel) {
            return redirect()->back()->with('success', 'Intervensi berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Intervensi tidak ditemukan atau gagal dihapus.');
        }
    }
    public function indikatorGet($pegawai_id)
    {   
        $skp = SKP::where('atasan_id', $this->user->pegawai_id)
              ->where('pegawai_id', $pegawai_id)
              ->first();
        if($skp){
            $indikators = SKPIndikator::where('skp_id', $skp->id)->get(['id', 'indikator']);
            return response()->json($indikators);
        }
        return response()->json([]);
    }
}
