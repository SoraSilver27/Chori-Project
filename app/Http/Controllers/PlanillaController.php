<?php

namespace App\Http\Controllers;

use App\Models\Planilla;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PlanillaController extends Controller
{
    public function store(Request $request): Response
    {
        $request->validate([
            'Es_de'=> ['enum'], //esto hay que verlo bien
            'Fecha' => ['required','date'],
            'Encargado' => ['required','string'],
            'Telefono_encargado' => ['required','string'],
        ]);

        $planilla = Planilla::create([
            'Es_de'=> $request->Es_de,
            'Fecha' => $request->Fecha,
            'Encargado' => $request->Encargado,
            'Telefono_encargado' => $request->Telefono_encargado,
        ]);

        event(new Registered($planilla));
        return response()->noContent();
    }
}
