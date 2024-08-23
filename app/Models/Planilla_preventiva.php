<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planilla_preventiva extends Model
{
    protected $table = "planillas__preventivas";
    protected $primaryKey = 'ID';

    public $timestamps = false;
    protected $fillable = ["ID_mantenimiento","Horas_de_servicio","Trabajo_mantenimiento"];
}


