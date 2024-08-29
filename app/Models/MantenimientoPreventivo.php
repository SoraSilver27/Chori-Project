<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MantenimientoPreventivo extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        "es_de",
        "id_maquina",
        "id_componentes",
        "intervalo_de_mantenimiento",
        "horas_de_servicio",
        "ultimo_mantenimiento",
        "que_se_hace"
    ];
}
