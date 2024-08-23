<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repuesto extends Model
{
    protected $table = "repuestos";
    protected $primaryKey = "ID";
    protected $timestamps = false;
    protected $fillable = [
        'Cantidad',
        'Nombre',
        'Descripcion',
        'Imagen',
        'Fabricante',
        'Modelo',
    ];
}
