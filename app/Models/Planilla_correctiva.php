<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planilla_correctiva extends Model
{
    protected $table = "planillas__correctivas";
    protected $primaryKey = 'ID';

    public $timestamps = false;
    protected $fillable = ["Problema_detectado","Solucion_encontrada","Que_se_pudo_realizar","Requirio_tercerizacion","Amerita_seguimiento"];
}


