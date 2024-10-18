<?php

namespace App\Listeners;

use App\Events\OrdenesDeTrabajoEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\OrdenesDeTrabajoNotification;

class OrdenesDeTrabjoListener
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
    public function handle(OrdenesDeTrabajoEvent $event)
    {
        Notification::send(auth(), new OrdenesDeTrabajoNotification($event->ordenDeTrabajo));
    }
}
