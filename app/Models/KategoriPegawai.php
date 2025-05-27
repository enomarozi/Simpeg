<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriPegawai extends Model
{
    protected $table = 'pegawai_kategori_kepegawaian';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_jenis_kepegawaian',
    ];
}
