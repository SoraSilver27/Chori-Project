<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maquinaria_detalle extends Model
{
    protected $table = "maquinaria__detalles";
    protected $primaryKey = 'ID_maquinaria';

    public $timestamps = false;
    protected $fillable = ["Capacidad_de_produccion","Voltaje","Peso","Tipo","Velocidad_ajustable","Pantalla_digital","Facil_desmontaje","Garantia","Problemas_recurrentes",];
}
