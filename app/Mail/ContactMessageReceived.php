<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Contact;

class ContactMessageReceived extends Mailable
{
    use Queueable, SerializesModels;

    public Contact $contact;

    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    public function build(): self
    {
        return $this->subject('New Contact Message from ' . $this->contact->name)
            ->html("
                <h2>New Contact Message</h2>
                <p><strong>Name:</strong> {$this->contact->name}</p>
                <p><strong>Email:</strong> {$this->contact->email}</p>
                <p><strong>Subject:</strong> {$this->contact->subject}</p>
                <p><strong>Message:</strong></p>
                <p>{$this->contact->message}</p>
            ");
    }
}