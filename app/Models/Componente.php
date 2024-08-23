<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Componente extends Model
{
    protected $table = "componentes";
    protected $primaryKey = 'ID';

    public $timestamps = false;
    protected $fillable = ["Nombre","Numero_de_serie","Imagen","Modelo","Descripcion","Ubicacion","Estado",];
}
