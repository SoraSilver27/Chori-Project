<?php

namespace App\Listeners;

use App\Events\StockEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notifications;
use App\Notifications\StockNotification;
use Notification;

class StockListener
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
    public function handle(StockEvent $event)
    {
        Notification::send(auth(), new StockNotification($event->stock_componente, $event->stock_repuesto));
    }
}
