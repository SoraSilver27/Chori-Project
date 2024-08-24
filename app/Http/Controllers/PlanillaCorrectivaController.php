<?php

namespace App\Http\Controllers;

use App\Models\Planilla_correctiva;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PlanillaCorrectivaController extends Controller
{
    public function store(Request $request): Response
    {
        $request->validate([
            'Problema_detectado'=> ['required','string','max:50'],
            'Solucion_encontrada' => ['required','string','max.50'],
            'Que_se_pudo_realizar' => ['required','string','max:50'],
            'Requirio_tercerizacion' => ['boolean'],
            'Amerita_seguimiento' => ['boolean'],
        ]);

        $planillaCorrectiva = Planilla_correctiva::create([
            'Problema_detectado'=> $request->Problema_detectado,
            'Solucion_encontrada' => $request->Solucion_encontrada,
            'Que_se_pudo_realizar' => $request->Que_se_pudo_realizar,
            'Requirio_tercerizacion' => $request->Requirio_tercerizacion,
            'Amerita_seguimiento' => $request->Amerita_seguimiento,
        ]);
        event(new Registered($planillaCorrectiva));
        return response()->noContent();
    }
}
