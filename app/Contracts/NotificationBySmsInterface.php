<?php

namespace App\Contracts;

interface NotificationBySmsInterface
{
    public function toSms(object $notifiable);
}
