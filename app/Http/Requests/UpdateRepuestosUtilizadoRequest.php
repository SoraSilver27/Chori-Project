<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRepuestosUtilizadoRequest extends FormRequest
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
                "cantidad" => ["required","int"],
                "nombre_repuesto" => ["required","string"],
            ];
        }else {
            return [
                "cantidad" => ["sometimes","int"],
                "nombre_repuesto" => ["sometimes","string"],
            ];
        }
    }
}
