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
                "nombre" => ["required","string"],
                "numero_de_serie" => ["string"],
                "imagen" => ["binary"],
                "modelo" => ["required","string"],
                "descripcion" => ["string"],
                "ubicacion" => ["required"],
                "estado" => [Rule::in(["En uso","Disponible","Indisponible"])],
            ];
        }else {
            return[
                "nombre" => ["sometimes","string"],
                "numero_de_serie" => ["sometimes","string"],
                "imagen" => ["sometimes","binary"],
                "modelo" => ["sometimes","string"],
                "descripcion" => ["sometimes","string"],
                "ubicacion" => ["sometimes"],
                "estado" => ["somentimes",Rule::in(["En uso","Disponible","Indisponible"])],
            ];
        }
    }
}
