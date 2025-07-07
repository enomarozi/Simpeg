<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skp extends Model
{
    protected $table = 'skp';

    protected $fillable = [
        'pegawai_id',
        'intervensi_rhk_id',
        'jenis_rhk',
        'rencana_hasil_kerja',
        'status',
        'periode_id',
    ];

    public function periode()
    {
        return $this->belongsTo(SkpPeriode::class, 'periode_id');
    }
}

