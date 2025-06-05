<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Fakultas};
use DB;

class RequestController extends Controller
{
    public function getFak(){
        $fak = Fakultas::all();
        return response()->json($fak);
    }
    public function getDep($fakultas_id){
        $departemen = DB::table('pegawai_departemen')
        ->where('fakultas_id', $fakultas_id)
        ->select('id', 'nama_departemen')
        ->get();

        return response()->json($departemen);
    }
}
