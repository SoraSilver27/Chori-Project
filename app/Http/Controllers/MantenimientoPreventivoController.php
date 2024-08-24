<?php

namespace App\Http\Controllers;

use App\Models\Mantenimiento_preventivo;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MantenimientoPreventivoController extends Controller
{
    public function store(Request $request): Response
    {
        $request->validate([
            'Es_de'=> ['required','string'],
            'Intervalo_de_mantenimiento' => ['enum'],
            'Horas_de_servicio' => ['required','int'],
            'Ultimo_mentenimiento' => ['date'],
            'Que_se_hace' => ['required','string','max:40'],
        ]);

        $mantenimiento_preventivo = Mantenimiento_preventivo::create([
            'Es_de'=> $request->Es_de,
            'Intervalo_de_mantenimiento' => $request->Intervalo_de_mantenimiento,
            'Horas_de_servicio' => $request->Horas_de_servicio,
            'Ultimo_mentenimiento' => $request->Ultimo_mentenimiento,
            'Que_se_hace' => $request->Que_se_hace,
        ]);
        event(new Registered($mantenimiento_preventivo));
        return response()->noContent();
    }
}
