<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPassword extends Notification
{
    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject(  __('GIE Resetear Contraseña') )
            ->line( __('Recibió este correo electrónico porque recibimos una solicitud de restablecimiento de contraseña para su cuenta.'))
            ->action( __('Resetear Contraseña'), url('password/reset', $this->token) )
            ->line( __('Si no solicitó un restablecimiento de contraseña, no se requiere ninguna otra acción.'));
    }


}
