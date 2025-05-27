<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisPegawai extends Model
{
    protected $table = 'pegawai_jenis_kepegawaian';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama',
    ];
}
