<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlanillaCorrectiva extends Model
{
    use HasFactory;
    protected $fillable = [
        "problema_detectado",
        "solucion_encontrada",
        "que_se_pudo_realizar",
        "requirio_tercerizacion",
        "amerita_seguimiento"
    ];
    public function planillas() : BelongsTo{
        return $this->belongsTo(Planilla::class, "id","id_planilla");
    }
}
