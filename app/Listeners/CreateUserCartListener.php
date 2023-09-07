<?php

namespace App\Listeners;

use App\Contracts\CartRepositoryInterface;
use Illuminate\Auth\Events\Registered;

class CreateUserCartListener
{
    private CartRepositoryInterface $cartRepository;

    /**
     * Create the event listener.
     */
    public function __construct(CartRepositoryInterface $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    /**
     * Handle the event.
     */
    public function handle(Registered $event): void
    {
        if (!$event->user->cart) {
            $this->cartRepository->createCart($event->user);
        }
    }
}
