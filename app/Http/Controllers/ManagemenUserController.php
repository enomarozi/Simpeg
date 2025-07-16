<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use App\Models\{Pegawai, User};
use Hash;

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
    public function userAdd(Request $request){
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip_niku' => 'required|string|max:50|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'konfirmasi' => 'required|same:password'
        ], 
        [
            'nama.required' => 'Nama wajib diisi.',
            'nama.max' => 'Nama maksimal 255 karakter.',

            'nip_niku.required' => 'NIP/NIKU wajib diisi.',
            'nip_niku.max' => 'NIP/NIKU maksimal 50 karakter.',
            'nip_niku.unique' => 'NIP/NIKU sudah digunakan.',

            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',

            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',

            'konfirmasi.required' => 'Konfirmasi password wajib diisi.',
            'konfirmasi.same' => 'Konfirmasi password tidak cocok dengan password.'
        ]);
        User::create([
            'name' => $request->nama,
            'username' => $request->nip_niku,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        return redirect()->back()->with('success', 'User berhasil ditambahkan.');
    }
    public function userUpdate(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:50|unique:users,username,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6',
        ]);

        $user->name = $request->nama;
        $user->username = $request->username;
        $user->email = $request->email;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return redirect()->back()->with('success', 'User berhasil diperbarui.');
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
