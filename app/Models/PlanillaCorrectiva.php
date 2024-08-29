<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanillaCorrectiva extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        "problema_detectado",
        "solucion_encontrada",
        "que_se_pudo_realizar",
        "requirio_tercerizacion",
        "amerita_seguimiento"
    ];
}
