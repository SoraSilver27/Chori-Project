<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMaquinariaDetalleRequest extends FormRequest
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
        return [
            "id_maquinaria" => ["required","nullable"],
            "capacidad_de_produccion" => ["integer","nullable"],
            "voltaje" => ["integer","nullable"],
            "peso" => ["integer","nullable"],
            "tipo" => ["required","string","nullable"],
            "velocidad_ajustable" => ["boolean","nullable"],
            "pantalla_digital" => ["boolean","nullable"],
            "facil_desmontaje" => ["boolean","nullable"],
            "garantia" => ["boolean","nullable"],
            "problemas_recurrentes" => ["string","nullable"],
            "periodo_mantenimiento" => ["nullable"],
            "mantenimiento" => ["required","nullable"],
        ];
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
