<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Negara extends Model
{
    protected $table = 'pegawai_Negara';
    protected $primaryKey = 'id';
    protected $fillable = [
        'negara',
    ];
}
