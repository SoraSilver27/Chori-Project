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

class ComponenteEventController extends Controller
{
    public function store(Componente $mensaje)
    {
        /*Broadcast::channel('notifocacion_componente')->emit('NuevaNotificacion', [
            'mensaje' => 'Se ha creado una nuava notificación.',
            'usuario' => auth()->user()->name
        ]);*/

        return redirect()->back();
    }
    /*public function show(Componente $componente)
    {
        // Crear el mensaje y la fecha
        $mensaje = "El componente {$componente->nombre} necesita mantenimiento.";

        $mantenimiento_componente = new \DateTime($componente->proximo_mantenimiento);

        // Disparar el evento
        event(new MantenimientoPreventivoComponenteEvent($mensaje, $mantenimiento_componente));

        // Devolver el recurso
        return new ComponenteResource($componente);
    }*/
}
