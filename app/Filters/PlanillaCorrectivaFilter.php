<?php

namespace App\Filters;
use Illumite\Http\Request;
use App\Filters\ApiFilter;

class PlanillaCorrectivaFilter extends ApiFilter{
    protected $safeParams = [
        "id" => ["eq"],
        "problema_detectado" => ["eq"],
        "solucion_encontrada" => ["eq"],
        "que_se_pudo_realizar" => ["eq"],
        "requirio_tercerizacion" => ["eq"],
        "amerita_seguimiento" => ["eq"],
        "fecha_adquisicion" => ["eq"],
        "observaciones_generales" => ["eq"],
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
