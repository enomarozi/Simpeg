<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kalender extends Model
{
    use HasFactory;

    protected $table = 'kalender_log';

    protected $fillable = [
        'tanggal',
        'nama_aktivitas',
        'deskripsi',
        'periode_id',
        'skp',
        'link',
    ];
}
