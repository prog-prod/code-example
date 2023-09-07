<?php

namespace App\Http\Controllers\Contact;

use App\Events\ContactFormSubmittedEvent;
use App\Http\Controllers\BaseController;
use App\Http\Requests\ContactSendMessageRequest;

class ContactController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->showView('Contact');
    }

    public function sendMessage(ContactSendMessageRequest $request)
    {
        event(new ContactFormSubmittedEvent($request->validated()));

        return redirect()->route('contact.index')->with('success', 'Subscriber added successfully!');
    }
}
