<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Componente extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        "nombre",
        "numero_de_serie",
        "imagen",
        "modelo",
        "descripcion",
        "ubicacion",
        "estado"
    ];
}
