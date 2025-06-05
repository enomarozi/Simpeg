<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AccountsController, PegawaiController, RequestController};

Route::GET('/',[AccountsController::class,'index'])->middleware('auth')->name("index");

Route::group(['prefix' => 'account'], function () {
	Route::GET('/login',[AccountsController::class,'login'])->name("login");
	Route::POST('/loginAction',[AccountsController::class,'loginAction'])->name("loginAction");
	Route::GET('/logout',[AccountsController::class,'logout'])->name('logout');
	Route::GET('/registration',[AccountsController::class,'registration'])->name('registration');
	Route::POST('/registrationAction',[AccountsController::class,'registrationAction'])->name('registrationAction');
	Route::GET('/forgotpassword',[AccountsController::class,'forgotpassword'])->name('forgotpassword');
	Route::POST('/forgotpasswordAction',[AccountsController::class,'forgotpasswordAction'])->name('forgotpasswordAction');

	Route::get('/reset-password/{token}', [AccountsController::class, 'showResetPasswordForm'])->name('reset.password.get');

	Route::GET('/profile',[AccountsController::class,'profile'])->middleware('auth')->name('profile');
	Route::GET('/setting',[AccountsController::class,'setting'])->middleware('auth')->name('setting');
	Route::POST('/passwordAction',[AccountsController::class,'passwordAction'])->middleware('auth')->name('passwordAction');
});

Route::group(['prefix'=> 'admin'], function(){
	Route::GET('/data_pegawai', [PegawaiController::class, 'Data_pegawai'])->name('data_pegawai');
	Route::GET('/detail/{id}',[PegawaiController::class, 'Detail_pegawai'])->name('detail');
	Route::GET('/kelola_pegawai', [PegawaiController::class, 'Kelola_pegawai'])->name('kelola_pegawai');
	Route::GET('/json_pegawai',[PegawaiController::class, 'json_pegawai'])->name('json_pegawai');
});

Route::POST('/api/update_pegawai', [PegawaiController::class,'update_pegawai'])->name('update_pegawai');

Route::GET('/getFak',[RequestController::class,'getFak']);
Route::get('/getDep/{fakultas_id}', [RequestController::class, 'getDep']);