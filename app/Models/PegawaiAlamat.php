<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PegawaiAlamat extends Model
{
    protected $table = 'pegawai_informasi_alamat';
    protected $fillable = [
        'pegawai_id',
        'provinsi',
        'kabupaten_kota',
        'kecamatan',
        'alamat_lengkap',
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
    public $timestamps = false;
}
