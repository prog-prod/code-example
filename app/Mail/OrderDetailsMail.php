<?php

namespace App\Mail;

use App\Facades\CommonFacade;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderDetailsMail extends Mailable
{
    use Queueable, SerializesModels;

    public Order $order;
    public array $socials;

    /**
     * Create a new message instance.
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
        $this->order->load(
            [
                'orderItems',
                'orderItems.product',
                'orderItems.product.images',
                'customer',
                'currency',
                'payment',
                'payment.paymentMethod'
            ]
        );
        $this->socials = CommonFacade::getSocialNetworks();
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: __('messages.mail.thanks_for_your_order'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.thanks_for_order'
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
