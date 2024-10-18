<?php

namespace App\Filters;
use Illumite\Http\Request;
use App\Filters\ApiFilter;

class ComponenteFilter extends ApiFilter{
    protected $safeParams = [
        "id" => ["eq"],
        "nombre" => ["eq"],
        "numero_de_serie" => ["eq"],
        "estado" => ["eq"],
        "modelo" => ["eq"],
        "en_seguimiento" => ["eq"],
        "descripcion" => ["eq"],
        "ubicacion2" => ["eq"],
        "ubicacion" => ["eq"],
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
