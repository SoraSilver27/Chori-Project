<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Maquinaria extends Model
{
    use HasFactory;
    protected $fillable = [
        "nombre",
        "numero_de_serie",
        "estado",
        "modelo",
        "imagen",
        "en_seguimiento",
        "fecha_adquisicion",
        "observaciones_generales",
    ];

    public function detalles() : HasMany{
        return $this->hasMany(MaquinariaDetalle::class, 'id_maquinaria', 'id');
    }
}
