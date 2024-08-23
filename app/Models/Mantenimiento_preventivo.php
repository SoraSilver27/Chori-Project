<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mantenimiento_preventivo extends Model
{
    protected $table = "mantenimientos__preventivos";
    protected $primaryKey = 'ID';

    public $timestamps = false;
    protected $fillable = ["Es_de","ID_maquina","ID_componentes","Intervalo_de_mantenimiento","Horas_de_servicio","Ultimo_mantenimiento","Que_se_hace",];
}
