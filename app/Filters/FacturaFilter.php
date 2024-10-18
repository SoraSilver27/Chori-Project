<?php

namespace App\Filters;
use Illumite\Http\Request;
use App\Filters\ApiFilter;

class FacturaFilter extends ApiFilter{
    protected $safeParams = [
        "id" => ["eq"],
        "numero_de_compra" => ["eq","lt","lte","gt","gte"],
        "proveedor" => ["eq"],
        "encargado" => ["eq"],
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
