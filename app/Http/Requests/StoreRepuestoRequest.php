<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRepuestoRequest extends FormRequest
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
            "cantidad" => ["required","int"],
            "nombre" => ["required","string"],
            "descripcion" => ["required","string"],
            "imagen" => ["binary"],
            "fabricante" => ["required","string"],
            "modelo" => ["required","string"],
        ];
    }
}
