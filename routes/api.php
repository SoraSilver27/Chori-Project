<?php

use App\Models\Maquinaria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/nuevaMaquinaria',
    [Maquinaria::class,'store']
);


