<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePlanillaRequest extends FormRequest
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
                "es_de" => ["required","boolean"],
                "tipo_planilla" => ["required",Rule::in(["Preventivo","Correctivo","Otro"])],
                "aclarar" => ["nullable"],
                "fecha" => ["required","date"],
                "encargado" => ["required","string"],
                "telefono_encargado" => ["string"],
                "mantenimiento" => ["required","string"],
                "problema_detectado" => ["required","string"],
                "solucion_encontrada" => ["required","string"],
                "que_se_pudo_realizar" => ["required","string"],
                "requirio_tercerizacion" => ["required","boolean","nullable"],
                "amerita_seguimiento" => ["required","boolean","nullable"],
            ];
        }else {
            return[
                "es_de" => ["sometimes","boolean"],
                "tipo_planilla" => ["sometimes",Rule::in(["Preventivo","Correctivo","Otro"])],
                "aclarar" => ["sometimes","nullable"],
                "fecha" => ["sometimes","date"],
                "encargado" => ["sometimes","string"],
                "telefono_encargado" => ["sometimes","string"],
                "mantenimiento" => ["sometimes","string"],
                "problema_detectado" => ["sometimes","string"],
                "solucion_encontrada" => ["sometimes","string"],
                "que_se_pudo_realizar" => ["sometimes","string"],
                "requirio_tercerizacion" => ["sometimes","boolean","nullable"],
                "amerita_seguimiento" => ["sometimes","boolean","nullable"],
            ];
        }
    }
}
