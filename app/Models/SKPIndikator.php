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

    public function skp()
    {
        return $this->belongsTo(Skp::class, 'skp_id');
    }
}
