<?php

namespace App\Http\Controllers;

use App\Models\Planilla_preventiva;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PlanillaPreventivaController extends Controller
{
    public function store(Request $request): Response
    {
        $request->validate([
            'ID_mantenimiento'=> ['int'],
            'Horas_de_servicio' => ['int'],
            'Trabajo_mantenimiento' => ['required','string','max:50'],
        ]);

        $planillaPreventiva = Planilla_preventiva::create([
            'ID_mantenimiento'=> $request->ID_mantenimiento,
            'Horas_de_servicio' => $request->Horas_de_servicio,
            'Trabajo_mantenimiento' => $request->Trabajo_mantenimiento,
        ]);
        event(new Registered($planillaPreventiva));
        return response()->noContent();
    }
}
