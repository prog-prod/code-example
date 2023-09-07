<?php

namespace App\Listeners;

use App\Contracts\AdminRepositoryInterface;
use App\Events\OrderCanceled;
use App\Notifications\OrderCanceledTelegramNotification;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyAdminsOrderCanceled implements ShouldQueue
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
    public function handle(OrderCanceled $event): void
    {
        $admins = $this->adminRepository->getAdminsWithTelegramChat();

        foreach ($admins as $admin) {
            $admin->notify(new OrderCanceledTelegramNotification($event->order));
        }
    }
}
