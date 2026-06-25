<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\EventRegistration;
use App\Models\Event;

class ParticipantRegistration extends Mailable
{
    use Queueable, SerializesModels;

    public EventRegistration $registration;
    public Event $event;

    /**
     * Create a new message instance.
     */
    public function __construct(EventRegistration $registration, Event $event)
    {
        $this->registration = $registration;
        $this->event = $event;
    }

    /**
     * Build the message.
     */
    public function build(): self
    {
        return $this->subject('Registration Confirmed: ' . $this->event->title)
            ->view('emails.participant_registration');
    }
}
