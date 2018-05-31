<?php

namespace GaneshaSIGE\Notifications;


use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use GaneshaSIGE\User;
use GaneshaSIGE\ModelPlandeEvaluacion;

class UpdateSignature extends Notification
{
    use Queueable;
    //private $workout;
    /**
     * Create a new notification instance.
     *
     * @return void
     */

   
    public function __construct($user,$private_pass)
    {
        $this->user = $user;
        $this->private_pass = $private_pass;
//dd(Crypt::decrypt($private_pass));
  
    }
    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        //$line =  nl2br('<img src="/img/logoss.png"/>');
        return (new MailMessage)
                    ->greeting('Saludos  '.' '.$this->user->name.' '.$this->user->ape_usu.'!!')
                    ->subject('¡Se a cambiado tu Firma Digital!')
                    
                    ->line('Ahora su Clave de GaneshaSIGE es: "<b>'.$this->private_pass->private_pass.'  </b> " Recuerda que esta sera, cambiada en 15 dias')
                    ->line('Sin ella NO podras interactuar en el proceso de Notas<br>')
                    ->line('Esperamos que la utilizes con Inteligencia y NO la divulges ')
                    ->action('Ir a GaneshaSIGE','Nueva Firma Digital');

    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
   public function toArray($notifiable)
    {
        return [
            'workout' => $this->workout->id
        ];
    }
}
