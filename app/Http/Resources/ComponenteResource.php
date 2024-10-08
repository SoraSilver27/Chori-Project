<?php

namespace App\Http\Resources;

use App\Models\Maquinaria;
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
        $maquinaria = $this->maquinaria;

        return[
            "id" => $this->id,
            "nombre" => $this->nombre,
            "numero_de_serie" => $this->numero_de_serie,
            "imagen" => $this->imagen,
            "modelo" => $this->modelo,
            "descripcion" => $this->descripcion,
            "ubicacion" => [
                "id" => $this->ubicacion,
                "nombre" => $maquinaria->nombre,
                "numero_de_serie" => $maquinaria->numero_de_serie,
            ],
            "estado" => $this->estado,
            "periodo_mantenimiento" => $this->periodo_mantenimiento,
            "ultimo_mantenimiento" => $this->ultimo_mantenimiento,
            "proximo_mantenimiento" => $this->proximo_mantenimiento,
            "mantenimiento" => $this->mantenimiento,
            "mantenimiento_detallado" => $this->mantenimiento_detallado,
            "fecha_ingreso" => $this->fecha_ingreso,
            "planillas" => PlanillaResource::collection($this->whenLoaded("planillas")),
            "updated_at" => $this->updated_at,
            "created_at" => $this->created_at,
        ];
    }
}
