<?php

namespace App\Http\Controllers;

use App\Models\{ SKPPeriode, Pegawai, SKP, SKPIndikator, SKPIntervensi};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SKPController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $title = "SKP";
        $user = Auth::user();
        $SKPperiode = [];
        if ($user->hasRole('pegawai') || $user->hasRole('atasan')){
            $SKPperiode = SKPPeriode::all();
        }
        $pegawai = Pegawai::find($user->pegawai_id);
        return view('skp.index', compact('title','user','SKPperiode','pegawai'));
    }
    public function skpAdd(Request $request)
    {
        $pegawai_id = Auth::user()->pegawai_id;
        $atasan_id = Pegawai::where('id', $pegawai_id)->value('atasan_id');
        $request->validate([
            'pegawai_id'=>'required',
            'atasan_id'=>'required',
            'periode_id'=>'required',
            'pelaksanaan_skp'=>'',
            'jenis_skp'=>'required|min:1|max:2',
            'skp'=>'required|string',
        ]);
        SKP::create([
            'pegawai_id' => $pegawai_id,
            'atasan_id'=> $atasan_id,
            'periode_id' => $request->periode_id,
            'pelaksanaan_skp' => $request->pelaksanaan_skp,
            'jenis_skp' => $request->jenis_skp,
            'skp' => $request->skp,
        ]);
        return redirect()->back()->with('success', 'SKP berhasil ditambah.');
    }
    public function skpEdit(Request $request, $id){
        $skp = SKP::findOrFail($id);
        $skp->update([
            'skp' => $request->skp,
            'jenis_skp' => $request->jenis_skp,
            'pegawai_id' => $request->pegawai_id,
        ]);

        return redirect()->back()->with('success', 'SKP berhasil diperbarui.');
    }
    public function skpDelete($id)
    {
        $user = Auth::user();
        $skp = SKP::where('id', $id)
            ->where('pegawai_id', $user->pegawai_id)
            ->firstOrFail();
        $skp->delete();
        return redirect()->back()->with('success', 'SKP berhasil dihapus.');
    }
    public function periode(Request $request)
    {
        $title = "SKP";
        $periode = $request->periode_id;
        $user = Auth::user();
        // dd($user->pegawai->atasan_id);
        $SKPperiode = [];
        if ($user->hasRole('pegawai') || $user->hasRole('atasan')){
            $SKPperiode = SKPPeriode::all();
        }
        $intervensiSkp = SKPIntervensi::with(['periode'])
            ->where('bawahan_id', $user->pegawai_id)
            ->get();
            
        $daftarSkp = SKP::with(['periode', 'indikatorList'])
            ->where('pegawai_id', $user->pegawai_id)
            ->where('atasan_id', $user->pegawai->atasan->id)
            ->orderBy('created_at', 'desc')
            ->get();
        $statusSkp = '';
        if(count($daftarSkp) >= 1){
            $statusSkp = $daftarSkp[0]->status;
        }
        $pegawai = $user->pegawai; 
        $atasan = $pegawai->atasan;
        return view('skp.index', compact('title','periode','user','SKPperiode','daftarSkp','statusSkp','pegawai','atasan','intervensiSkp'));
    }
    public function skpIndikator(Request $request)
    {
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
        $user = Auth::user()->pegawai_id;
        $skp_id = $request->input('skp_id');
        $indikator_id = $request->input('indikator_id');

        $skp = SKP::where('id', $skp_id)
                  ->where('pegawai_id', $user)
                  ->first();
        if (!$skp) {
            return redirect()->back()->with('error', 'SKP tidak ditemukan atau bukan milik Anda.');
        }
        $indikator = SKPIndikator::where('id', $indikator_id)
                        ->where('skp_id', $skp_id)
                        ->first();
        if (!$indikator) {
            return redirect()->back()->with('error', 'Indikator tidak ditemukan.');
        }
        $indikator->indikator = $indikator_id;
        $indikator->save();

        return redirect()->back()->with('success', 'Indikator berhasil diperbarui.');
    }
    public function skpIndikatorDelete(Request $request){
        $user = Auth::user()->pegawai_id;
        $skp_id = $request->input('skp_id');
        $indikator_id = $request->input('indikator_id');

        $skp = SKP::where('id', $skp_id)
              ->where('pegawai_id', $user)
              ->first();

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
        $indikators = SKPIndikator::where('skp_id', $id)->get(['id', 'indikator']);
        return response()->json($indikators);
    }
    public function skp_periode(){
        $user = Auth::user();
        $title = "SKP Periode";
        $periodeList = SKPPeriode::all(); 
        return view('admin.skp_periode', compact('title','user','periodeList'));
    }
    public function skp_periodeAction(Request $request){
        $user = Auth::user();
        $request->validate([
            'tahun' => 'required|numeric|min:2000|max:2100',
            'mulai' => 'required|date',
            'selesai' => 'required|date|after_or_equal:mulai',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        SKPPeriode::create([
            'tahun' => $request->tahun,
            'tanggal_mulai' => $request->mulai,
            'tanggal_selesai' => $request->selesai,
            'status' => $request->status,
        ]);
        return redirect()->back()->with('success', 'Periode SKP berhasil ditambah.');
    }
    public function skp_periode_del($id){
        $periode = SKPPeriode::find($id);
        if (!$periode) {
            return redirect()->back()->withErrors(['error' => 'Periode tidak ditemukan.']);
        }
        $periode->delete();
        return redirect()->back()->with('success', 'Periode berhasil dihapus.');
        }
    }
