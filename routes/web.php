<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AccountsController, PegawaiController, RequestController, SKPController, IntervensiSKPController, KelolaPegawaiController, ManagemenUserController, PeriodeController, SKPEvaluasi};
use App\Http\Controllers\{KalenderController, RekapController};
use App\Http\Controllers\PenilaianStaff\{PersetujuanSKPController, TriwulanController};

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
	Route::group(['prefix'=>'periode'], function(){
		Route::GET('/skp_periode',[PeriodeController::class, 'skp_periode'])->name('skp_periode');
		Route::GET('/set_active_periode/{id}', [PeriodeController::class, 'set_active_periode'])->name('set_active_periode');
		Route::POST('/skp_periodeAction',[PeriodeController::class, 'skp_periodeAction'])->name('skp_periodeAction');
		Route::POST('/skp_periode_del/',[PeriodeController::class, 'skp_periode_del'])->name('skp_periode_del');
	});
	Route::group(['prefix'=>'pegawai'], function(){
		Route::GET('/data_pegawai', [PegawaiController::class, 'Data_pegawai'])->name('data_pegawai');
		Route::GET('/detail/{id}',[PegawaiController::class, 'Detail_pegawai'])->name('detail');
		Route::GET('/json_pegawai',[PegawaiController::class, 'json_pegawai'])->name('json_pegawai');
		Route::POST('/update_atasan',[PegawaiController::class, 'update_atasan'])->name('update_atasan');
	});
	Route::group(['prefix'=>'user'], function(){
		Route::GET('/data_user',[ManagemenUserController::class, 'data_user'])->name('data_user');
		Route::POST('/userAdd',[ManagemenUserController::class, 'userAdd'])->name('userAdd');
		Route::POST('/userUpdate/{id}',[ManagemenUserController::class, 'userUpdate'])->name('userUpdate');
		Route::POST('/set_id_pegawai',[ManagemenUserController::class, 'set_id_pegawai'])->name('set_id_pegawai');
		Route::POST('/set_role_pegawai/', [ManagemenUserController::class, 'set_role_pegawai'])->name('set_role_pegawai');
		Route::GET('/set_active_pegawai/{id}', [ManagemenUserController::class, 'set_active_pegawai'])->name('set_active_pegawai');
	});
});

Route::group(['prefix'=> 'skp'], function(){
	Route::GET('/rencana_skp', [SKPController::class, 'index'])->name('rencana_skp');
	Route::GET('/rencana_skp_selected', [SKPController::class, 'periode'])->name('periodeSkp');
	Route::POST('/skpAdd', [SKPController::class, 'skpAdd'])->name('skpAdd');
	Route::PUT('/skpEdit/{id}', [SKPController::class, 'skpEdit'])->name('skpEdit');
	Route::DELETE('/skpDelete/{id}', [SKPController::class, 'skpDelete'])->name('skpDelete');
	Route::POST('/skpIndikatorAdd', [SKPController::class, 'skpIndikatorAdd'])->name('skpIndikatorAdd');
	Route::POST('/skpIndikatorEdit', [SKPController::class, 'skpIndikatorEdit'])->name('skpIndikatorEdit');
	Route::POST('/skpIndikatorDelete', [SKPController::class, 'skpIndikatorDelete'])->name('skpIndikatorDelete');
	Route::GET('/skpIndikatorGet/{id}', [SKPController::class, 'skpIndikatorGet'])->name('skpIndikatorGet');
});

Route::group(['prefix'=> 'intervensi'], function(){
	Route::GET('/intervensi_skp', [IntervensiSKPController::class, 'index'])->name('intervensi_skp');
	Route::GET('/intervensi_skp_selected', [IntervensiSKPController::class, 'periode'])->name('periodeIntervensi');
	Route::POST('/intervensiAdd', [IntervensiSKPController::class, 'intervensiAdd'])->name('intervensiAdd');
	Route::POST('/intervensiDelete', [IntervensiSKPController::class, 'intervensiDelete'])->name('intervensiDelete');
	Route::POST('/intervensiSetuju',[IntervensiSKPController::class, 'intervensiSetuju'])->name('intervensiSetuju');
	Route::GET('/indikatorGet/{pegawai_id}', [IntervensiSKPController::class, 'indikatorGet'])->name('indikatorGet');
});

Route::group(['prefix'=> 'evaluasi'], function(){
	Route::GET('/evaluasi_skp', [SKPEvaluasi::class, 'index'])->name('evaluasi_skp');
	Route::GET('/evaluasi_skp_selected', [SKPEvaluasi::class, 'periode'])->name('periodeEvaluasi');
});

Route::group(['prefix'=> 'log'], function(){
	Route::GET('/kalender', [KalenderController::class, 'index'])->name('kalender');
	Route::GET('/kalender_selected',[KalenderController::class, 'periode'])->name('periodeKalender');
	Route::POST('/kalenderAdd',[KalenderController::class, 'kalenderAdd'])->name('kalenderAdd');
	Route::POST('/kalenderEdit',[KalenderController::class, 'kalenderEdit'])->name('kalenderEdit');
	Route::POST('/kalenderHapus',[KalenderController::class, 'kalenderHapus'])->name('kalenderHapus');

	Route::GET('/rekap', [RekapController::class, 'index'])->name('rekap');
	Route::GET('/rekap_selected',[RekapController::class, 'periode'])->name('periodeRekap');
	Route::GET('/log-detail/{bulan}', [RekapController::class, 'getLogDetail']);
});

Route::group(['prefix'=>'staff'], function(){
	Route::GET('/persetujuan_skp',[PersetujuanSKPController::class, 'index'])->name('persetujuan_skp');
	Route::GET('/triwulan',[TriwulanController::class, 'index'])->name('triwulan');
});


Route::POST('/api/update_pegawai', [PegawaiController::class,'update_pegawai'])->name('update_pegawai');
Route::GET('/getFak',[RequestController::class,'getFak']);
Route::get('/getDep/{fakultas_id}', [RequestController::class, 'getDep']);