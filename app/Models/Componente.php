<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Componente extends Model
{
    use HasFactory;
    protected $fillable = [
        "nombre",
        "numero_de_serie",
        "imagen",
        "modelo",
        "descripcion",
        "ubicacion",
        "estado",
        "periodo_mantenimiento",
        "ultimo_mantenimiento",
        "proximo_mantenimiento",
        "mantenimiento",
        "mantenimiento_detallado",
        "fecha_ingreso",
    ];
    public function preventivos() : HasMany{
        return $this->hasMany(MantenimientoPreventivo::class, "id_componente", "id");
    }
    public function planillas() : HasMany{
        return $this->hasMany(Planilla::class, "id_componente", "id");
    }
    public function maquinaria() : BelongsTo{
        return $this->belongsTo(Maquinaria::class, 'ubicacion','id' );
    }
}
