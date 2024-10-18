<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMaquinariaRequest;
use App\Http\Requests\UpdateMaquinariaRequest;
use App\Http\Resources\MaquinariaResource;
use App\Models\Maquinaria;
use App\Http\Resources\MaquinariaCollection;
use App\Filters\MaquinariaFilter;
use App\Models\MaquinariaDetalle;
use Illuminate\Http\Request;
use Illuminate\Broadcast\Channel;



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
        $includeComponentes = $request->query("includeComponentes");
        $includePlanillas = $request->query("includePlanillas");
        $includePreventivos = $request->query("includePreventivos");
        $maquinarias = Maquinaria::where($queryItems);
        if($includeComponentes){
            $maquinarias = $maquinarias->with("componentes");
        }
        if($includeDetalles){
            $maquinarias = $maquinarias->with("detalles");
        }
        if($includePlanillas){
            $maquinarias = $maquinarias->with("planillas");
        }
        if($includePreventivos){
            $maquinarias = $maquinarias->with("preventivos");
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
    public function store(StoreMaquinariaRequest $request,  Maquinaria $maquinaria)
    {
        //
        $maquinaria = Maquinaria::create($request->all());

        //Esto sirve por si tiene detalles la máquina, crea los detalles sin tener que pasarlos por otra ruta
        if ($request->has('detalles')) {
           $maquinaria->detalles()->create(array_merge($request->input('detalles'), ['id_maquinaria' => $maquinaria->id]));

        }
        if ($request->has('componentes')) {
            $maquinaria->componentes()->create(array_merge($request->input('componentes'), ['ubicacion' => $maquinaria->id]));

         }

        return new MaquinariaResource($maquinaria->load('detalles', 'componentes'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Maquinaria $maquinaria)
    {
        //
        $includeComponentes = request()->query("includeComponentes");
        if($includeComponentes){
            return new MaquinariaResource($maquinaria->loadMissing("componentes"));
        }
        $includeDetalles = request()->query("includeDetalles");
        if($includeDetalles){
            return new MaquinariaResource($maquinaria->loadMissing("detalles"));
        }
        $includePlanillas = request()->query("includePlanillas");
        if($includePlanillas){
            return new MaquinariaResource($maquinaria->loadMissing("planillas"));
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

        if ($request->has('componentes')) {

            $maquinaria->componentes()->update($request->input('componentes'));

        }

        if ($request->has('detalles')) {

            $maquinaria->detalles()->update($request->input('detalles'));

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Maquinaria $maquinaria)
    {
        //
        $maquinaria->detalles()->delete();
        $maquinaria->delete();

        return response()->json(['message' => 'Maquinaria eliminada correctamente']);

    }

    /*public function broadcastOn()
    {

    } */
}
