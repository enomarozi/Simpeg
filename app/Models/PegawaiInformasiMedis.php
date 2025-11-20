<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PegawaiInformasiMedis extends Model
{
    protected $table = 'pegawai_informasi_medis';
    protected $fillable = [
        'pegawai_id',
        'golongan_darah_id',
        'tinggi_badan',
        'berat_badan',
        'cacat',
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
    public $timestamps = false;
}