<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MantenimientoPreventivoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            "es_de" => $this->es_de,
            "id_maquina" =>$this->id_maquina,
            "id_componentes" =>$this->id_componentes,
            "intervalo_de_mantenimiento" =>$this->intervalo_de_mantenimiento,
            "horas_de_servicio" =>$this->horas_de_servicio,
            "ultimo_mantenimiento" =>$this->ultimo_mantenimiento,
            "que_se_hace" =>$this->que_se_hace,
            "updated_at" => $this->updated_at,
            "created_at" => $this->created_at,
        ];
    }
}
