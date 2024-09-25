<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMantenimientoPreventivoRequest extends FormRequest
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
            "es_de" => ["required","boolean"],
            "id_maquina" => ["required","id"],
            "id_componente" => ["required","id"],
            "intervalo_de_mantenimiento" => ["required","string"],
            "horas_de_servicio" => ["required","integer"],
            "ultimo_mantenimiento" => ["required","date"],
            "que_se_hace" => ["required","string"],
        ];
    }
}
