<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePlanillaCorrectivaRequest extends FormRequest
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
                "problema_detectado" => ["required","string"],
                "solucion_encontrada" => ["required","string"],
                "que_se_pudo_realizar" => ["required","string"],
                "requirio_tercerizacion" => ["required","boolean"],
                "amerita_seguimiento" => ["required","boolean"],
            ];
        }else {
            return[
                "problema_detectado" => ["sometimes","string"],
                "solucion_encontrada" => ["sometimes","string"],
                "que_se_pudo_realizar" => ["sometimes","string"],
                "requirio_tercerizacion" => ["sometimes","boolean"],
                "amerita_seguimiento" => ["sometimes","boolean"],
            ];
        }
    }
}
