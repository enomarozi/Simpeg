<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NamaBank extends Model
{
    protected $table = 'pegawai_nama_banks';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama',
    ];
}
