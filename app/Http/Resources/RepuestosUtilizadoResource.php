<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RepuestosUtilizadoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id_planilla" => $this->id_planilla,
            "cantidad" => $this->cantidad,
            "nombre_repuesto" => $this->nombre_repuesto,
        ];
    }
}
