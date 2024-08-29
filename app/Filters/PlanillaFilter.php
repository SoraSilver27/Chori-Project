<?php

namespace App\Filters;
use Illumite\Http\Request;
use App\Filters\ApiFilter;

class PlanillaFilter extends ApiFilter{
    protected $safeParams = [
        "id" => ["eq"],
        "es_de" => ["eq"],
        "id_maquina" => ["eq"],
        "id_componentes" => ["eq"],
        "encargado" => ["eq"],
        "telefono" => ["eq"],
        "fecha" => ["eq"],
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
