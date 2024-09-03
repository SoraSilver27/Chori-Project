<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMaquinariaRequest extends FormRequest
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
            "nombre" => ["required","string"],
            "numero_de_serie" => ["string"],
            "estado" => [Rule::in(["En uso","Disponible","Indisponible"])],
            "modelo" => ["required","string"],
            "imagen" => ["binary"],
            "en_seguimiento" => ["boolean"],
            "fecha_adquisicion" => ["required"],
            "observaciones_generales" => ["string"]
        ];
    }
}
