<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Broadcasting\Channel;
//use App\Events\MantenimientoPreventivoComponenteEvent;
//use App\Events\StockEvent;

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

    public function planillas() : HasMany{
        return $this->hasMany(Planilla::class, "id_componente", "id");
    }
    public function maquinaria() : BelongsTo{
        return $this->belongsTo(Maquinaria::class, 'ubicacion','id' );
    }
    public function broadcastOn()
    {
        return new Channel('mantenimiento_componente-notice');
    }
}
/*
$componentes = Componente::where('stock', '<', 10)->get();
foreach ($componentes as $componente) {
    event(new StockEvent($componente));
}

event(new MantenimientoPreventivoComponenteEvent('El componente necesitará mantenimiento en: ', now()->addHours(2)));
*/
