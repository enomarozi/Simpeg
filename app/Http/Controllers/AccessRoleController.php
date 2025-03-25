<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Permissions,Roles,User,AccessRole};

class AccessRoleController extends Controller
{
    public function access_role(){
        $users = User::all();
        $roles = Roles::all();
        $title = "Manage | Access Role";
        return view('configuration/roleAccess',compact('users','roles','title'));
    }
    public function crudAccessRole(Request $request){
        if($request->action == "DELETE"){
            $roles = AccessRole::findOrFail($request->id);
            if($roles->user !== "administrator"){
                $roles->delete();
                return redirect()->back()->withSuccess('Access Role Deleted successfully!');
            }
            return redirect()->back()->withErrors(['error'=>'Administrator status cannot be changed.']);
        }
        $validasi = $request->validate([
            'username'=>'required|min:2|max:30',
            'role'=>'required|min:2|max:30',
            'permission'=>'required|min:2|max:30',
        ]);
        $exists_user = AccessRole::where('user', $request->input('username'))->exists();
        $exists_role = AccessRole::where('role', $request->input('role'))->exists();
        if($request->action == "SAVE"){
            if ($exists_user || ($exists_user && $exists_role)) {
                return redirect()->back()->withErrors(['error' => ' Access Roles has already been taken.']);
            }else{
                if($request->username !== "administrator" && $request->role !== "administrator"){
                    AccessRole::create([
                        'user' => $request->username,
                        'role' => $request->role,
                        'permission'=>$request->permission,
                        'created_at'=>now(),
                        'updated_at'=>now(),
                    ]);
                    return redirect()->back()->withSuccess('Access Role Created successfully!');
                }
            }
            
        }elseif($request->action == "UPDATE"){
            $access_role = AccessRole::findOrFail($request->id);
            if($exists_user && $exists_role){
                return redirect()->back()->withErrors(['error' => ' Access Roles has already been taken.']);
            }else{
                if($request->username !== "administrator" && $request->role !== "administrator"){
                    $access_role->update([
                        'user' => $request->username,
                        'role' => $request->role,
                        'permission'=>$request->permission,
                        'updated_at' => now(),
                    ]);
                    return redirect()->back()->withSuccess('Access Role Updated successfully!');
                }
            }
        }
        return redirect()->back()->withErrors(['error' => 'Action failed. Please try again.']);
    }
    public function getAccessRole(){
        $ars = AccessRole::all();
        return response()->json($ars);
    }
}
