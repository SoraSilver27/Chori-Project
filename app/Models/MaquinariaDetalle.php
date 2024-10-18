<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MaquinariaDetalle extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = [
        "capacidad_de_produccion",
        "voltaje",
        "peso",
        "tipo",
        "velocidad_ajustable",
        "pantalla_digital",
        "facil_desmontaje",
        "garantia",
        "garantia_cantidad",
        "problemas_recurrentes",
        "periodo_mantenimiento",
        "mantenimiento",
    ];

    public function maquinaria() : BelongsTo{
        return $this->belongsTo(Maquinaria::class, 'maquinaria_id','id' );
    }
}
