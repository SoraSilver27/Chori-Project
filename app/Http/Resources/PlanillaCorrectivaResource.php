<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlanillaCorrectivaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "problema_detectado" => $this->problema_detectado,
            "solucion_encontrada" => $this->solucion_encontrada,
            "que_se_pudo_realizar" => $this->que_se_pudo_relizar,
            "requirio_tercerizacion" => $this->requirio_tercerizacion,
            "amerita_seguimiento" => $this->amerita_seguimiento,
            "updated_at" => $this->updated_at,
            "created_at" => $this->created_at,
        ];;
    }
}
