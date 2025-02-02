<?php
namespace App\Notifications;

use App\Models\Registro;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EspeciePendingValidation extends Notification implements ShouldQueue
{
    use Queueable;

    public $registro;
    public $tipoAccion;

    public function __construct(Registro $registro, string $tipoAccion)
    {
        $this->registro = $registro;
        $this->tipoAccion = $tipoAccion;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Nueva Especie Requiere Validación')  
            ->line("Se ha {$this->tipoAccion} un registro de especie que necesita validación:")
            ->line('Nombre científico: ' . $this->registro->especie->esp_nombre_cientifico)
            ->line('Registrada por: ' . $this->registro->user->user_nombre)
            ->action('Revisar especie', route('validate.show', $this->registro->regis_id))
            ->line('Fecha de solicitud: ' . $this->registro->created_at->format('d/m/Y H:i'))
            ->line('Por favor, revise los detalles y valide la especie.');
    }
}