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
        'pelaksanaan_skp',
        'intervensi_skp',
        'jenis_skp',
        'skp',
        'status',
        
    ];

    public function periode()
    {
        return $this->belongsTo(SkpPeriode::class, 'periode_id');
    }
    public function indikatorList()
    {
        return $this->hasMany(\App\Models\SKPIndikator::class, 'skp_id');
    }
    public function intervensi()
    {
        return $this->belongsTo(\App\Models\SKPIntervensi::class, 'pelaksanaan_skp');
    }
}

