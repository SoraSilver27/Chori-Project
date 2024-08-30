<?php

namespace App\Http\Requests;

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
                "nombre" => ["required","string"],
                "numero_de_serie" => ["required","string"],
                "estado" => ["required",Rule::in(["En uso","Disponible","Indisponible"])],
                "modelo" => ["required","string"],
                "imagen" => ["binary"],
                "en_seguimiento" => ["required"],
                "fecha_adquisicion" => ["required"],
                "observaciones_generales" => ["string"]
            ];
        }else{
            return[
                "nombre" => ["sometimes","string"],
                "numero_de_serie" => ["sometimes","string"],
                "estado" => ["sometimes",Rule::in(["En uso","Disponible","Indisponible"])],
                "modelo" => ["sometimes","string"],
                "imagen" => ["sometimes","binary"],
                "en_seguimiento" => ["sometimes"],
                "fecha_adquisicion" => ["sometimes"],
                "observaciones_generales" => ["sometimes","string"]
            ];
        }
    }
}
