<?php

namespace App\Http\Controllers;

use App\Filters\MantenimientoPreventivoFilter;
use App\Http\Resources\MantenimientoPreventivoCollection;
use App\Http\Resources\MantenimientoPreventivoResource;
use App\Models\MantenimientoPreventivo;
use App\Http\Requests\StoreMantenimientoPreventivoRequest;
use App\Http\Requests\UpdateMantenimientoPreventivoRequest;
use Illuminate\Http\Request;

class MantenimientoPreventivoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request )
    {
        //
        $filter = new MantenimientoPreventivoFilter
        ();
        $queryItems = $filter->transform($request);
        $includePlanillas = $request->query("includePlanillasPreventivas");
        $mantenimientoPreventivo = MantenimientoPreventivo::where($queryItems);

        if($includePlanillas){
            $mantenimientoPreventivo = $mantenimientoPreventivo->with("planillasPreventivas");
        }



        return new MantenimientoPreventivoCollection($mantenimientoPreventivo->get());
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
    public function store(StoreMantenimientoPreventivoRequest $request)
    {
        //
        return new MantenimientoPreventivoResource(MantenimientoPreventivo::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(MantenimientoPreventivo $mantenimientoPreventivo)
    {
        //
        $includePlanillasPreventivas = request()->query("includePlanillasPreventivas");
        if($includePlanillasPreventivas){
            return new MantenimientoPreventivoResource($mantenimientoPreventivo->loadMissing("planillas"));
        }
        return new MantenimientoPreventivoResource($mantenimientoPreventivo);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MantenimientoPreventivo $mantenimientoPreventivo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMantenimientoPreventivoRequest $request, MantenimientoPreventivo $mantenimientoPreventivo)
    {
        //
        $mantenimientoPreventivo->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MantenimientoPreventivo $mantenimientoPreventivo)
    {
        //
    }
}
