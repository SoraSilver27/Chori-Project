<?php

namespace App\Listeners;

use App\Events\MantenimientoPreventivoComponenteEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\MantenimientoPreventivoComponenteNotification;
use Notification;

class MantenimientoPreventivoComponenteListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(MantenimientoPreventivoComponenteEvent $event)
    {
        Notification::send(auth()->user(), new MantenimientoPreventivoComponenteNotification($event->mensaje, $event->mantenimiento_componente));
    }
}
