<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class RequestPaymentDropshipperNotification extends Notification
{
    use Queueable;

    private $payment;

    /**
     * Create a new notification instance.
     * @param $payment
     * @return void
     */
    public function __construct(array $payment)
    {
        $this->payment = $payment;
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
            ->subject('Запрос платежа от дропшиппера')
            ->greeting('Запрос платежа от дропшиппера!')
            ->line('Код партнера: '. $this->payment['kod'])
            ->line('ФИО: '. $this->payment['name'])
            ->line('Телефон: '. $this->payment['tel'])
            ->line('Email: '. $this->payment['email'])
            ->line('Банковская информация: '. $this->payment['bank'])
            ->line('Сумма: '. number_format($this->payment['total'],2).$this->payment['valuta'])
            //->line('Заказы: '. $this->payment['order'])
            ->line(new HtmlString('Заказы: ' . $this->payment['order']));
            //->action('Notification Action', url('/'))
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
