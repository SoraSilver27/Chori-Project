<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotaDelCalendarioResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "evento" => $this->evento,
            "fecha" => $this->fecha,
            "updated_at" => $this->updated_at,
            "created_at" => $this->created_at,
        ];
    }
}
