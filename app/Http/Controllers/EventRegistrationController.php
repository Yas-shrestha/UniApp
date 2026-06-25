<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventRegistration;
use App\Mail\ParticipantRegistration;
use App\Mail\OrganizerRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class EventRegistrationController extends Controller
{
    public function store(Request $request, Event $event)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'participant_type' => 'required|string|max:100',
            'message' => 'nullable|string|max:500',
        ]);

        if ($event->isFullyBooked()) {
            return back()->with('error', 'Sorry, this event is fully booked!');
        }

        $existing = EventRegistration::where('event_id', $event->id)
            ->where('email', $validated['email'])
            ->first();

        if ($existing) {
            return back()->with('error', 'You are already registered for this event!');
        }

        $registration = EventRegistration::create([
            'event_id' => $event->id,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'participant_type' => $validated['participant_type'],
            'message' => $validated['message'] ?? null,
            'registration_code' => 'REG-' . strtoupper(Str::random(8)),
            'status' => 'pending',
        ]);

        try {
            Mail::to($registration->email)
                ->send(new ParticipantRegistration($registration, $event));
        } catch (\Throwable $e) {
            Log::error('Participant registration email failed', [
                'registration_id' => $registration->id,
                'event_id' => $event->id,
                'email' => $registration->email,
                'error' => $e->getMessage(),
            ]);
        }

        $organizerEmail = config('services.event_registration.organizer_email');

        if ($organizerEmail) {
            try {
                Mail::to($organizerEmail)
                    ->send(new OrganizerRegistration($registration, $event));
            } catch (\Throwable $e) {
                Log::error('Organizer registration email failed', [
                    'registration_id' => $registration->id,
                    'event_id' => $event->id,
                    'email' => $organizerEmail,
                    'error' => $e->getMessage(),
                ]);
            }
        }

        return back()->with(
            'success',
            'Registration successful! Your registration code is: ' . $registration->registration_code
        );
    }
}