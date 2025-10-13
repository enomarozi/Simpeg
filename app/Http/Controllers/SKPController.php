<?php

namespace App\Http\Controllers;

use App\Models\{ SKPPeriode, Pegawai, SKPAtasanPegawai, SKP, SKPIndikator, SKPIntervensi};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Abort;

class SKPController extends Controller
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
        $title = "SKP";
        $SKPPeriode = [];
        if ($this->user->hasRole('pegawai') || $this->user->hasRole('atasan')){
            $SKPPeriode = SKPPeriode::where('is_active', 1)->get();
        }
        return view('skp.index', [
            'title'=> $title,
            'user'=> $this->user,
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
        $title = "SKP";
        $daftarSkp = SKP::with(['periode'])
            ->where('pegawai_id', $this->user->pegawai_id)
            ->where('atasan_id',$this->user->pegawai->atasan_id)
            ->where('periode_id', $request->periode_id)
            ->orderBy('created_at', 'desc')
            ->get();
        $daftarIntervensi = SKPIntervensi::with(['periode'])
            ->where('pegawai_id', $this->user->pegawai_id)
            ->where('periode_id', $request->periode_id)
            ->get();
        return view('skp.index',[
            'title'=> $title,
            'periode'=> $request->periode_id ?? null,
            'user'=> $this->user,
            'SKPPeriode' => $SKPPeriode,
            'daftarSkp' => $daftarSkp,
            'daftarIntervensi' => $daftarIntervensi,
        ]);
    }
    public function skpAdd(Request $request)
    {
        if($request->pelaksanaan_skp == 0){
            $request->validate([
                'periode_id'=>'required',
                'pelaksanaan_skp'=>'required',
                'jenis_skp'=>'required|min:1|max:2',
                'skp'=>'required|string',
            ]);
            $skp = $this->user->pegawai_id;
        }elseif($request->pelaksanaan_skp >= 1){
            $request->validate([
                'periode_id'=>'required',
                'pelaksanaan_skp'=>'required',
                'jenis_skp'=>'required|min:1|max:2',
            ]);
            $check_exist = SKP::with(['periode'])
                ->Where('pegawai_id',$this->user->pegawai_id)
                ->Where('atasan_id',$this->user->pegawai->atasan_id)
                ->Where('pelaksanaan_skp',$request->pelaksanaan_skp)
                ->first();
            if($check_exist){
                return redirect()->back()->with('error', 'SKP sudah ada.');
            }
            $check_val = SKPIntervensi::with(['periode'])
                ->Where('pegawai_id',$this->user->pegawai_id)
                ->Where('atasan_id',$this->user->pegawai->atasan_id)
                ->Where('skp_id',$request->pelaksanaan_skp)
                ->first();
            if($check_val === null){
                return redirect()->back()->with('error', 'SKP tidak diintervensi.');
            }
            $skp_intervensi = SKP::with(['periode'])
                    ->Where('pegawai_id',$this->user->pegawai->atasan_id)
                    ->Where('id',$request->pelaksanaan_skp)
                    ->select('skp', 'intervensi_skp')
                    ->first();
        }
        SKP::create([
            'pegawai_id' => $this->user->pegawai_id,
            'atasan_id'=> $this->user->pegawai->atasan_id,
            'periode_id' => $request->periode_id,
            'pelaksanaan_skp' => $request->pelaksanaan_skp,
            'intervensi_skp' => $skp ?? $skp_intervensi->intervensi_skp,
            'jenis_skp' => $request->jenis_skp,
            'skp' => $request->skp ?? $skp_intervensi->skp,
        ]);
        return redirect()->back()->with('success', 'SKP berhasil ditambah.');
    }
    public function skpEdit(Request $request, $id){
        $skp = SKP::where('id', $id)
            ->where('pegawai_id', $this->user->pegawai_id)
            ->where('pelaksanaan_skp',0)
            ->firstOrFail();
        $skp->update([
            'skp' => $request->skp,
            'jenis_skp' => $request->jenis_skp,
        ]);
        return redirect()->back()->with('success', 'SKP berhasil diperbarui.');
    }
    public function skpDelete($id)
    {
        $skp = SKP::where('id', $id)
            ->where('pegawai_id', $this->user->pegawai_id)
            ->where('pelaksanaan_skp',0)
            ->first();
        if($skp === null){
            return redirect()->back()->with('error', 'SKP tidak ditemukan.');
        }
        $delete_skp = SKP::where('intervensi_skp',$skp->intervensi_skp)
            ->where('skp',$skp->skp)
            ->delete();
        return redirect()->back()->with('success', 'SKP berhasil dihapus.');
    }
    public function skpIndikatorAdd(Request $request)
    {
        $skp = SKP::where('id', $request->skp_id)
            ->where('pegawai_id', $this->user->pegawai_id)
            ->firstOrFail();
        $validated = $request->validate([
            'skp_id' => 'required|integer|exists:skp,id',
            'indikator' => 'required|string|max:255',
        ]);
        SKPIndikator::create([
            'skp_id'   => $validated['skp_id'],
            'indikator' => $validated['indikator'],
        ]);
        return redirect()->back()->with('success', 'Poin indikator berhasil ditambahkan.');
    }
    public function skpIndikatorEdit(Request $request){
        $skp = SKP::where('id', $request->skp_id)
                  ->where('pegawai_id', $this->user->pegawai_id)
                  ->first();
        if (!$skp) {
            return redirect()->back()->with('error', 'SKP tidak ditemukan atau bukan milik Anda.');
        }
        $indikator = SKPIndikator::where('id', $request->indikator_id)
                        ->where('skp_id', $request->skp_id)
                        ->first();
        if (!$indikator) {
            return redirect()->back()->with('error', 'Indikator tidak ditemukan.');
        }
        $indikator->indikator = $request->indikator_update;
        $indikator->save();
        return redirect()->back()->with('success', 'Indikator berhasil diperbarui.');
    }
    public function skpIndikatorDelete(Request $request){
        $skp = SKP::where('id', $request->skp_id)
              ->where('pegawai_id', $this->user->pegawai_id)
              ->first();
        if (!$skp) {
            return redirect()->back()->with('error', 'SKP tidak ditemukan atau bukan milik Anda.');
        }
        $deleted = SKPIndikator::where('skp_id', $request->skp_id)
                ->where('id', $request->indikator_id)
                ->delete();
        if ($deleted) {
            return redirect()->back()->with('success', 'Indikator berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Indikator tidak ditemukan atau gagal dihapus.');
        }
    }
    public function skpIndikatorGet($id)
    {
        $skp = SKP::where('id', $id)
              ->where('pegawai_id', $this->user->pegawai_id)
              ->firstOrFail();
        if($skp){
            $indikators = SKPIndikator::where('skp_id', $id)->get(['id', 'indikator']);
            return response()->json($indikators);
        }
    }
    public function ajukanSKP($periode_id)
    {
        $activePeriode = SKPPeriode::where('is_active', 1)
           ->where('id', $periode_id)
           ->orderBy('updated_at', 'desc')
           ->first();
        if($activePeriode === null){
            return redirect()->back()->with('error', 'Periode tidak active.');
        }
        $updateCount = SKP::where('periode_id', $periode_id)
                   ->where('pegawai_id', $this->user->pegawai_id)
                   ->whereIn('status', ['draft', 'ditolak'])
                   ->update(['status' => 'diajukan']);
        if($updateCount == 0){
            return redirect()->back()->with('error', 'Tidak ada SKP yg diajukan.');
        }
        return redirect()->back()->with('success', $updateCount.' SKP berhasil sudah diajukan.');
    }
}
