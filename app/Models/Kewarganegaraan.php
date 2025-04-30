<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kewarganegaraan extends Model
{
    protected $table = 'pegawai_Kewarganegaraan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'kewarganegaraan',
    ];
}
