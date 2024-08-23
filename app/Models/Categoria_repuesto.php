<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria_repuesto extends Model
{
    protected $table = "categoria__repuestos";
    protected $primaryKey = 'Nombre';

    public $timestamps = false;
    protected $fillable = ["Descripcion","Imagen"];
}

