<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusPerkawinan extends Model
{
    protected $table = 'pegawai_status_perkawinan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama',
    ];
}
