<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth,Password,Validator};
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\{User,Roles};
use App\Mail\SendEmail;
use Hash;
use Mail;
use DB;

class AccountsController extends Controller
{
    public function index(){
        $title = "Dashboard";
        return view('dashboard/dashboard',compact('title'));
    }
    public function login(){
        return view('accounts/login');
    }
    public function loginAction(Request $request){
        $request->validate([
            'username' => 'required|string|max:30',
            'password' => 'required|string|',
        ]);

        $remember = $request->has('remember');
        if (Auth::attempt($request->only('username', 'password'), $remember)) {
            $user = Auth::user();
            if ($user->is_active == 0) {
                Auth::logout();
                return redirect()->back()->withErrors(['error' => 'Your account is not active.']);
            }
            return redirect()->route('index');
        }
        return redirect()->back()->withErrors(['error' => 'Username or Password is incorrect.']);
    }
    public function registration(){
        return view('accounts/registration');
    }
    public function registrationAction(Request $request){
        $validasi = $request->validate([
            'name'=>'required|min:3|max:40',
            'username'=>'required|min:3|max:30',
            'email'=>'required|min:5|max:60',
            'password'=>'required|min:8',
            'confirmpassword'=>'required|min:8|same:password',
        ]);

        $username = $request->input('username');
        $exists = User::where('username', $username)->exists();
        if ($exists) {
            return redirect()->back()->withErrors(['error' => 'Username has already been taken.']);
        } else {
            $user = new User();
            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect()->route('login')->withSuccess('User registered successfully.');
        }
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
        return view('accounts/setting',compact('title'));
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
    public function test(){
        return view('test');
    }
}
