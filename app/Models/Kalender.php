<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kalender extends Model
{
    use HasFactory;

    protected $table = 'kalender_log';

    protected $fillable = [
        'pegawai_id',
        'atasan_id',
        'periode_id',
        'tanggal',
        'nama_aktivitas',
        'deskripsi',
        'skp',
        'link',
    ];
    public function periode()
    {
        return $this->belongsTo(SkpPeriode::class, 'periode_id');
    }
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }
    public function atasan()
    {
        return $this->belongsTo(Pegawai::class, 'atasan_id');
    }
    public function skpRelasi()
    {
        return $this->belongsTo(Skp::class, 'skp');
    }
}
