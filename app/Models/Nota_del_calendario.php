<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nota_del_calendario extends Model
{
    protected $table = "notas__del__calendario";
    protected $primaryKey = "";
    protected $timestamps = false;
    protected $fillable = ["Evento","Fecha"];
}
