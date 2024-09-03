<?php

namespace App\Http\Controllers;

use App\Filters\FacturaFilter;
use App\Http\Resources\FacturaCollection;
use App\Http\Resources\FacturaResource;
use App\Models\Factura;
use App\Http\Requests\StoreFacturaRequest;
use App\Http\Requests\UpdateFacturaRequest;
use Illuminate\Http\Request;

class FacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $filter = new FacturaFilter();
        $queryItems = $filter->transform($request);

        $facturas = Factura::where($queryItems);
        return new FacturaCollection($facturas->get());
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
    public function store(StoreFacturaRequest $request)
    {
        //
        return new FacturaResource(Factura::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Factura $factura)
    {
        //
        return new FacturaResource($factura);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Factura $factura)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFacturaRequest $request, Factura $factura)
    {
        //
        $factura->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Factura $factura)
    {
        //
    }
}
