<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMaquinariaRequest;
use App\Http\Requests\UpdateMaquinariaRequest;
use App\Http\Resources\MaquinariaResource;
use App\Models\Maquinaria;
use App\Http\Resources\MaquinariaCollection;
use App\Filters\MaquinariaFilter;
use Illuminate\Http\Request;



class MaquinariaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $filter = new MaquinariaFilter();
        $queryItems = $filter->transform($request);
        $includeDetalles = $request->query("includeDetalles");
        $maquinarias = Maquinaria::where($queryItems);
        if($includeDetalles){
            $maquinarias = $maquinarias->with("detalles");
        }
        return new MaquinariaCollection($maquinarias->get());

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
    public function store(StoreMaquinariaRequest $request)
    {
        //
        return new MaquinariaResource(Maquinaria::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Maquinaria $maquinaria)
    {
        //
        $includeDetalles = request()->query("includeDetalles");
        if($includeDetalles){
            return new MaquinariaResource($maquinaria->loadMissing("detalles"));
        }
        return new MaquinariaResource($maquinaria);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Maquinaria $maquinaria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMaquinariaRequest $request, Maquinaria $maquinaria)
    {
        //
        $maquinaria->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Maquinaria $maquinaria)
    {
        //
    }
}
