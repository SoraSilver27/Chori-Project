<?php

use App\Http\Controllers\MaquinariaController;
use App\Http\Controllers\MaquinariaDetalleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers'], function() {
    Route::apiResource('maquinarias', MaquinariaController::class);
    Route::apiResource('detalles', MaquinariaDetalleController::class);
});

Route::get('test', function() {
    return 'API is working';
});
