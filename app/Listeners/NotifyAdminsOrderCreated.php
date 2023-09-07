<?php

namespace App\Listeners;

use App\Contracts\AdminRepositoryInterface;
use App\Events\OrderCreated;
use App\Notifications\OrderCreatedTelegramNotification;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyAdminsOrderCreated implements ShouldQueue
{
    private AdminRepositoryInterface $adminRepository;

    /**
     * Create the event listener.
     */
    public function __construct(AdminRepositoryInterface $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    /**
     * Handle the event.
     */
    public function handle(OrderCreated $event): void
    {
        $admins = $this->adminRepository->getAdminsWithTelegramChat();

        foreach ($admins as $admin) {
            $admin->notify(new OrderCreatedTelegramNotification($event->order));
        }
    }
}
