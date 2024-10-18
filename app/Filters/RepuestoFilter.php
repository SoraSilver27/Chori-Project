<?php

namespace App\Filters;
use Illumite\Http\Request;
use App\Filters\ApiFilter;

class RepuestoFilter extends ApiFilter{
    protected $safeParams = [
        "categoria" => ["eq"],
        "cantidad" => ["eq","lt","lte","gt","gte"],
        "nombre" => ["eq"],
        "descripcion" => ["eq"],
        "fabricante" => ["eq"],
        "modelo" => ["eq"],
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
