<?php

namespace App\Filters;
use Illumite\Http\Request;
use App\Filters\ApiFilter;

class UtilizadoFilter extends ApiFilter{
    protected $safeParams = [
        "nombre_repuesto" => ["eq"],
        "cantidad" => ["eq","lt","lte","gt","gte"],
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
