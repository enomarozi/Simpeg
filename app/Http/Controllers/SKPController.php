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
        $daftarSkp = SKP::with(['periode', 'indikatorList'])
            ->where('pegawai_id', $this->user->pegawai_id)
            ->where('atasan_id',$this->user->pegawai->atasan_id)
            ->where('periode_id', $request->periode_id)
            ->orderBy('created_at', 'desc')
            ->get();
        $daftarIntervensi = SKPIntervensi::with(['periode'])
            ->where('pegawai_id', $this->user->pegawai_id)
            ->get();
        $statusSkp = null;
        if ($daftarSkp->isNotEmpty()) {
            $statusSkp = $daftarSkp[0]->status;
            $atasanId = Pegawai::find($daftarSkp[0]->atasan_id);
        }
        return view('skp.index',[
            'title'=> $title,
            'periode'=> $request->periode_id ?? null,
            'user'=> $this->user,
            'SKPPeriode' => $SKPPeriode,
            'daftarSkp' => $daftarSkp,
            'daftarIntervensi' => $daftarIntervensi,
            'statusSkp' => $statusSkp,
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
        }elseif($request->pelaksanaan_skp >= 1){
            $request->validate([
                'periode_id'=>'required',
                'pelaksanaan_skp'=>'required',
                'jenis_skp'=>'required|min:1|max:2',
            ]);
            $check = SKP::Where('pegawai_id',$this->user->pegawai_id)
                    ->Where('atasan_id',$this->user->pegawai->atasan->id)
                    ->Where('pelaksanaan_skp',$request->pelaksanaan_skp)
                    ->first();
            if($check !== null){
                return redirect()->back()->with('error', 'SKP sudah ada.');
            }

        }

        SKP::create([
            'pegawai_id' => $this->user->pegawai_id,
            'atasan_id'=> $this->user->pegawai->atasan_id,
            'periode_id' => $request->periode_id,
            'pelaksanaan_skp' => $request->pelaksanaan_skp,
            'jenis_skp' => $request->jenis_skp,
            'skp' => $request->skp,
        ]);
        return redirect()->back()->with('success', 'SKP berhasil ditambah.');
    }
    public function skpEdit(Request $request, $id){
        $skp = SKP::where('id', $id)
            ->where('pegawai_id', $this->user->pegawai_id)
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
            ->firstOrFail();
        $skp->delete();
        return redirect()->back()->with('success', 'SKP berhasil dihapus.');
    }
    public function skpIndikatorAdd(Request $request)
    {
        $skp = SKP::where('id', $request->skp_id)
            ->where('pegawai_id', $this->user->pegawai_id)
            ->firstOrFail();
        $validated = $request->validate([
            'skp_id' => ['required', 'integer', 'exists:skp,id'],
            'indikator' => ['required', 'string', 'max:255'],
        ]);
        SKPIndikator::create([
            'skp_id'   => $validated['skp_id'],
            'indikator' => $validated['indikator'],
        ]);
        return redirect()->back()->with('success', 'Poin indikator berhasil ditambahkan.');
    }
    public function skpIndikatorEdit(Request $request){
        $skp_id = $request->skp_id;
        $indikator_id = $request->input('indikator_id');
        $skp = SKP::where('id', $skp_id)
                  ->where('pegawai_id', $this->user->pegawai_id)
                  ->firstOrFail();
        if (!$skp) {
            return redirect()->back()->with('error', 'SKP tidak ditemukan atau bukan milik Anda.');
        }
        $indikator = SKPIndikator::where('id', $indikator_id)
                        ->where('skp_id', $skp_id)
                        ->firstOrFail();
        if (!$indikator) {
            return redirect()->back()->with('error', 'Indikator tidak ditemukan.');
        }
        $indikator->indikator = $request->indikator_update;
        $indikator->save();
        return redirect()->back()->with('success', 'Indikator berhasil diperbarui.');
    }
    public function skpIndikatorDelete(Request $request){
        $skp_id = $request->input('skp_id');
        $indikator_id = $request->input('indikator_id');
        $skp = SKP::where('id', $skp_id)
              ->where('pegawai_id', $this->user->pegawai_id)
              ->firstOrFail();
        if (!$skp) {
            return redirect()->back()->with('error', 'SKP tidak ditemukan atau bukan milik Anda.');
        }
        $deleted = SKPIndikator::where('skp_id', $skp_id)
                ->where('id', $indikator_id)
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
}
