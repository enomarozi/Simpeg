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
}
