<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePlanillaPreventivaRequest extends FormRequest
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
                "id_mantenimiento" => ["required","string"],
                "horas_de_servicio" => ["required","integer"],
                "trabajo_mantenimiento" => ["required","string"],
            ];
        }else {
            return[
                "id_mentenimiento" => ["sometimes","string"],
                "horas_de_servicio" => ["sometimes","integer"],
                "trabajo_mantenimiento" => ["sometimes","string"],
            ];
        }
    }
}
