<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maquinaria extends Model
{
    protected $table = "maquinaria";
    protected $primaryKey = 'ID';
    public $timestamps = false;
    protected $fillable = [
        'Nombre',
        'Numero_de_serie',
        'Imagen',
        'Modelo',
        'En_seguimiento',
        'Fecha_adquisicion',
        'Observaciones_generales',
    ];


}
