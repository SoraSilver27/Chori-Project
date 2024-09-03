<?php

namespace App\Http\Controllers;

use App\Filters\CategoriaRepuestoFilter;
use App\Http\Resources\CategoriaRepuestoCollection;
use App\Http\Resources\CategoriaRepuestoResource;
use App\Models\CategoriaRepuesto;
use App\Http\Requests\StoreCategoriaRepuestoRequest;
use App\Http\Requests\UpdateCategoriaRepuestoRequest;
use Illuminate\Http\Request;

class CategoriaRepuestoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {


        $filter = new CategoriaRepuestoFilter();
        $queryItems = $filter->transform($request);
        $maquinarias = CategoriaRepuesto::where($queryItems);

        $includeRepuestos = $request->query("includeRepuestos");

        if($includeRepuestos){
            $maquinarias = $maquinarias->with("repuestos");
        }

        return new CategoriaRepuestoCollection($maquinarias->get());


        //
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
    public function store(StoreCategoriaRepuestoRequest $request)
    {
        return new CategoriaRepuestoResource(CategoriaRepuesto::create($request->all()));
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CategoriaRepuesto $categoriaRepuesto)
    {
        //
        $includeRepuestos = request()->query("includeRepuestos");
        if($includeRepuestos){
            return new CategoriaRepuestoResource($categoriaRepuesto->loadMissing("repuestos"));
        }

        return new CategoriaRepuestoResource($categoriaRepuesto);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CategoriaRepuesto $categoriaRepuesto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoriaRepuestoRequest $request, CategoriaRepuesto $categoriaRepuesto)
    {
        $categoriaRepuesto->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoriaRepuesto $categoriaRepuesto)
    {
        //
    }
}
