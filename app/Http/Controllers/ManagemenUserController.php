<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use App\Models\{Pegawai, User};

class ManagemenUserController extends Controller
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

    public function data_user(){
        $title = "Managemen User";
        $users = User::with('roles:id,name')->select('id', 'name', 'username', 'email', 'pegawai_id', 'is_active')->get();
        $pegawai = Pegawai::select('id', 'nama')->get();
        $roles = Role::where('name', '!=', 'admin')->select('id', 'name')->get();
        return view('admin.managemen_user',[
            'title'=>$title,
            'user'=>$this->user,
            'pegawai'=>$pegawai,
            'users'=>$users,
            'roles'=>$roles,
        ]);
    }

    public function set_id_pegawai(Request $request){
        $validated = $request->validate([
            'username'   => ['required', 'string', 'exists:users,username'],
            'pegawai_id' => ['nullable', 'exists:pegawai,id'],
        ]);
        $user = User::where('username', $validated['username'])->first();
        if (!$user) {
            return back()->with('error', 'User tidak ditemukan.');
        }
        if ($user->username === 'administrator') {
            return back()->withErrors(['error' => 'Aksi tidak diperbolehkan pada akun administrator.']);
        }
        $user->update(['pegawai_id' => $validated['pegawai_id']]);
        return back()->with('success', 'Pegawai ID berhasil diperbarui.');
    }

    public function set_role_pegawai(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role' => 'required|exists:roles,name',
        ]);
        $user = User::find($request->user_id);
        if (!$user) {
            return back()->withErrors(['error' => 'User tidak ditemukan.']);
        }
        if ($user->username === 'administrator') {
            return back()->withErrors(['error' => 'Aksi tidak diperbolehkan pada akun administrator.']);
        }
        $user->syncRoles([$request->role]);
        return redirect()->back()->with('success', 'Role berhasil diperbarui.');
    }

    public function set_active_pegawai($id){
        $user = User::findOrFail($id);
        if ($user->username === 'administrator') {
            return back()->withErrors(['error' => 'Aksi tidak diperbolehkan pada akun administrator.']);
        }
        $user->is_active = $user->is_active ? 0 : 1;
        $user->save();

        $status = $user->is_active ? 'aktif' : 'nonaktif';

        return redirect()->back()->with('success', "User {$user->name} berhasil diubah menjadi {$status}.");
    }
}
