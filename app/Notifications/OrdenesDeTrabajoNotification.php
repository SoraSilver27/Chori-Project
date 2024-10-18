<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrdenesDeTrabajoNotification extends Notification
{
    use Queueable;

    public $ordenDeTrabajo;

    /**
     * Create a new notification instance.
     */
    public function __construct($ordenDeTrabajo)
    {
        $this->ordenDeTrabajo = $ordenDeTrabajo;
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
            'mensaje' => 'Se ha creado una nueva orden de trabajo: ' . $this->ordenDeTrabajo->title,
            'id_orden' => $this->ordenDeTrabajo->id,
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
