<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth,Password,Validator};
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\{User,Roles};
use App\Mail\SendEmail;
use Spatie\Permission\Models\Role;
use Hash;
use Mail;
use DB;

class AccountsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except([
            'login', 
            'loginAction', 
            'registration', 
            'registrationAction', 
            'forgotpassword', 
            'forgotpasswordAction', 
            'showResetPasswordForm',
            'logout',
        ]);
    }

    public function index(){
        $user = Auth::user();
        $title = "Dashboard";
        return view('dashboard/dashboard',compact('title','user'));
    }
    public function login(){
        return view('accounts/login');
    }
    public function loginAction(Request $request){
        $request->validate([
            'username' => 'required|string|min:10|max:30',
            'password' => 'required|string|min:6|max:255',
        ]);

        $user = User::where('username', $request->username)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'error' => 'Username or Password is incorrect.'
            ])->withInput();
        }

        if (!$user->is_active) {
            return back()->withErrors([
                'error' => 'Your account is not active.'
            ])->withInput();
        }

        if (!$user->getRoleNames()->first()){
            return back()->withErrors([
                'error' => 'No role assigned. Please contact the administrator.'
            ])->withInput();
        }
        $remember = $request->has('remember');
        Auth::login($user, $remember);
        return redirect()->route('index');
    }
    public function registration(){
        return view('accounts/registration');
    }
    public function registrationAction(Request $request){
        $validasi = $request->validate([
            'name'=>'required|min:3|max:40',
            'username'=>'required|min:3|max:30|unique:users,username',
            'email'=>'required|email|max:60|unique:users,email',
            'password'=>'required|min:8',
            'confirmpassword'=>'required|min:8|same:password',
        ]);
        
        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->route('login')->withSuccess('User registered successfully.');
        
    }
    public function forgotpassword(){
        return view('accounts/forgotpassword');
    }
    public function forgotpasswordAction(Request $request){
        $request->validate([
            'username' => 'required|string',
        ]);
        $user = User::where('email', $request->username)
                ->orWhere('username', $request->username)
                ->first();
        if (!$user) {
            return redirect()->back()->withErrors(['error' => 'User not found.']);
        }
        $token = Str::random(60);
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $user->email],
            ['token' => $token, 'created_at' => Carbon::now()]
        );
        Mail::send('emails.reset_password', ['token' => $token], function($message) use($user) {
            $message->to($user->email);
            $message->subject('Reset Password');
        });
        return back()->with('success', 'We have e-mailed your password reset link!');
    }
    public function showResetPasswordForm($token)
    {
        return view('account/reset_password', ['token' => $token]);
    }
    public function profile(){
        $title = "Profile";
        $user = Auth::user();
        return view('accounts/profile',compact('user','title'));
    }
    public function setting(){
        $title = "Setting";
        $user = Auth::user();
        return view('accounts/setting',compact('user','title'));
    }
    public function passwordAction(Request $request){
        $validasi = $request->validate([
            'oldpassword'=>'required|min:8',
            'newpassword'=>'required|min:8',
            'confirmpassword'=>'required|min:8|same:newpassword',
        ]);
        if(Hash::check($request->oldpassword,Auth::user()->password)){
            $user = User::findOrFail(Auth::user()->id);
            $user->update([
                'password' => Hash::make($request->confirmpassword),
                'updated_at' => now(),
            ]);
            return redirect()->back()->withSuccess('Password has been successfully changed.');
        }
        return redirect()->back()->withErrors(['error' => 'Password change failed. Please try again.']);
        
    }
    public function logout(){
        Auth::logout();
        return redirect('account/login');
    }
}
