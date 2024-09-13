<?php

use App\Http\Controllers\CategoriaRepuestoController;
use App\Http\Controllers\ComponenteController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\MaquinariaController;
use App\Http\Controllers\MaquinariaDetalleController;
use App\Http\Controllers\HistorialGeneralController;
use App\Http\Controllers\MantenimientoPreventivoController;
use App\Http\Controllers\NotaDelCalendarioController;
use App\Http\Controllers\PlanillaController;
use App\Http\Controllers\PlanillaCorrectivaController;
use App\Http\Controllers\PlanillaPreventivaController;
use App\Http\Controllers\RepuestoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'App\Http\Controllers'], function() {
    Route::apiResource("maquinarias", MaquinariaController::class);
    Route::apiResource("detalles", MaquinariaDetalleController::class);
    Route::apiResource("componentes", ComponenteController::class);
    Route::apiResource("facturas", FacturaController::class);
    Route::apiResource("historial", HistorialGeneralController::class);
    Route::apiResource("mantenimientos", MantenimientoPreventivoController::class);
    Route::apiResource("notas", NotaDelCalendarioController::class);
    Route::apiResource("planillas", PlanillaController::class);
    Route::apiResource("planillas_correctivas", PlanillaCorrectivaController::class);
    Route::apiResource("planillas_preventivas", PlanillaPreventivaController::class);
    Route::apiResource("repuestos", RepuestoController::class);
    Route::apiResource("categoria_repuestos", CategoriaRepuestoController::class);

});

Route::get('test', function() {
    return 'API is working';
});
