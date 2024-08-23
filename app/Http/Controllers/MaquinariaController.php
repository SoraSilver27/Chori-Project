<?php

namespace App\Http\Controllers;

use App\Models\Maquinaria;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class MaquinariaController extends Controller
{
    public function store(Request $request): Response
    {
        $request->validate([
            'nombre' => ['required','string',"max:40"],
            'numero_de_serie' => ['required','string'],
            'imagen' => ['required','binary'],
            'modelo' => ['required','string','max:50'],


        ]);
    }
}
