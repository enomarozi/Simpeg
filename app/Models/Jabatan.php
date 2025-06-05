<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    protected $table = 'pegawai_jabatan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama',
    ];
}
