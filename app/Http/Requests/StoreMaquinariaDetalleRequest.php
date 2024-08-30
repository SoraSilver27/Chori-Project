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
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "capacidad_de_produccion" => ["required","string"],
            "voltaje" => ["required","string"],
            "peso" => ["integer"],
            "tipo" => ["required","string"],
            "velocidad_ajustable" => ["boolean"],
            "pantalla_digital" => ["boolean"],
            "facil_desmontaje" => ["boolean"],
            "garantia" => ["boolean"],
            "problemas_recurrentes" => ["boolean"],
        ];
    }
}
