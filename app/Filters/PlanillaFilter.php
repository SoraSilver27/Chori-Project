<?php

namespace App\Filters;
use Illumite\Http\Request;
use App\Filters\ApiFilter;

class PlanillaFilter extends ApiFilter{
    protected $safeParams = [
        "id" => ["eq"],
        'es_de' => ["eq"],
        "tipo_planilla"=> ["eq"],
        'id_maquina' => ["eq"],
        'id_compontente' => ["eq"],
        'fecha' => ["eq"],
        'encargado' => ["eq"],
        'telefono_encargado' => ["eq"],
        "mantenimiento" => ["eq"],
        "problema_detectado" => ["eq"],
        "solucion_encontrada" => ["eq"],
        "que_se_pudo_realizar" => ["eq"],
        "requirio_tercerizacion" => ["eq"],
        "amerita_seguimiento" => ["eq"],
    ];
    protected $columnMap = [

    ];
    protected $operatorMap = [
        "eq" => "=",
        "lt" => "<",
        "lte" => "<=",
        "gt" => ">",
        "gte" => ">="
    ];
}
