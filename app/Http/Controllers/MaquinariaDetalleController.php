<?php

namespace App\Http\Controllers;

use App\Http\Resources\MaquinariaDetalleCollection;
use App\Models\MaquinariaDetalle;
use App\Http\Requests\StoreMaquinariaDetalleRequest;
use App\Http\Requests\UpdateMaquinariaDetalleRequest;

class MaquinariaDetalleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $detalles = MaquinariaDetalle::all();
        return new MaquinariaDetalleCollection($detalles);
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
    }

    /**
     * Display the specified resource.
     */
    public function show(MaquinariaDetalle $maquinariaDetalle)
    {
        //
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
    public function update(UpdateMaquinariaDetalleRequest $request, MaquinariaDetalle $maquinariaDetalle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MaquinariaDetalle $maquinariaDetalle)
    {
        //
    }
}
