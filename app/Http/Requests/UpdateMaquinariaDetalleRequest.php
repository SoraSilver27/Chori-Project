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
        return true;
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
                "id_maquinaria" => ["sometimes"],
                "capacidad_de_produccion" => ["integer", "nullable"],
                "voltaje" => ["integer", "nullable"],
                "peso" => ["integer", "nullable"],
                "tipo" => ["string", "nullable"],
                "velocidad_ajustable" => ["boolean", "nullable"],
                "pantalla_digital" => ["boolean", "nullable"],
                "facil_desmontaje" => ["boolean", "nullable"],
                "garantia" => ["boolean", "nullable"],
                "garantia_cantidad" => ["string", "nullable"],
                "problemas_recurrentes" => ["string", "nullable"],
                "periodo_mantenimiento" => ["nullable"],
                "mantenimiento" => ["required","nullable"],
            ];
        }else {
            return[
                "id_maquinaria" => ["sometimes"],
                "capacidad_de_produccion" => ["sometimes","integer", "nullable"],
                "voltaje" => ["sometimes","integer", "nullable"],
                "peso" => ["sometimes","integer", "nullable"],
                "tipo" => ["sometimes","string", "nullable"],
                "velocidad_ajustable" => ["sometimes","boolean", "nullable"],
                "pantalla_digital" => ["sometimes","boolean", "nullable"],
                "facil_desmontaje" => ["sometimes","boolean", "nullable"],
                "garantia" => ["sometimes","boolean", "nullable"],
                "garantia_cantidad" => ["sometimes","string", "nullable"],
                "problemas_recurrentes" => ["sometimes","string", "nullable"],
                "periodo_mantenimiento" => ["nullable"],
                "mantenimiento" => ["sometimes","nullable"],
            ];
        }
    }
    public function validatedWithDefaults()
    {
        $data = $this->validated();


        $defaults = [
            "capacidad_de_produccion" => 0,
            "voltaje" => 0,
            "peso" => 0,
            "tipo" => "No establecido",
            "velocidad_ajustable" => 0,
            "pantalla_digital" => 0,
            "facil_desmontaje" => 0,
            "garantia" => 0,
            "garantia_cantidad"  => isset($data['garantia']) && $data['garantia'] == 0 ? 'Sin garantía' : 'Sin asignar',
            "problemas_recurrentes" => "Sin problemas recurrentes",
        ];

        foreach ($defaults as $campo => $valorDefault) {
            if (empty($data[$campo])) {
                $data[$campo] = $valorDefault;
            }
        }


        return $data;
    }

}
