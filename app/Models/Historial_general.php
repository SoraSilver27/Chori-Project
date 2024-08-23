<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historial_general extends Model
{
    protected $table = "historial__general";
    protected $primaryKey = '';

    public $timestamps = false;
    protected $fillable = ["Evento","Fecha"];
}
