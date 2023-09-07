<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $contactFormName;
    public string $contactFormEmail;
    public string $contactFormMessage;
    public string $contactFormSubject;

    /**
     * Create a new message instance.
     */
    public function __construct($name, $email, $message, $subject)
    {
        $this->contactFormName = $name;
        $this->contactFormEmail = $email;
        $this->contactFormMessage = $message;
        $this->contactFormSubject = $subject;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Contact Form Mail'
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.contact-form',
            with: [
                'contactFormName' => $this->contactFormName,
                'contactFormEmail' => $this->contactFormEmail,
                'contactFormMessage' => $this->contactFormMessage,
                'contactFormSubject' => $this->contactFormSubject,
            ],
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
