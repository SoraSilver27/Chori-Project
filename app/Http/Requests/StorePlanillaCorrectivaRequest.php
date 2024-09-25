<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePlanillaCorrectivaRequest extends FormRequest
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
            "problema_detectado" => ["required","string"],
            "solucion_encontrada" => ["required","string"],
            "que_se_pudo_realizar" => ["required","string"],
            "requirio_tercerizacion" => ["required","boolean","nullable"],
            "amerita_seguimiento" => ["required","boolean","nullable"],
        ];
    }

    public function validatedWithDefaults()
    {
        $data = $this->validated();

        $defaults = [
            "requirio_tercerizacion" => 0,
            "amerita_seguimiento" => 0,
        ];

        foreach ($defaults as $campo => $valorDefault) {
            if (empty($data[$campo])) {
                $data[$campo] = $valorDefault;
            }
        }

        return $data;
    }
}
