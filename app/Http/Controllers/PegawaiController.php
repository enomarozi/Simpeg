<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;

class PegawaiController extends Controller
{
    public function Data_pegawai(){
        $title = "Data Pegawai";
        return view('admin/index',compact('title'));
    }

    public function Json_pegawai(){
        $pegawai = Pegawai::all();
        return response()->json($pegawai);
    }
}
