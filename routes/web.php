<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AccountsController, PegawaiController, RequestController, SKPController, KelolaPegawaiController};

Route::GET('/',[AccountsController::class,'index'])->middleware('auth')->name("index");

Route::group(['prefix' => 'account'], function () {
	Route::GET('/login',[AccountsController::class,'login'])->name("login");
	Route::POST('/loginAction',[AccountsController::class,'loginAction'])->name("loginAction");
	Route::GET('/logout',[AccountsController::class,'logout'])->name('logout');
	Route::GET('/registration',[AccountsController::class,'registration'])->name('registration');
	Route::POST('/registrationAction',[AccountsController::class,'registrationAction'])->name('registrationAction');
	Route::GET('/forgotpassword',[AccountsController::class,'forgotpassword'])->name('forgotpassword');
	Route::POST('/forgotpasswordAction',[AccountsController::class,'forgotpasswordAction'])->name('forgotpasswordAction');
	Route::GET('/reset-password/{token}', [AccountsController::class, 'showResetPasswordForm'])->name('reset.password.get');
	Route::GET('/profile',[AccountsController::class,'profile'])->middleware('auth')->name('profile');
	Route::GET('/setting',[AccountsController::class,'setting'])->middleware('auth')->name('setting');
	Route::POST('/passwordAction',[AccountsController::class,'passwordAction'])->middleware('auth')->name('passwordAction');
});

Route::group(['prefix'=> 'admin'], function(){
	Route::GET('/data_pegawai', [PegawaiController::class, 'Data_pegawai'])->name('data_pegawai');
	Route::GET('/detail/{id}',[PegawaiController::class, 'Detail_pegawai'])->name('detail');
	Route::GET('/json_pegawai',[PegawaiController::class, 'json_pegawai'])->name('json_pegawai');
	Route::POST('/update_atasan',[PegawaiController::class, 'update_atasan'])->name('update_atasan');
	Route::GET('/data_user',[PegawaiController::class, 'data_user'])->name('data_user');
	Route::POST('/set_id_pegawai',[PegawaiController::class, 'set_id_pegawai'])->name('set_id_pegawai');
	Route::POST('/set_role_pegawai/', [PegawaiController::class, 'set_role_pegawai'])->name('set_role_pegawai');
	Route::GET('/set_active_pegawai/{id}', [PegawaiController::class, 'set_active_pegawai'])->name('set_active_pegawai');
	Route::GET('/skp_periode',[SKPController::class, 'skp_periode'])->name('skp_periode');
	Route::POST('/skp_periodeAction',[SKPController::class, 'skp_periodeAction'])->name('skp_periodeAction');
	Route::POST('/skp_periode_del/{id}',[SKPController::class, 'skp_periode_del'])->name('skp_periode_del');
});

Route::GET('/rencana_skp', [SKPController::class, 'index'])->name('rencana_skp');
Route::GET('/rencana_skp_selected', [SKPController::class, 'periode'])->name('periode');
Route::POST('/skpadd', [SKPController::class, 'skpadd'])->name('skpadd');
Route::POST('/skpIndikator', [SKPController::class, 'skpIndikator'])->name('skpIndikator');


Route::POST('/api/update_pegawai', [PegawaiController::class,'update_pegawai'])->name('update_pegawai');

Route::GET('/getFak',[RequestController::class,'getFak']);
Route::get('/getDep/{fakultas_id}', [RequestController::class, 'getDep']);