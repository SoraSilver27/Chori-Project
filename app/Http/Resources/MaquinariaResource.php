<?php

namespace App\Http\Resources;

use App\Models\Maquinaria;
use App\Events\MantenimientoPreventivoMaquinariaEvent;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MaquinariaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $mensaje = "La máquina {$this->nombre} necesita mantenimiento.";

        return [
            "id" => $this->id,
            "nombre" => $this->nombre,
            "numero_de_serie" => $this->numero_de_serie,
            "estado" => $this->estado,
            "modelo" => $this->modelo,
            "imagen" => $this->imagen,
            "en_seguimiento" => $this->en_seguimiento,
            "seguimiento" => $this->seguimiento,
            "fecha_adquisicion" => $this->fecha_adquisicion,
            "observaciones_generales" => $this->observaciones_generales,
            "detalles" => MaquinariaDetallesResource::collection($this->whenLoaded("detalles")),
            "componentes" => ComponenteResource::collection($this->whenLoaded("componentes")),
            "planillas" => PlanillaResource::collection($this->whenLoaded("planillas")),
            "ultimo_mantenimiento" => $this->ultimo_mantenimiento,
            "proximo_mantenimiento" => $this->proximo_mantenimiento,
            "updated_at" => $this->updated_at,
            "created_at" => $this->created_at,

        ];
    }
}
