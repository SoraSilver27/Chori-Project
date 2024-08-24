<?php

namespace App\Http\Controllers;

use App\Models\Maquinaria_detalle;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MaquinariaDetalleController extends Controller
{
    public function store(Request $request): Response
    {
        $request->validate([
            'Capacidad_de_produccion'=> ['int'],
            'Voltaje' => ['int'],
            'Peso' => ['int'],
            'Tipo' => ['string','max:40'],
            'Velocidad_ajustable' => ['boolean'],
            'Pantalla_digital' => ['boolean'],
            'Facil_desmontaje' => ['boolean'],
            'Garantia' => ['boolean'],
        ]);

        $maquinariaDetalle = Maquinaria_detalle::create([
            'Capacidad_de_produccion'=> $request->Capacidad_de_produccion,
            'Voltaje' => $request->Voltaje,
            'Peso' => $request->Peso,
            'Tipo' => $request->Tipo,
            'Velocidad_ajustable' => $request->Velocidad_ajustable,
            'Pantalla_digital' => $request->Pantalla_digital,
            'Facil_desmontaje' => $request->Facil_desmontaje,
            'Garantia' => $request->Garantia,
        ]);
        event(new Registered($maquinariaDetalle));
        return response()->noContent();
    }
}
