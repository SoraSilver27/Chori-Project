<?php

namespace App\Filters;
use Illumite\Http\Request;
use App\Filters\ApiFilter;

class MantenimientoPreventivoFilter extends ApiFilter{
    protected $safeParams = [
        "id" => ["eq"],
        "es_de" => ["eq"],
        "id_maquina" => ["eq"],
        "id_componente" => ["eq"],
        "intervalo_de_mantenimiento" => ["eq"],
        "horas_de_servicio" => ["eq"],
        "ultimo_mantenimiento" => ["eq"],
        "que_se_hace" => ["eq"],
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
