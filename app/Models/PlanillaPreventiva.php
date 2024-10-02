<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlanillaPreventiva extends Model
{
    use HasFactory;
    protected $fillable =
    [
        "id_mantenimiento",
        "horas_de_servicio",
        "trabajo_mantenimiento"
    ];
    public function planillas() : BelongsTo{
        return $this->belongsTo(Planilla::class, "id_planilla","id");
    }
    public function preventivas() : BelongsTo{
        return $this->belongsTo(MantenimientoPreventivo::class, "mantenimiento","id");
    }
}
