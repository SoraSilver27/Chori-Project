<?php

namespace App\Http\Controllers;

use App\Filters\UtilizadoFilter;
use App\Http\Resources\RepuestosUtilizadoCollection;
use App\Http\Resources\RepuestosUtilizadoResource;
use App\Models\RepuestosUtilizado;
use App\Http\Requests\StoreRepuestosUtilizadoRequest;
use App\Http\Requests\UpdateRepuestosUtilizadoRequest;
use Illuminate\Http\Request;

class RepuestosUtilizadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $filter = new UtilizadoFilter();
        $queryItems = $filter->transform($request);

        $repuesto = RepuestosUtilizado::where($queryItems);

        return new RepuestosUtilizadoCollection($repuesto->get());
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
    public function store(StoreRepuestosUtilizadoRequest $request)
    {
        //
        return new RepuestosUtilizadoResource(RepuestosUtilizado::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(RepuestosUtilizado $repuestosUtilizado)
    {
        //
        return new RepuestosUtilizadoResource($repuestosUtilizado);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RepuestosUtilizado $repuestosUtilizado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRepuestosUtilizadoRequest $request, RepuestosUtilizado $repuestosUtilizado)
    {
        //
        $repuestosUtilizado->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RepuestosUtilizado $repuestosUtilizado)
    {
        //
    }
}
