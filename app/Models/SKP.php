<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skp extends Model
{
    protected $table = 'skp';

    protected $fillable = [
        'pegawai_id',
        'atasan_id',
        'periode_id',
        'intervensi_skp_id',
        'jenis_skp',
        'skp',
        'status',
        
    ];

    public function periode()
    {
        return $this->belongsTo(SkpPeriode::class, 'periode_id');
    }
}

