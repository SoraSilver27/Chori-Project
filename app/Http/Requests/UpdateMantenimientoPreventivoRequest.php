<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMantenimientoPreventivoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $method = $this->method();
        if($method == "PUT"){
            return[
                "es_de" => ["required","string"],
                "id_maquina" => ["required","string"],
                "id_componentes" => ["required","string"],
                "intervalo_de_mantenimiento" => ["required","string"],
                "horas_de_servicio" => ["required","integer"],
                "ultimo_mantenimiento" => ["date"],
                "que_se_hace" => ["required","string"],
            ];
        }else {
            return[
                "es_de" => ["sometimes","string"],
                "id_maquina" => ["sometimes","string"],
                "id_componentes" => ["sometimes","binary"],
                "intervalo_de_mantenimiento" => ["sometimes","string"],
                "horas_de_servicio" => ["sometimes","integer"],
                "ultimo_mantenimiento" => ["sometimes","date"],
                "que_se_hace" => ["somentimes","string"],
            ];
        }
    }
}
