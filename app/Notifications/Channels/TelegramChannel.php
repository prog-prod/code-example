<?php

namespace App\Notifications\Channels;

use App\Contracts\NotificationByTelegramInterface;
use App\Contracts\NotificationChannelInterface;
use App\Contracts\TelegramServiceInterface;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class TelegramChannel implements NotificationChannelInterface
{
    public function send($notifiable, Notification|NotificationByTelegramInterface $notification): void
    {
        $message = $notification->toTelegram($notifiable);
        Log::info(json_encode([($notifiable), json_encode($notification)]));
        // Use your telegramService here to send the message
        // You may have to inject the service or resolve it from the container

        $telegramService = app(
            TelegramServiceInterface::class
        ); // Assuming you've bound your Telegram service in the container.

        foreach ($notifiable->telegramChats as $chat) {
            Log::info(
                'Sending message to admins to Telegram: ' . $message->content . " to the chat: " . $chat->chat_id
            );
            $telegramService->sendMessage($message->content, $chat->chat_id);
        }
    }
}
