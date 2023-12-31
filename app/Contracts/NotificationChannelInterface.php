<?php

namespace App\Contracts;

use Illuminate\Notifications\Notification;

interface NotificationChannelInterface
{
    public function send($notifiable, Notification $notification): void;
}
