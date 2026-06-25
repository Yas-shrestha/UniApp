<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\EventRegistration;
use App\Models\Event;

class OrganizerRegistration extends Mailable
{
    use Queueable, SerializesModels;

    public EventRegistration $registration;
    public Event $event;

    public function __construct(EventRegistration $registration, Event $event)
    {
        $this->registration = $registration;
        $this->event = $event;
    }

    public function build(): self
    {
        return $this->subject('New Registration: ' . $this->event->title)
            ->view('emails.organizer_registration');
    }
}
