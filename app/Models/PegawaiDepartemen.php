<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PegawaiDepartemen extends Model
{
    use HasFactory;

    protected $table = 'pegawai_departemen';

    protected $fillable = [
        'nama_departemen',
        'fakultas_id',
    ];

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class, 'fakultas_id');
    }
}
