<?php

namespace App\Providers;

use App\Events\ContactFormSubmittedEvent;
use App\Events\OrderCanceled;
use App\Events\OrderConfirmed;
use App\Events\OrderCreated;
use App\Events\OrderPaid;
use App\Events\PendingPaymentForOrder;
use App\Listeners\CreateTTN;
use App\Listeners\CreateUserCartListener;
use App\Listeners\NotifyAdminsOrderCanceled;
use App\Listeners\NotifyAdminsOrderCreated;
use App\Listeners\NotifyAdminsOrderPaid;
use App\Listeners\SendContactFormNotificationListener;
use App\Listeners\SendRequisitesToCustomer;
use App\Listeners\SendTtnToCustomer;
use App\Listeners\SentOrderCanceledEmail;
use App\Listeners\SentOrderDetailsEmail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
            CreateUserCartListener::class
        ],
        ContactFormSubmittedEvent::class => [
            SendContactFormNotificationListener::class
        ],
        OrderCreated::class => [
            SentOrderDetailsEmail::class,
            NotifyAdminsOrderCreated::class
        ],
        OrderCanceled::class => [
            SentOrderCanceledEmail::class,
            NotifyAdminsOrderCanceled::class,
        ],
        PendingPaymentForOrder::class => [
            SendRequisitesToCustomer::class
        ],
        OrderConfirmed::class => [
            CreateTTN::class,
            SendTtnToCustomer::class,
        ],
        OrderPaid::class => [
            NotifyAdminsOrderPaid::class
        ]
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
