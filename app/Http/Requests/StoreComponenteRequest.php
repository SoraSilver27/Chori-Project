<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreComponenteRequest extends FormRequest
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
            //
            "nombre" => ["required","string","nullable"],
            "numero_de_serie" => ["string","nullable"],
            "imagen" => ["binary","nullable"],
            "modelo" => ["required","string","nullable"],
            "descripcion" => ["string","nullable"],
            "ubicacion" => ["nullable"],
            "periodo_mantenimiento" => ["nullable"],
            "ultimo_mantenimiento" => ["sometimes"],
            "proximo_mantenimiento" => ["nullable"],
            "mantenimiento" => ["required"],
            "mantenimiento_detallado" => ["sometimes", "nullable"],
            "fecha_ingreso" => ["nullable"],
            "estado" => ["required",Rule::in(["En uso","Disponible","Indisponible"]),"nullable"],
        ];
    }
    public function validatedWithDefaults()
    {
        $data = $this->validated();


        $defaults = [
            "nombre" => "Sin asignar",
            "numero_de_serie" => "Sin asignar",
            "estado" => "Disponible",
            "modelo" => "Sin asignar",
            "ubicacion" => null,
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
