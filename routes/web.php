<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AccountsController, PegawaiController, RequestController, SKPController, IntervensiSKPController, KelolaPegawaiController, ManagemenUserController, PeriodeController};

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
	Route::group(['prefix'=>'pegawai'], function(){
		Route::GET('/data_pegawai', [PegawaiController::class, 'Data_pegawai'])->name('data_pegawai');
		Route::GET('/detail/{id}',[PegawaiController::class, 'Detail_pegawai'])->name('detail');
		Route::GET('/json_pegawai',[PegawaiController::class, 'json_pegawai'])->name('json_pegawai');
		Route::POST('/update_atasan',[PegawaiController::class, 'update_atasan'])->name('update_atasan');
	});
	Route::group(['prefix'=>'periode'], function(){
		Route::GET('/skp_periode',[PeriodeController::class, 'skp_periode'])->name('skp_periode');
		Route::GET('/set_active_periode/{id}', [PeriodeController::class, 'set_active_periode'])->name('set_active_periode');
		Route::POST('/skp_periodeAction',[PeriodeController::class, 'skp_periodeAction'])->name('skp_periodeAction');
		Route::POST('/skp_periode_del/{id}',[PeriodeController::class, 'skp_periode_del'])->name('skp_periode_del');
	});
	Route::group(['prefix'=>'user'], function(){
		Route::GET('/data_user',[ManagemenUserController::class, 'data_user'])->name('data_user');
		Route::POST('/userAdd',[ManagemenUserController::class, 'userAdd'])->name('userAdd');
		Route::POST('/userUpdate',[ManagemenUserController::class, 'userUpdate'])->name('userUpdate');
		Route::POST('/set_id_pegawai',[ManagemenUserController::class, 'set_id_pegawai'])->name('set_id_pegawai');
		Route::POST('/set_role_pegawai/', [ManagemenUserController::class, 'set_role_pegawai'])->name('set_role_pegawai');
		Route::GET('/set_active_pegawai/{id}', [ManagemenUserController::class, 'set_active_pegawai'])->name('set_active_pegawai');
	});
});

Route::GET('/rencana_skp', [SKPController::class, 'index'])->name('rencana_skp');
Route::GET('/rencana_skp_selected', [SKPController::class, 'periode'])->name('periode');
Route::POST('/skpAdd', [SKPController::class, 'skpAdd'])->name('skpAdd');
Route::PUT('/skpEdit/{id}', [SKPController::class, 'skpEdit'])->name('skpEdit');
Route::DELETE('/skpDelete/{id}', [SKPController::class, 'skpDelete'])->name('skpDelete');
Route::POST('/skpIndikator', [SKPController::class, 'skpIndikator'])->name('skpIndikator');
Route::POST('/skpIndikatorEdit', [SKPController::class, 'skpIndikatorEdit'])->name('skpIndikatorEdit');
Route::GET('/skpIndikatorGet/{id}', [SKPController::class, 'skpIndikatorGet'])->name('skpIndikatorGet');
Route::POST('/skpIndikatorDelete', [SKPController::class, 'skpIndikatorDelete'])->name('skpIndikatorDelete');

Route::GET('/intervensi_skp', [IntervensiSKPController::class, 'index'])->name('intervensi_skp');
Route::GET('/intervensi_skp_selected', [IntervensiSKPController::class, 'periode'])->name('periodeIntervensi');
Route::POST('/intervensiAdd', [IntervensiSKPController::class, 'intervensiAdd'])->name('intervensiAdd');

Route::POST('/api/update_pegawai', [PegawaiController::class,'update_pegawai'])->name('update_pegawai');

Route::GET('/getFak',[RequestController::class,'getFak']);
Route::get('/getDep/{fakultas_id}', [RequestController::class, 'getDep']);