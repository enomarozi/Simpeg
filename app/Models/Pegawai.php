<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table = 'pegawai';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'nip',
        'nama',
        'gelar_depan',
        'gelar_belakang',
        'status',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'agama_id',
        'kategori_kepegawaian_id',
        'fakultas_id',
        'departemen_id',
        'kepangkatan_id',
        'tmt_pangkat',
        'jabatan_id',
        'perkawinan_id',
        'pendidikan_id',
        'tmt_pensiun',
        'tahun_pensiun',
        'kewarganegaraan_id',
        'negara_id',
        'created_at',
        'updated_at',
    ];
}
