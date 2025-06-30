<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class KelolaPegawaiController extends Controller
{
    public function Kelola_pegawai(){
        return view("admin/kelola_pegawai");
    }
}
