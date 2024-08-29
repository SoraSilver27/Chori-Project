<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanillaPreventiva extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = ["id_mantenimiento","horas_de_servicio","trabajo_mantenimiento"];
}
