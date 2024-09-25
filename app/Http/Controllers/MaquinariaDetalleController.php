<?php

namespace App\Http\Controllers;

use App\Filters\MaquinariaDetalleFilter;
use App\Http\Resources\MaquinariaDetalleCollection;
use App\Http\Resources\MaquinariaDetallesResource;
use App\Models\Maquinaria;
use App\Models\MaquinariaDetalle;
use App\Http\Requests\StoreMaquinariaDetalleRequest;
use App\Http\Requests\UpdateMaquinariaDetalleRequest;
use Illuminate\Http\Request;

class MaquinariaDetalleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index (Request $request)
    {
        //
        $filter = new MaquinariaDetalleFilter();
        $queryItems = $filter->transform($request);

        $maquinariaDetalle = MaquinariaDetalle::where($queryItems);

        return new MaquinariaDetalleCollection($maquinariaDetalle->get());

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMaquinariaDetalleRequest $request)
    {
        //
        return new MaquinariaDetallesResource(MaquinariaDetalle::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show($id) //Esto es diferente del resto de controladores debido a un error que no muestra correctamente los datos
    {
        //
        $maquinariaDetalle = MaquinariaDetalle::find($id);  //
        return new MaquinariaDetallesResource($maquinariaDetalle);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MaquinariaDetalle $maquinariaDetalle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMaquinariaDetalleRequest $request, $id)
    {
        // Buscar el detalle de maquinaria por ID
        $maquinariaDetalle = MaquinariaDetalle::find($id);

        // Obtener los datos validados con valores predeterminados desde el request
        $data = $request->validatedWithDefaults();

        // Actualizar el registro con los datos modificados
        $maquinariaDetalle->update($data);

        // Retornar una respuesta
        return response()->json(['message' => 'Detalles de la maquinaria actualizado correctamente']);
    }

    /**<
     * Remove the specified resource from storage.
     */
    public function destroy(MaquinariaDetalle $maquinariaDetalle    )
    {
        //
    }
}
