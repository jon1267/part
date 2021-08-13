<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EnjoyEarningNotification extends Notification
{
    use Queueable;

    private $partner;
    private $valuta;

    /**
     * Create a new notification instance.
     * @param $partner
     * @return void
     */
    public function __construct($partner)
    {
        $this->partner = $partner;
        $this->valuta = ($this->partner->host == 1 ) ? ' грн.' : ' руб.';
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
                    ->greeting('Уже можно выводить заработок!')
                    ->line('Вам доступно к выводу '. $this->partner->earning . $this->valuta )
                    ->line('Сделать это можно в личном кабинете, раздел "Мой доход".')
                    ->action('Перейти в Мой доход', url('http://pdp-partner.loc/cabinet/profit'))
                    ->line('Мы приложим все усилия и осуществим выплату в течение 24 часов. Спасибо, что Вы с нами, дальше - больше :)');
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
