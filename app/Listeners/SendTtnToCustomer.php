<?php

namespace App\Listeners;

use App\Events\OrderConfirmed;
use App\Notifications\OrderTtnNotification;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendTtnToCustomer implements ShouldQueue
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
    public function handle(OrderConfirmed $event): void
    {
        $event->order->customer->notify(new OrderTtnNotification($event->order));
    }
}
