<?php

namespace App\Filters;
use Illumite\Http\Request;
use App\Filters\ApiFilter;

class HistorialGeneralFilter extends ApiFilter{
    protected $safeParams = [
        "id" => ["eq"],
        "evento" => ["eq"],
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
