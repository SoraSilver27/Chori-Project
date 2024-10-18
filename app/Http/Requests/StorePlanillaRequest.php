<?php

namespace App\Http\Requests;

use App\Models\Repuesto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePlanillaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    protected function prepareForValidation(): void
    {
        // Convertir el array de repuestos utilizados a JSON
        if ($this->has('repuestos_utilizados')) {
            $this->merge([
                'repuestos_utilizados' => json_encode($this->repuestos_utilizados),
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
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
            'repuestos_utilizados' => ["required"],
            'repuestos_utilizados.*.nombre' => ["required","string"],
            'repuestos_utilizados.*.cantidad' => ["required","integer","min:1"],
        ];
    }

}
