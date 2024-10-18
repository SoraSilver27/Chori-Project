<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StockNotification extends Notification
{
    use Queueable;

    public $stock_componente;
    public $stock_repuesto;

    /**
     * Create a new notification instance.
     */
    public function __construct($stock_componente, $stock_repuesto)
    {
        $this->stock_componente = $stock_componente;
        $this->stock_repuesto = $stock_repuesto;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return ['broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toBroadcast($notifiable)
    {
        return [
            'mensaje_componente' => 'El componente ' . $this->stock_componente->name . ' tiene bajo stock.',
            'id_componente' => $this->stock_componente->id,
            'mensaje_repuesto' => 'El repuesto ' . $this->stock_repuesto->name . ' tiene stock bajo.',
            'id_repuesto' => $this->stock_repuesto->id,
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
