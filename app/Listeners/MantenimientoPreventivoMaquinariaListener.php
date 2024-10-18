<?php

namespace App\Listeners;

use App\Events\MantenimientoPreventivoMaquinariaEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\MantenimientoPreventivoMaquinariaNotification;
use Notification;

class MantenimientoPreventivoMaquinariaListener
{
    use InteractsWithQueue;
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
    public function handle(MantenimientoPreventivoMaquinariaEvent $event)
    {
        Notification::send(auth(), new MantenimientoPreventivoMaquinariaNotification($event->mensaje, $event->mantenimiento));
    }
}
