<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SKPIntervensi extends Model
{
    protected $table = 'skp_intervensi';

    protected $fillable = [
        'atasan_id',
        'pegawai_id',
        'periode_id',
        'skp_id',
        'status',
    ];

    /**
     * Relasi ke pegawai (bawahan)
     */
    public function bawahan()
    {
        return $this->belongsTo(Pegawai::class, 'atasan_id');
    }

    public function skp()
    {
        return $this->belongsTo(Skp::class, 'skp_id');
    }

    public function periode()
    {
        return $this->belongsTo(SkpPeriode::class, 'periode_id');
    }
}
