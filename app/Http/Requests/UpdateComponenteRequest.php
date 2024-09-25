<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateComponenteRequest extends FormRequest
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
                "nombre" => ["required","string","nullable"],
                "numero_de_serie" => ["string","nullable"],
                "imagen" => ["binary","nullable"],
                "modelo" => ["required","string","nullable"],
                "descripcion" => ["string","nullable"],
                "ubicacion" => ["required","nullable"],
                "estado" => ["required",Rule::in(["En uso","Disponible","Indisponible"]),"nullable"],
            ];
        }else {
            return[
                "nombre" => ["sometimes","string","nullable"],
                "numero_de_serie" => ["sometimes","string","nullable"],
                "imagen" => ["sometimes","binary","nullable"],
                "modelo" => ["sometimes","string","nullable"],
                "descripcion" => ["sometimes","string","nullable"],
                "ubicacion" => ["sometimes","nullable"],
                "estado" => ["somentimes",Rule::in(["En uso","Disponible","Indisponible"]),"nullable"],
            ];
        }
    }
    public function validatedWithDefaults()
    {
        $data = $this->validated();


        $defaults = [
            "nombre" => "Sin asignar",
            "numero_de_serie" => "Sin asignar",
            "estado" => "Disponible",
            "modelo" => "Sin asignar",
            "ubicacion" => 1,
            "descripcion" => "Sin descripcion",
        ];

        foreach ($defaults as $campo => $valorDefault) {
            if (empty($data[$campo])) {
                $data[$campo] = $valorDefault;
            }
        }


        return $data;
    }
}
