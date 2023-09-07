<?php

namespace App\Listeners;

use App\Events\ContactFormSubmittedEvent;
use App\Notifications\ContactFormSubmitted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Notification;

class SendContactFormNotificationListener implements ShouldQueue
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
    public function handle(ContactFormSubmittedEvent $event): void
    {
        Notification::route('mail', config('app.support.message-receivers'))
            ->notify(new ContactFormSubmitted($event->data));
    }
}
