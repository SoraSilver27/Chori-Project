<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planilla extends Model
{
    use HasFactory;
    protected $timestamps = true;
    protected $fillable = [
        'es_de',
        'fecha',
        'encargado',
        'telefono_encargado'
    ];
}
