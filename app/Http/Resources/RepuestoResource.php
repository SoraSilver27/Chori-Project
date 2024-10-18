<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RepuestoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "categoria" => $this->categoria,
            "cantidad" => $this->cantidad,
            "nombre" => $this->nombre,
            "descripcion" => $this->descripcion,
            "imagen" => $this->imagen,
            "fabricante" => $this->fabricante,
            "modelo" => $this->modelo,
            "updated_at" => $this->updated_at,
            "created_at" => $this->created_at,
        ];
    }
}
