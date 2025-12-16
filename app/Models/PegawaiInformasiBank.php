<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PegawaiInformasiBank extends Model
{
    protected $table = 'pegawai_informasi_bank';
    protected $fillable = [
        'pegawai_id',
        'bank_id',
        'no_rekening',
        'nama_penerima',
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
    public $timestamps = false;
}
