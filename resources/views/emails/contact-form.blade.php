@component('mail::message')
    # New Contact Form Submission

    Hello,

    We have received a new contact form submission with the following details:

    Name: {{ $contactFormName }}
    Email: {{ $contactFormEmail }}
    Subject: {{ $contactFormSubject }}
    Message: {{ $contactFormMessage }}

    Thank you,
    {{ config('app.name') }}
@endcomponent
