<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SKPIndikator extends Model
{
    use HasFactory;
    protected $table = 'skp_pegawai_indikator';
    protected $fillable = [
        'skp_id',
        'indikator',
    ];

    /**
     * Relasi ke model SKP (banyak indikator dimiliki oleh satu SKP).
     */
    public function skp()
    {
        return $this->belongsTo(Skp::class, 'skp_id');
    }
}
