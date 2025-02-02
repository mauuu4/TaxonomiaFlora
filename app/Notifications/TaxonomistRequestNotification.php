<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaxonomistRequestNotification extends Notification
{
    use Queueable;

    public $user;

    /**
     * Create a new notification instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Solicitud de rol de Taxónomo')
            ->line("El usuario {$this->user->user_nombre} ({$this->user->user_email}) solicita ser taxónomo.")
            ->line('Detalles del usuario:')
            ->line('- Nombre: ' . $this->user->user_nombre)
            ->line('- Apellido: ' . $this->user->user_apellido)
            ->line('- Email: ' . $this->user->user_email)
            ->line('- Registrado el: ' . $this->user->created_at->format('d/m/Y'))
            ->action('Administrar solicitudes', route('admin.users.edit', $this->user))
            ->line('Haz clic en el botón para editar el rol del usuario.');
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
