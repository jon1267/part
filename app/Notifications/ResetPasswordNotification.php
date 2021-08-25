<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    public $token;

    /**
     * Create a new notification instance.
     * @param $token
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
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

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Сброс пароля для вашего аккаунта')
                    ->greeting('Уважаемый партнер.')
                    ->line('Вы получили это сообщение потому, что запросили сброс пароля, для вашего аккаунта .')
                    ->action('Сбросить пароль', url('password/reset', [$this->token, $notifiable->email]))
                    ->line('Эта ссылка на сброс пароля будет действовать 60 минут.')
                    ->line('Если вы не запрашивали сброс пароля, то можете ничего не предпринимать, и просто удалить это письмо.');
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
            //
        ];
    }
}
