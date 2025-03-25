<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menus extends Model
{
    use HasFactory;

    protected $table = 'menus';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'parent_code',
        'content',
        'route_name',
        'ordered',
        'icon',
        'created_at',
        'updated_at',
    ];
}