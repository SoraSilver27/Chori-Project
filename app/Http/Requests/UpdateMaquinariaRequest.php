<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMaquinariaRequest extends FormRequest
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
                "numero_de_serie" => ["required","string","nullable"],
                "estado" => ["required",Rule::in(["En uso","Disponible","Indisponible"]),"nullable"],
                "modelo" => ["required","string","nullable"],
                "imagen" => ["binary","nullable"],
                "en_seguimiento" => ["boolean","nullable"],
                "seguimiento" => ["string","nullable"],
                "fecha_adquisicion" => ["required","nullable"],
                "observaciones_generales" => ["string","nullable"],
                "ultimo_mantenimiento" => ["sometimes"],
                "proximo_mantenimiento" => ["nullable"],
            ];
        }else{
            return[
                "nombre" => ["sometimes","string","nullable"],
                "numero_de_serie" => ["sometimes","string","nullable"],
                "estado" => ["sometimes",Rule::in(["En uso","Disponible","Indisponible"]),"nullable"],
                "modelo" => ["sometimes","string","nullable"],
                "imagen" => ["sometimes","string","nullable"],
                "en_seguimiento" => ["sometimes","nullable"],
                "seguimiento" => ["sometimes","string","nullable"],
                "fecha_adquisicion" => ["sometimes","nullable"],
                "observaciones_generales" => ["sometimes","string","nullable"],
                "ultimo_mantenimiento" => ["sometimes"],
                "proximo_mantenimiento" => ["nullable"],
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
            "en_seguimiento" => 0,
            "seguimiento"  => isset($data['en_seguimiento']) && $data['en_seguimiento'] == 0 ? 'Sin seguimiento' : 'Sin asignar',
            "fecha_aquisicion" => Carbon::now(),
            "observaciones_generales" => "Sin observaciones",
        ];

        foreach ($defaults as $campo => $valorDefault) {
            if (empty($data[$campo])) {
                $data[$campo] = $valorDefault;
            }
        }

        return $data;
    }
}
