<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFacturaRequest extends FormRequest
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
                "numero_de_compra" => ["required","string"],
                "fecha" => ["required","date"],
                "proveedor" => ["required","string"],
                "encargado" => ["required","string"],
            ];
        }else {
            return[
                "nombre" => ["sometimes","string"],
                "facha" => ["sometimes","date"],
                "proveedor" => ["sometimes","string"],
                "encargado" => ["sometimes","string"],
            ];
        }
    }
}
