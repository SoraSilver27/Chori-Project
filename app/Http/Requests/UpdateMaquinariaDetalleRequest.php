<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMaquinariaDetalleRequest extends FormRequest
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
                "capacidad_de_produccion" => ["integer"],
                "voltaje" => ["integer"],
                "peso" => ["integer"],
                "tipo" => ["string"],
                "velocidad_ajustable" => ["boolean"],
                "pantalla_digital" => ["boolean"],
                "facil_desmontaje" => ["boolean"],
                "garantia" => ["boolean"],
                "problemas_recurrentes" => ["string"],
            ];
        }else {
            return[
                "capacidad_de_produccion" => ["sometimes","integer"],
                "voltaje" => ["sometimes","integer"],
                "peso" => ["sometimes","integer"],
                "tipo" => ["sometimes","string"],
                "velocidad_ajustable" => ["sometimes","boolean"],
                "pantalla_digital" => ["sometimes","boolean"],
                "facil_desmontaje" => ["somentimes","boolean"],
                "garantia" => ["sometimes","boolean"],
                "problemas_recurrentes" => ["sometimes","boolean"]
            ];
        }
    }
}
