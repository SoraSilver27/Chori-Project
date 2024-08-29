<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MantenimientoPreventivo extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        "es_de",
        "id_maquina",
        "id_componentes",
        "intervalo_de_mantenimiento",
        "horas_de_servicio",
        "ultimo_mantenimiento",
        "que_se_hace"
    ];
    public function preventivas() : HasMany{
        return $this->hasMany(PlanillaPreventiva::class, "mantenimiento","id");
    }
    public function maquinaria() : BelongsTo{
        return $this->belongsTo(Maquinaria::class, "id", "id_maquina");
    }
    public function componente() : BelongsTo{
        return $this->belongsTo(Componente::class, "id", "id_componente");
    }
}
