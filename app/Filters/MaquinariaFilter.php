<?php

namespace App\Filters;
use Illumite\Http\Request;
use App\Filters\ApiFilter;

class MaquinariaFilter extends ApiFilter{
    protected $safeParams = [
        "id" => ["eq"],
        "nombre" => ["eq"],
        "numero_de_serie" => ["eq"],
        "estado" => ["eq"],
        "modelo" => ["eq"],
        "en_seguimiento" => ["eq"],
        "seguimiento" => ["eq"],
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
