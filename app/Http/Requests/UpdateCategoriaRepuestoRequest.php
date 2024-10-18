<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoriaRepuestoRequest extends FormRequest
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
                "nombre" => ["required","string"],
                "descripcion" => ["required","string"],
                "imagen" => ["binary"],
            ];
        }else {
            return[
                "nombre" => ["sometimes","string"],
                "descripcion" => ["sometimes","string"],
                "imagen" => ["sometimes","binary"],
            ];
        }
    }
}
