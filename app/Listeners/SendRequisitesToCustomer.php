<?php

namespace App\Listeners;

use App\Events\PendingPaymentForOrder;
use App\Models\Order;
use App\Notifications\OrderRequisitesNotification;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendRequisitesToCustomer implements ShouldQueue
{
    private Order $order;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     */
    public function handle(PendingPaymentForOrder $event): void
    {
        $event->order->customer->notify(new OrderRequisitesNotification($event->order));
    }
}
