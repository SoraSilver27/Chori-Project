<?php

namespace App\Http\Controllers;

use App\Models\Componente;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ComponenteController extends Controller
{
    public function store(Request $request): Response //Esto sirve para registrar un nuevo componente.
    {
        $request->validate([
            'Nombre'=> ['required','string','max:40'],
            'Numero_de_serie' => ['string','max:10'],
            'Imagen' => ['binary'],
            'Modelo' => ['string','max:40'],
            'Descripcion' => ['string','max:120'],
            'Ubicacion' => ['required','string','max:20'],
            'Estado' => ['boolean'],
        ]);

        $componente = Componente::create([
            'Nombre'=> $request->Nombre,
            'Numero_de_serie' => $request->Numero_de_serie,
            'Imagen' => $request->Imagen,
            'Modelo' => $request->Modelo,
            'Descripcion' => $request->Descripcion,
            'Ubicacion' => $request->Ubicacion,
        ]);

        event(new Registered($componente));
        return response()->noContent();
    }
}
