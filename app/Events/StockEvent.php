<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Componente;
use App\Models\Repuesto;

class StockEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $stock_componente;
    public $stock_repuesto;

    /**
     * Create a new event instance.
     */
    public function __construct(Componente $stock_componente, Repuesto $stock_repuesto)
    {
        $this->stock_componente = $stock_componente;
        $this->stock_repuesto = $stock_repuesto;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('stock-notice'),
        ];
    }
}
