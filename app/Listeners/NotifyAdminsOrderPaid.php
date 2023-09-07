<?php

namespace App\Listeners;

use App\Contracts\AdminRepositoryInterface;
use App\Events\OrderPaid;
use App\Notifications\OrderPaidTelegramNotification;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyAdminsOrderPaid implements ShouldQueue
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
    public function handle(OrderPaid $event): void
    {
        $admins = $this->adminRepository->getAdminsWithTelegramChat();

        foreach ($admins as $admin) {
            $admin->notify(new OrderPaidTelegramNotification($event->order));
        }
    }
}
