<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FacturaController extends Controller
{
    public function store(Request $request): Response
    {
        $request->validate([
            'Numero_de_compra'=> ['required','int'],
            'Fecha' => ['required','date'],
            'Proveedor' => ['required','string'],
            'Encargado' => ['required','string'],
        ]);

        $factura = Factura::create([
            'Numero_de_compra'=> $request->Numero_de_compra,
            'Fecha' => $request->Fecha,
            'Proveedor' => $request->Proveedor,
            'Encargado' => $request->Encargado,
        ]);
        event(new Registered($factura));
        return response()->noContent();
    }
}


