<?php

namespace App\Http\Controllers;

use App\Models\{ SKPPeriode, Pegawai, SKP, SKPIntervensi};
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
            return $next($request);
        });
    }
    public function index(){
        $title = "Intervensi";
        $SKPPeriode = SKPPeriode::all();
        return view('skp.intervensi',[
            'title'=>$title,
            'user'=>$this->user,
            'SKPPeriode'=>$SKPPeriode,
        ]);
    }
    public function periode(Request $request){
        $title = "Intervensi";
        $periode = $request->periode_id;
        $SKPPeriode = SKPPeriode::all();
        $daftarSkp = Skp::with(['periode'])
            ->where('pegawai_id', $this->user->pegawai_id)
            ->orderBy('created_at', 'desc')
            ->get();
        $daftarBawahan = Pegawai::where('atasan_id', $this->user->pegawai_id)->get();
        $daftarIntervensi = SKPIntervensi::with(['periode'])
            ->where('pegawai_id', $this->user->pegawai_id)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('skp.intervensi',[
            'title'=>$title,
            'user'=>$this->user,
            'periode'=>$periode,
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
        $daftarIntervensi = SKPIntervensi::Where('skp_id',$request->skp_intervensi)->first();
        if($daftarIntervensi !== null){
            return redirect()->back()->with('error', 'SKP sudah diintervensi.');
        }
        $intervensi = SkpIntervensi::create([
            'pegawai_id' => $this->user->pegawai_id,
            'bawahan_id' => $request->bawahan_id,
            'periode_id' => $request->periode_id,
            'skp_id' => $request->skp_intervensi,
        ]);
        return redirect()->back()->with('success', 'Intervensi SKP berhasil ditambahkan.');
    }
    public function intervensiDelete(Request $request){
        $intervensiDel = SKPIntervensi::where('id', $request->intervensi_id)
            ->where('skp_id', $request->skp_id)
            ->where('pegawai_id', $this->user->pegawai_id)
            ->delete();
        if ($intervensiDel) {
            return redirect()->back()->with('success', 'Intervensi berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Intervensi tidak ditemukan atau gagal dihapus.');
        }
    }
}
