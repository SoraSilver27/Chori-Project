<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRepuestoRequest extends FormRequest
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
                "cantidad" => ["required","integer"],
                "nombre" => ["required","string"],
                "descripcion" => ["string"],
                "imagen" => ["binary"],
                "fabricante" => ["required","string"],
                "modelo" => ["required","string"],
            ];
        }else {
            return[
                "cantidad" => ["sometimes","integer"],
                "nombre" => ["sometimes","string"],
                "descripcion" => ["sometimes","string"],
                "imagen" => ["sometimes","binary"],
                "fabricante" => ["sometimes","string"],
                "modelo" => ["sometimes","string"],
            ];
        }
    }
}
