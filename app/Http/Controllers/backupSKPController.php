<?php

namespace App\Http\Controllers;

use App\Models\SKP;
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

        if ($user->hasRole('admin') || $user->hasRole('atasan_langsung')){
            $skps = SKP::with('user')->get();
        } else {
            $skps = SKP::where('user_id', $user->id)->get();
            dd("Pegawai");
        }

        return view('skp.index', compact('skps','title'));
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

        if ($user->hasRole('admin') || $user->hasRole('atasan_langsung') || $user->id === $skp->user_id) {
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
}
