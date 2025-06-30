<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SKPPeriode extends Model
{
    protected $table = 'skp_periode';

    protected $fillable = [
        'tahun',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
    ];
}

