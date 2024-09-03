<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComponenteRequest;
use App\Http\Requests\UpdateComponenteRequest;
use App\Http\Resources\ComponenteResource;
use App\Models\Componente;
use App\Http\Resources\ComponenteCollection;
use App\Filters\ComponenteFilter;
use Illuminate\Http\Request;

class ComponenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $filter = new ComponenteFilter();
        $queryItems = $filter->transform($request);
        $includePlanillas = $request->query("includePlanillas");
        $includePreventivos = $request->query("includePreventivos");
        $componentes = Componente::where($queryItems);

        if($includePlanillas){
            $componentes = $componentes->with("planillas");
        }
        if($includePreventivos){
            $componentes = $componentes->with("preventivos");
        }

        return new ComponenteCollection($componentes->get());
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
    public function store(StoreComponenteRequest $request)
    {
        //
        return new ComponenteResource(Componente::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Componente $componente)
    {
        //
        return new ComponenteResource($componente);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Componente $componente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateComponenteRequest $request, Componente $componente)
    {
        //
        $componente->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Componente $componente)
    {
        //
    }
}
