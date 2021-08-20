<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PassivePartnerNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
            ->markdown('vendor.notifications.passive_partter_email')
            ->subject('Начните зарабатывать с нашей партнерской программой.')
            ->greeting('Начните зарабатывать с нашей партнерской программой parfumdeparis!')
            ->line('Видим что вы так и не начали работать и зарабатывать с нашей партнерской программой parfumdeparis,'.
                ' за это время многие партнеры уже заработали свои первые несколько тысяч гривен, без особых усилий, '.
                ' всего лишь распечатав визитки своего сайта и порекомендовав его своим друзьям и знакомым!'.
                ' Не упускай свой шанс начать зарабатывать действительно без особого труда и финансовых затрат!'
            );
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
