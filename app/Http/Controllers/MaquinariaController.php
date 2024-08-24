<?php

namespace App\Http\Controllers;

use App\Models\Maquinaria;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

//Espero que funcione

class MaquinariaController extends Controller
{
    public function store(Request $request): Response //Esto es para registrar una nueva maquinaria
    {
        $request->validate([
            'Nombre' => ['required','string',"max:40"],
            'Numero_de_serie' => ['string', "max:40"],
            'Imagen' => ['binary'],
            'Modelo' => ['string','max:50'],
            'Fecha_adquisicion' => ['required', 'date'],
            'Observaciones_generales' => ['string', 'max:600'],

        ]);

        $maquinaria = Maquinaria::create([
            'Nombre' => $request->Nombre,
            'Numero_de_serie' => $request->Numero_de_serie,
            'Imagen' => $request->Imagen,
            'Modelo' => $request->Modelo,
            'Fecha_adquisicion' => $request->Fecha_adquisicion,
            'Observaciones_generales' => $request->Observaciones_generales,
        ]);

        event(new Registered($maquinaria));
        return response()->noContent();
    }
}
