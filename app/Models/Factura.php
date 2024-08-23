<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    protected $table = "facturas";
    protected $primaryKey = "ID";
    protected $timestamps = false;
    protected $fillable = [
        'Numero_de_compra',
        'Fecha',
        'Proveedor',
        'Encargado',
    ];
}
