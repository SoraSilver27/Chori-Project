<?php

namespace App\Listeners;

use App\Events\MantenimientoPreventivoComponenteEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\MantenimientoPreventivoComponenteNotification;
use Notification;

class MantenimientoPreventivoComponenteListener implements ShouldQueue
{
    /**
     * Create the event listener.
     */

    public $shouldQueue = false;

    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(MantenimientoPreventivoComponenteEvent $event)
    {
        $mensaje = $event->mensaje;
        $fecha_mantenimiento = $event->mantenimiento_componente;
    }
}
