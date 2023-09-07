<?php

namespace App\Notifications\Channels\sms;

use App\Contracts\NotificationBySmsInterface;
use App\Contracts\NotificationChannelInterface;
use App\Contracts\SMSServiceInterface;
use Illuminate\Notifications\Notification;

class SmsChannel implements NotificationChannelInterface
{

    public function send($notifiable, NotificationBySmsInterface|Notification $notification): void
    {
        $message = $notification->toSms($notifiable);
        $smsService = app(
            SMSServiceInterface::class
        );

//        Log::info(
//            "Sending SMS message to customer {$notifiable->email}: {$message->content} to the phone: {$notifiable->cleaned_phone}"
//        );
        $smsService->setPhones([$notifiable->cleaned_phone])->sendSms($message->content);
    }
}
