<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlanillaPreventiva extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable =
    [
        "id_mantenimiento",
        "horas_de_servicio",
        "trabajo_mantenimiento"
    ];
    public function planillas() : BelongsTo{
        return $this->belongsTo(Planilla::class, "id","id_planilla");
    }
    public function preventivas() : BelongsTo{
        return $this->belongsTo(MantenimientoPreventivo::class, "id","mantenimiento");
    }
}
