<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlanillaResource extends JsonResource
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
            "es_de" => $this->es_de,
            "id_maquina" => $this->id_maquina,
            "id_componente" => $this->id_componente,
            "fecha" => $this->fecha,
            "encargado" => $this->encargado,
            "telefono_encargado" => $this->telefono_encargado,
            "updated_at" => $this->updated_at,
            "created_at" => $this->created_at,
        ];
    }
}
