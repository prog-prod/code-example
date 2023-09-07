<?php

namespace App\Notifications;

use App\Contracts\NotificationByTelegramInterface;
use App\Notifications\Channels\TelegramChannel;
use App\Notifications\Channels\TelegramMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class OrderCreatedTelegramNotification extends Notification implements NotificationByTelegramInterface
{
    use Queueable;

    private $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return [TelegramChannel::class];
    }

    public function toTelegram($notifiable)
    {
        return TelegramMessage::create()
            ->content(
                "Було оформлене нове замовлення: {$this->order->id}\nПерейти: " . route(
                    "admin.orders.show",
                    $this->order->id
                )
            );
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
