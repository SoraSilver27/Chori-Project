<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePlanillaRequest extends FormRequest
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
                "es_de" => ["required","string"],
                "fecha" => ["date"],
                "encargado" => ["required","string"],
                "telefono_encargado" => ["integer"],
            ];
        }else {
            return[
                "es_de" => ["sometimes","string"],
                "fecha" => ["sometimes","date"],
                "encargado" => ["sometimes","string"],
                "telefono_encargado" => ["sometimes","integer"],
            ];
        }
    }
}
