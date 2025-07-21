<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SKPAtasanPegawai extends Model
{
    protected $table = 'skp_atasan_pegawai';

    protected $fillable = [
        'pegawai_id',
        'atasan_id',
        'periode_id',
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }

    // Relasi ke atasan
    public function atasan()
    {
        return $this->belongsTo(Pegawai::class, 'atasan_id');
    }

    // Relasi ke periode
    public function periode()
    {
        return $this->belongsTo(SkpPeriode::class, 'periode_id');
    }
}
