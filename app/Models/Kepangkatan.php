<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kepangkatan extends Model
{
    protected $table = 'pegawai_kepangkatan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'pangkat',
        'golongan',
    ];
}
