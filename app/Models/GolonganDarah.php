<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GolonganDarah extends Model
{
    protected $table = 'pegawai_golongan_darah';
    protected $primaryKey = 'id';
    protected $fillable = [
        'golongan_darah',
    ];
}
