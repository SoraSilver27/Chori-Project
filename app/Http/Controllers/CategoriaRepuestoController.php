<?php

namespace App\Http\Controllers;

use App\Models\Categoria_repuesto;
use App\Models\Maquinaria;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoriaRepuestoController extends Controller
{
    public function store(Request $request): Response
    {
        $request->validate([
            'Nombre'=> ['required','string'],
            'Descripcion' => ['string','max:50'],
            'Imagen' => ['binary'],
        ]);

        $categoria = Categoria_repuesto::create([
            'Nombre'=> $request->Nombre,
            'Descripcion' => $request->Descripcion,
            'Imagen' => $request->Imagen,
        ]);
        event(new Registered($categoria));
        return response()->noContent();
    }
}
