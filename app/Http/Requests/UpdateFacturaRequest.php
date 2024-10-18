<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class UpdateFacturaRequest extends FormRequest
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
                "numero_de_compra" => ["required","string"],
                "fecha" => ["required","date","nullable"],
                "proveedor" => ["required","string"],
                "encargado" => ["required","string"],
            ];
        }else {
            return[
                "nombre" => ["sometimes","string"],
                "facha" => ["sometimes","date","nullable"],
                "proveedor" => ["sometimes","string"],
                "encargado" => ["sometimes","string"],
            ];
        }
    }
    public function validatedWithDefaults()
    {
        $data = $this->validated();

        $data['fecha'] = !empty($data['fecha']) ? $data['fecha'] : Carbon::now();

        return $data;
    }
}
