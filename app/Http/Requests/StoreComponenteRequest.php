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
            "nombre" => ["required","string"],
            "numero_de_serie" => ["string"],
            "imagen" => ["binary"],
            "modelo" => ["required","string"],
            "descripcion" => ["string"],
            //"ubicacion" => [""],   hay que ver como se deja esto
            "estado" => ["required",Rule::in(["En uso","Disponible","Indisponible"])],
        ];
    }
}
