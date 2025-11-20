<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PegawaiInformasiId extends Model
{
    protected $table = 'pegawai_informasi_id';
    protected $fillable = [
        'pegawai_id',
        'no_ktp',
        'no_npwp',
        'no_bpjs_tenaga_kerja',
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
    public $timestamps = false;
}
