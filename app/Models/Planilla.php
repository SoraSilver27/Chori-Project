<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planilla extends Model
{
    protected $table = "planillas";
    protected $primaryKey = "ID";
    protected $timestamps = false;
    protected $fillable = [
        'Es_de',
        'Fecha',
        'Encargado',
        'Telefono_encargado',
    ];

}
