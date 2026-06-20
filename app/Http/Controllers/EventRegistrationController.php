<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventRegistrationController extends Controller
{
    public function store(Request $request, Event $event)
    {
        // Validate
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'participant_type' => 'required|string|max:100',
            'message' => 'nullable|string|max:500',
        ]);

        // Check if fully booked
        if ($event->isFullyBooked()) {
            return redirect()->back()->with('error', 'Sorry, this event is fully booked!');
        }

        // Check for duplicate registration
        $existing = EventRegistration::where('event_id', $event->id)
            ->where('email', $validated['email'])
            ->first();

        if ($existing) {
            return redirect()->back()->with('error', 'You are already registered for this event!');
        }

        // Create registration
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

        return redirect()->back()->with('success', 'Registration successful! Your registration code is: ' . $registration->registration_code);
    }
}
