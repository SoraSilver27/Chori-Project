<?php

namespace App\Http\Controllers;

use App\Models\Repuesto;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RepuestoController extends Controller
{
    public function store(Request $request): Response //Esto es para registrar un nuevo repuesto
    {
        $request->validate([
            'Nombre' => ['required','string',"max:40"],
            'Imagen' => ['binary'],
            'Descripcion' => ['required','string', 'max:50'],
            'Fabricante' => ['string','max:50'],
            'Modelo' => ['string', 'max:40'],

        ]);

        $repuesto = Repuesto::create([
            'Nombre' => $request->Nombre,
            'Imagen' => $request->Imagen,
            'Descripcion' => $request->Descripcion,
            'Fabricante' => $request->Fabricante,
            'Modelo' => $request->Modelo,
        ]);

        event(new Registered($repuesto));
        return response()->noContent();
    }
}
