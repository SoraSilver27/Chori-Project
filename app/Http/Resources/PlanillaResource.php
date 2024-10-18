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
        $utilizados = $this->repuestosUtilizados->map(function ($repuesto) {
            return [
                "nombre" => $repuesto->nombre_repuesto,
                "cantidad" => $repuesto->cantidad,
            ];
        });
        return [
            "id" => $this->id,
            "es_de" => $this->es_de,
            "tipo_planilla" => $this->tipo_planilla,
            "aclarar" => $this->aclarar,
            "id_maquina" => $this->id_maquina,
            "id_componente" => $this->id_componente,
            "fecha" => $this->fecha,
            "encargado" => $this->encargado,
            "telefono_encargado" => $this->telefono_encargado,
            "mantenimiento" => $this->mantenimiento,
            "problema_detectado" => $this->problema_detectado,
            "solucion_encontrada" => $this->solucion_encontrada,
            "que_se_pudo_realizar" => $this->que_se_pudo_realizar,
            "requirio_tercerizacion" => $this->requirio_tercerizacion,
            "amerita_seguimiento" => $this->amerita_seguimiento,
            "repuestos_utilizados" =>  $utilizados,
            "updated_at" => $this->updated_at,
            "created_at" => $this->created_at,
        ];
    }
}
