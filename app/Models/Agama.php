<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agama extends Model
{
    protected $table = 'pegawai_agama';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama',
    ];
}
