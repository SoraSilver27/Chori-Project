<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FacturaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            "numero_de_compra" => $this->numero_de_compra,
            "fecha" =>$this->fecha,
            "proveedor" =>$this->proveedor,
            "encargado" =>$this->encargado,
            "updated_at" =>$this->updated_at,
            "created_at" =>$this->created_at,
        ];
    }
}
