<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use App\Models\{ SKPPeriode };

class PeriodeController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function($request, $next){
            $this->user = Auth::user();
            if (!$this->user->hasRole('admin')) {
                abort(403, 'Unauthorized');
            }
            return $next($request);
        });
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


