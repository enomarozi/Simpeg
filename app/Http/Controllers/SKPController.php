<?php

namespace App\Http\Controllers;

use App\Models\{ SKPPeriode, Pegawai };
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
        $atasan = Pegawai::find($pegawai->atasan_id);
        return view('skp.index', compact('title','user','SKPperiode','pegawai','atasan'));
    }

    public function create()
    {
        return view('skp.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        SKP::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('skp.index')->with('success', 'SKP berhasil dibuat');
    }

    public function show(SKP $skp)
    {
        $user = Auth::user();

        if ($user->hasRole('admin') || $user->hasRole('atasan') || $user->id === $skp->user_id) {
            return view('skp.show', compact('skp'));
        }

        abort(403);
    }

    public function edit(SKP $skp)
    {
        $user = Auth::user();

        if ($user->hasRole('admin') || $user->id === $skp->user_id) {
            return view('skp.edit', compact('skp'));
        }

        abort(403);
    }

    public function update(Request $request, SKP $skp)
    {
        $user = Auth::user();

        if (! $user->hasRole('admin') && $user->id !== $skp->user_id) {
            abort(403);
        }

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        $skp->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('skp.index')->with('success', 'SKP berhasil diupdate');
    }

    public function destroy(SKP $skp)
    {
        $user = Auth::user();

        if (! $user->hasRole('admin') && $user->id !== $skp->user_id) {
            abort(403);
        }

        $skp->delete();

        return redirect()->route('skp.index')->with('success', 'SKP berhasil dihapus');
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
