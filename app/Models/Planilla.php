<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Planilla extends Model
{
    use HasFactory;
    protected $timestamps = true;
    protected $fillable = [
        'es_de',
        'fecha',
        'encargado',
        'telefono_encargado'
    ];
    public function planillas_preventivas() : HasMany{
        return $this->hasMany(PlanillaPreventiva::class, "id_planilla","id");
    }
    public function planillas_correctivas() : HasMany{
        return $this->hasMany(PlanillaCorrectiva::class, "id_planilla","id");
    }

    public function componente() : BelongsTo{
        return $this->belongsTo(Componente::class, "id", "id_componente");
    }
    public function maquinaria() : BelongsTo{
        return $this->belongsTo(Componente::class, "id", "id_maquina");
    }
}

