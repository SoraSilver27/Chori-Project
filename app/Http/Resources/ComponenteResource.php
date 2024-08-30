<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ComponenteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            "id" => $this->id,
            "nombre" =>$this->nombre,
            "numero_de_serie" =>$this->numero_de_serie,
            "imagen" =>$this->imagen,
            "modelo" =>$this->modelo,
            "descripcion" =>$this->descripcion,
            "ubicacion" =>$this->ubicacion,
            "estado" =>$this->estado,
            //"planillas" => PlanillaResource::collection($this->whenLoaded("planillas")),
            //"preventivos" => MantenimientoPreventivoResource::collection($this->whenLoaded("preventivos")),
            "updated_at" => $this->updated_at,
            "created_at" => $this->created_at,
        ];
    }
}
