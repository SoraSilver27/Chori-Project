<?php

namespace App\Http\Controllers;

use App\Models\Nota_del_calendario;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NotaDelCalendarioController extends Controller
{
    public function store(Request $request): Response
    {
        $request->validate([

        ]);

        $notadelCalendario = Nota_del_calendario::create([

        ]);
        event(new Registered($notadelCalendario));
        return response()->noContent();
    }
}
