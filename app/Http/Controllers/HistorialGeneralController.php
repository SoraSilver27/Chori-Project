<?php

namespace App\Http\Controllers;

use App\Filters\HistorialGeneralFilter;
use App\Http\Resources\HistorialGeneralCollection;
use App\Http\Resources\HistorialGeneralResource;
use App\Models\HistorialGeneral;
use App\Http\Requests\StoreHistorialGeneralRequest;
use App\Http\Requests\UpdateHistorialGeneralRequest;
use Illuminate\Http\Request;

class HistorialGeneralController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request )
    {
        //
        $filter = new HistorialGeneralFilter();
        $queryItems = $filter->transform($request);

        $historialGeneral = HistorialGeneral::where($queryItems);


        return new HistorialGeneralCollection($historialGeneral->get());
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
    public function store(StoreHistorialGeneralRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(HistorialGeneral $historialGeneral)
    {
        //
        return new HistorialGeneralResource($historialGeneral);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HistorialGeneral $historialGeneral)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHistorialGeneralRequest $request, HistorialGeneral $historialGeneral)
    {
        //
        $historialGeneral->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HistorialGeneral $historialGeneral)
    {
        //
    }
}
