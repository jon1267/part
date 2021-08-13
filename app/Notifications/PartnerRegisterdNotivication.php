<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PartnerRegisterdNotivication extends Notification
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
                    ->greeting('Вы успешно зарегистрированы как партнер!')
                    ->line('Вы зарегистрировались в уникальной партнерской программе Parfumdeparis, которой нет аналогов.')
                    ->line('Вы получаете:')
                    ->line('Бесплатный, полностью рабочий сайт с товаром за одну минуту!')
                    ->line('Возможность зарабатывать без финансовых вложений, просто приводя людей на ваш сайт.')
                    ->line('Возможность работать с очень качественным и относительно недорогим товаром, который имеет исключительно положительный отклик от клиента.')
                    ->line('Ваши комиссионные выплаты вы получаете оперативно и по запросу.')
                    ->line('Формирование вашей, личной базы клиентов, которые в последствии приносят вам постоянный, стабильный доход, делая заказы через ваш сайт.')
                    ->line('Для того чтобы начать зарабатывать перейдите')
                    ->line('в ваш Личный кабинет и создайте ваш сайт в один клик!')
                    ->action('Перейти в личный кабинет', url('/cabinet'));
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
