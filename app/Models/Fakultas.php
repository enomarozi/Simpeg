<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fakultas extends Model
{
    use HasFactory;

    protected $table = 'fakultas';

    protected $fillable = [
        'nama_fakultas',
    ];

    public function departemen()
    {
        return $this->hasMany(PegawaiDepartemen::class, 'fakultas_id');
    }
}