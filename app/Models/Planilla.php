<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Planilla extends Model
{
    use HasFactory;
    protected $fillable = [
        'es_de',
        "tipo_planilla",
        "aclarar",
        'id_maquina',
        'id_compontente',
        'fecha',
        'encargado',
        'telefono_encargado',
        "mantenimiento",
        "problema_detectado",
        "solucion_encontrada",
        "que_se_pudo_realizar",
        "requirio_tercerizacion",
        "amerita_seguimiento",
    ];

    public function componente() : BelongsTo{
        return $this->belongsTo(Componente::class, "id_componente","id" );
    }
    public function maquinaria() : BelongsTo{
        return $this->belongsTo(Componente::class, "id_maquina","id" );
    }
    public function repuestosUtilizados()
{
    return $this->hasMany(RepuestosUtilizado::class, 'id_planilla',"id");
}

}

