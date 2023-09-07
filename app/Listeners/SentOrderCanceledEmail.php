<?php

namespace App\Listeners;

use App\Events\OrderCanceled;
use App\Notifications\OrderCanceledNotification;
use Illuminate\Contracts\Queue\ShouldQueue;

class SentOrderCanceledEmail implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderCanceled $event): void
    {
        $event->order->customer->notify(new OrderCanceledNotification($event->order));
    }
}
