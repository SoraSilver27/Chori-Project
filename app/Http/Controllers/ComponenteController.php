<?php

namespace App\Http\Controllers;

use App\Events\MantenimientoPreventivoComponenteEvent;
use App\Http\Requests\StoreComponenteRequest;
use App\Http\Requests\UpdateComponenteRequest;
use App\Http\Resources\ComponenteResource;
use App\Models\Componente;
use App\Http\Resources\ComponenteCollection;
use App\Filters\ComponenteFilter;
use Illuminate\Http\Request;
use Notification;
Use Illuminate\Broadcasting\Channel;
use Illuminate\Support\Facades\Broadcast;

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
        $componentes = Componente::where($queryItems);


        $includePlanillas = $request->query("includePlanillas");

        if($includePlanillas){
            $componentes = $componentes->with("planillas");
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
        //Broadcast::channel('notifocacion_componente')->emit('NuevaNotificacion', $mensaje);
    }


    /**
     * Display the specified resource.
     */
    public function show(Componente $componente)
    {
        // Crear el mensaje y la fecha
        $mensaje = "El componente {$componente->nombre} necesita mantenimiento.";

        $mantenimiento_componente = new \DateTime($componente->proximo_mantenimiento);

        // Disparar el evento
        event(new MantenimientoPreventivoComponenteEvent($mensaje, $mantenimiento_componente));

        // Devolver el recurso
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

    public function broadcast(Componente $notification)
    {

    }

    //Broadcast::channel('notification_componente')->emit('NuevaNotificacion', $mensaje);
    //event(new NewNotification($mensaje, $mantenimiento_componente));
}
