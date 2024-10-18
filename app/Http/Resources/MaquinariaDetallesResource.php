<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MaquinariaDetallesResource extends JsonResource
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
            "id_maquinaria" => $this->id_maquinaria,
            "capacidad_de_produccion" => $this->capacidad_de_produccion,
            "voltaje" => $this->voltaje,
            "peso" => $this->peso,
            "tipo" => $this->tipo,
            "velocidad_ajustable" => $this->velocidad_ajustable,
            "pantalla_digital" => $this->pantalla_digital,
            "facil_desmontaje" => $this->facil_desmontaje,
            "garantia" => $this->garantia,
            "garantia_cantidad" => $this->garantia_cantidad,
            "problemas_recurrentes" => $this->problemas_recurrentes,
            "periodo_mantenimiento" => $this->periodo_mantenimiento,
            "mantenimiento" => $this->mantenimiento,
        ];
    }
}
