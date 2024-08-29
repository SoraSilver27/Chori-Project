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
    public function componentes() : HasMany{
        return $this->hasMany(Componente::class, "ubicacion","id");
    }
    public function planillas() : HasMany{
        return $this->hasMany(Planilla::class, "id_maquina", "id");
    }
    public function preventivos() : HasMany{
        return $this->hasMany(MantenimientoPreventivo::class, "id_maquina", "id");
    }
}
