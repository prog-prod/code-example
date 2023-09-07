<?php

namespace App\Listeners;

use App\Contracts\NovaPoshtaServiceInterface;
use App\Events\OrderConfirmed;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateTTN implements ShouldQueue
{
    private NovaPoshtaServiceInterface $novaPoshtaService;

    /**
     * Create the event listener.
     */
    public function __construct(NovaPoshtaServiceInterface $novaPoshtaService)
    {
        $this->novaPoshtaService = $novaPoshtaService;
    }

    /**
     * Handle the event.
     */
    public function handle(OrderConfirmed $event): void
    {
        $this->novaPoshtaService->createTTN($event->order);
    }
}
