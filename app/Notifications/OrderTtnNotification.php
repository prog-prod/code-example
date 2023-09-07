<?php

namespace App\Notifications;

use App\Contracts\NotificationBySmsInterface;
use App\Models\Order;
use App\Notifications\Channels\sms\SmsChannel;
use App\Notifications\Channels\sms\SmsMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class OrderTtnNotification extends Notification implements NotificationBySmsInterface
{
    use Queueable;

    public Order $order;

    /**
     * Create a new notification instance.
     */
    public function __construct(Order $order)
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
        return [SmsChannel::class];
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

    public function toSms(object $notifiable)
    {
        return SmsMessage::create()
            ->content(
                "TTN: 123321"
            );
    }
}
