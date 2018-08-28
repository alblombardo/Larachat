<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class MyResetPassword extends ResetPassword implements ShouldQueue
{
    use Queueable;

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting('Ciao!')
            ->line('Hai ricevuto questa mail perchè è stata richiesta la reimpostazione della password per il tuo account.')
            ->action('Reimposta Password', url(config('app.url').route('password.reset', $this->token, false)))
            ->line('Se non hai fatto la richiesta, puoi ignorare questo messaggio.');
    }
}
