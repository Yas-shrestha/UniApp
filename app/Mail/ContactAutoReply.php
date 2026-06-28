<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Contact;

class ContactAutoReply extends Mailable
{
    use Queueable, SerializesModels;

    public Contact $contact;

    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    public function build(): self
    {
        return $this->subject('We received your message!')
            ->html("
                <h2>Thank you, {$this->contact->name}!</h2>
                <p>We have received your message and will get back to you as soon as possible.</p>
                <hr>
                <p><strong>Your message:</strong></p>
                <p>{$this->contact->message}</p>
                <hr>
                <p>Best regards,<br>The Team</p>
            ");
    }
}