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
        'tempat_lahir',
        'tanggal_lahir',
        'kategori_kepegawaian_id',
        'jenis_kepegawaian_id',
        'jabatan_id',
        'fakultas_id',
        'departemen_id',
        'jenis_kelamin',
        'agama_id',
        'status',
        'kewarganegaraan_id',
        'negara_id',
        'usia_pensiun',
        'kepangkatan_id',
        'tmt_pangkat',
        'perkawinan_id',
        'pendidikan_id',
        'tmt_pensiun',
        'tahun_pensiun',
        'atasan_id',
        'created_at',
        'updated_at',
    ];

    public function atasan()
    {
        return $this->belongsTo(Pegawai::class, 'atasan_id');
    }
    public function kalender()
    {
        return $this->hasMany(Kalender::class);
    }
}
