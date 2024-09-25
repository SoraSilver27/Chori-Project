<?php

namespace App\Filters;
use Illumite\Http\Request;
use App\Filters\ApiFilter;

class MaquinariaDetalleFilter extends ApiFilter{
    protected $safeParams = [
        "id" => ["eq"],
        "id_maquinaria" => ["eq"],
        "capacidad_de_producción" => ["eq","gt","gte","lt","lte"],
        "voltaje" => ["eq","gt","gte","lt","lte"],
        "peso" => ["eq","gt","gte","lt","lte"],
        "tipo" => ["eq"],
        "velocidad_ajustable" => ["eq"],
        "pantalla_digital" => ["eq"],
        "facil_desmontaje" => ["eq"],
        "garantia" => ["eq"],
        "garantia_cantidad" => ["eq"],
        "problemas_recurrentes" => ["eq"],
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
