<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MantenimientoPreventivoMaquinariaNotification extends Notification
{
    use Queueable;

    public $mensaje;
    public $mantenimiento;

    /**
     * Create a new notification instance.
     */
    public function __construct(string $mensaje, \DateTimeInterface $mantenimiento)
    {
        $this->mensaje = $mensaje;
        $this->mantenimiento = $mantenimiento;
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
            'mantenimiento' => $this->mantenimiento,
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
