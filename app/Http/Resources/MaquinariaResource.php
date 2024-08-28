<?php

namespace App\Http\Resources;

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

        return [
            "id" => $this->id,
            "nombre" => $this->nombre,
            "numero_de_serie" => $this->numero_de_serie,
            "estado" => $this->estado,
            "modelo" => $this->modelo,
            "en_seguimiento" => $this->en_seguimiento,
            "fecha_adquisicion" => $this->fecha_adquisicion,
            "observaciones_generales" => $this->observaciones_generales,
            "detalles" => MaquinariaDetallesResource::collection($this->whenLoaded("detalles"))
        ];
    }
}
