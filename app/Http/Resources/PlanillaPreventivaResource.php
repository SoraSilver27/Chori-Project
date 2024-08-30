<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlanillaPreventivaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id_mantenimiento" => $this->id_mantenimiento,
            "horas_de_servicio" => $this->horas_de_servicio,
            "trabajo_mantenimiento" => $this->trabajo_mantenimiento,
            "updated_at" => $this->updated_at,
            "created_at" => $this->created_at,
        ];
    }
}
