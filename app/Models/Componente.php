<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Componente extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        "nombre",
        "numero_de_serie",
        "imagen",
        "modelo",
        "descripcion",
        "ubicacion",
        "estado"
    ];
    public function preventivos() : HasMany{
        return $this->hasMany(MantenimientoPreventivo::class, "id_componente", "id");
    }
    public function planillas() : HasMany{
        return $this->hasMany(Planilla::class, "id_componente", "id");
    }

    public function maquinaria() : BelongsTo{
        return $this->belongsTo(Maquinaria::class, 'id', 'ubicacion');
    }
}
