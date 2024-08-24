<?php

namespace App\Http\Controllers;

use App\Models\Historial_general;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HistorialGeneralController extends Controller
{
    public function store(Request $request): Response
    {
        $request->validate([

        ]);

        $historialGeneral = Historial_general::create([

        ]);
        event(new Registered($historialGeneral));
        return response()->noContent();
    }
}
