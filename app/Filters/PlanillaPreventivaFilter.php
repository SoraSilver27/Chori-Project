<?php

namespace App\Filters;
use Illumite\Http\Request;
use App\Filters\ApiFilter;

class PlanillaPreventivaFilter extends ApiFilter{
    protected $safeParams = [
        "id" => ["eq"],
        "mantenimiento" => ["eq"],
        "horas_de_servicio" => ["eq"],
        "trabajo_mantenimiento" => ["eq"],
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
