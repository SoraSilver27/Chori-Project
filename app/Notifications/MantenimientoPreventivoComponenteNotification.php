<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MantenimientoPreventivoComponenteNotification extends Notification
{
    use Queueable;

    public $mensaje;
    public $mantenimiento_componente;

    /**
     * Create a new notification instance.
     */
    public function __construct(string $mensaje, \DateTimeInterface $mantenimiento_componente)
    {
        $this->mensaje = $mensaje;
        $this->mantenimiento_componente = $mantenimiento_componente;
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
            'mensaje' => $this->mensaje,
            'mantenimiento_componente' => $this->mantenimiento_componente,
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
