<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventRegistrationControllerAdmin extends Controller
{
    /**
     * Display a listing of registrations.
     */
    public function index(Request $request)
    {
        $query = EventRegistration::with('event')->orderBy('created_at', 'desc');

        // Filter by event
        if ($request->filled('event_id')) {
            $query->where('event_id', $request->event_id);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search by name or email
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('registration_code', 'like', "%{$search}%");
            });
        }

        $registrations = $query->paginate(10)->withQueryString();
        $events = Event::orderBy('title')->get();

        return view('backend.event-registrations.index', compact('registrations', 'events'));
    }

    /**
     * Show the form for creating a new registration (manual admin entry).
     */
    public function create()
    {
        $events = Event::orderBy('title')->get();
        return view('backend.event-registrations.create', compact('events'));
    }

    /**
     * Store a newly created registration (manual admin entry).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'participant_type' => 'required|string|max:100',
            'message' => 'nullable|string|max:500',
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);

        // Check for duplicate registration
        $existing = EventRegistration::where('event_id', $validated['event_id'])
            ->where('email', $validated['email'])
            ->first();

        if ($existing) {
            return redirect()->back()
                ->with('error', 'This email is already registered for this event!')
                ->withInput();
        }

        // Create registration
        $registration = EventRegistration::create([
            'event_id' => $validated['event_id'],
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'participant_type' => $validated['participant_type'],
            'message' => $validated['message'] ?? null,
            'registration_code' => 'REG-' . strtoupper(Str::random(8)),
            'status' => $validated['status'],
            'registered_at' => now(),
        ]);

        if ($validated['status'] == 'confirmed') {
            $registration->confirmed_at = now();
            $registration->save();
        }

        return redirect()->route('admin.registrations.index')
            ->with('success', 'Registration created successfully! Registration code: ' . $registration->registration_code);
    }

    /**
     * Display the specified registration.
     */
    public function show($id)
    {
        $registration = EventRegistration::with('event')->findOrFail($id);
        return view('backend.event-registrations.show', compact('registration'));
    }

    /**
     * Show the form for editing the specified registration.
     */
    public function edit($id)
    {
        $registration = EventRegistration::findOrFail($id);
        $events = Event::orderBy('title')->get();
        return view('backend.event-registrations.edit', compact('registration', 'events'));
    }

    /**
     * Update the specified registration.
     */
    public function update(Request $request, $id)
    {
        $registration = EventRegistration::findOrFail($id);

        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'participant_type' => 'required|string|max:100',
            'message' => 'nullable|string|max:500',
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);

        // Check for duplicate registration (excluding current)
        $existing = EventRegistration::where('event_id', $validated['event_id'])
            ->where('email', $validated['email'])
            ->where('id', '!=', $id)
            ->first();

        if ($existing) {
            return redirect()->back()
                ->with('error', 'This email is already registered for this event!')
                ->withInput();
        }

        $registration->update($validated);

        // Update confirmed_at if status is confirmed
        if ($validated['status'] == 'confirmed' && !$registration->confirmed_at) {
            $registration->confirmed_at = now();
            $registration->save();
        } elseif ($validated['status'] != 'confirmed') {
            $registration->confirmed_at = null;
            $registration->save();
        }

        return redirect()->route('admin.registrations.index')
            ->with('success', 'Registration updated successfully!');
    }

    /**
     * Remove the specified registration.
     */
    public function destroy($id)
    {
        $registration = EventRegistration::findOrFail($id);
        $registration->delete();

        return redirect()->route('admin.registrations.index')
            ->with('success', 'Registration deleted successfully!');
    }

    /**
     * Export registrations to CSV.
     */
    public function export($eventId = null)
    {
        $query = EventRegistration::with('event');

        if ($eventId) {
            $query->where('event_id', $eventId);
        }

        $registrations = $query->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="registrations.csv"',
        ];

        $callback = function () use ($registrations) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', 'Event', 'Name', 'Email', 'Phone', 'Type', 'Status', 'Registration Code', 'Registered At', 'Confirmed At']);

            foreach ($registrations as $reg) {
                fputcsv($file, [
                    $reg->id,
                    $reg->event->title ?? 'N/A',
                    $reg->name,
                    $reg->email,
                    $reg->phone ?? 'N/A',
                    $reg->participant_type_label ?? $reg->participant_type,
                    $reg->status_label,
                    $reg->registration_code,
                    $reg->created_at->format('Y-m-d H:i'),
                    $reg->confirmed_at ? $reg->confirmed_at->format('Y-m-d H:i') : 'N/A',
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
