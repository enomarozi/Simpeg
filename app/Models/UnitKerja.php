<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnitKerja extends Model
{
    protected $table = 'pegawai_informasi_unit_kerja';
    protected $fillable = [
        'pegawai_id',
        'tgl_masuk',
        'putusan',
        'no_surat_u',
        'tgl_sk',
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
    public $timestamps = false;
}
