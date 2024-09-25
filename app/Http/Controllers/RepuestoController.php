<?php

namespace App\Http\Controllers;

use App\Filters\RepuestoFilter;
use App\Http\Resources\RepuestoCollection;
use App\Http\Resources\RepuestoResource;
use App\Models\Repuesto;
use App\Http\Requests\StoreRepuestoRequest;
use App\Http\Requests\UpdateRepuestoRequest;
use Illuminate\Http\Request;

class RepuestoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $filter = new RepuestoFilter();
        $queryItems = $filter->transform($request);

        $repuesto = Repuesto::where($queryItems);

        return new RepuestoCollection($repuesto->get());
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
    public function store(StoreRepuestoRequest $request)
    {
        //
        return new RepuestoResource(Repuesto::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Repuesto $repuesto)
    {
        //
        return new RepuestoResource($repuesto);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Repuesto $repuesto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRepuestoRequest $request, Repuesto $repuesto)
    {
        //
        $repuesto->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Repuesto $repuesto)
    {
        //
    }
}
