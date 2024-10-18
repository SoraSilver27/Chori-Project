<?php

namespace App\Filters;
use Illumite\Http\Request;
use App\Filters\ApiFilter;

class CategoriaRepuestoFilter extends ApiFilter{
    protected $safeParams = [
        "nombre" => ["eq"],
        "descripcion" => ["eq"],
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
