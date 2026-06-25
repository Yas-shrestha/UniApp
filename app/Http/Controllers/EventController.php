<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EventController extends Controller
{
    /**
     * Display a listing of events.
     */
    public function index(Request $request)
    {
        $categories = Category::all();
        $category = $request->query('category');

        $events = Event::with('category')
            ->upcoming()
            ->when($category, fn ($q) => $q->byCategory($category))
            ->paginate(5)
            ->withQueryString();

        return view('backend.events.index', compact('events', 'categories', 'category'));
    }

    /**
     * Show the form for creating a new event.
     */
    public function create()
    {
        $categories = Category::all();

        return view('backend.events.create', compact('categories'));
    }

    /**
     * Store a newly created event.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255|not_regex:/\d/',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'date' => 'required|date',
            'time' => 'required|string|max:100',
            'location' => 'required|string|max:255',
            'seats' => 'required|string|max:100',
            'admission' => 'nullable|string|max:255',
            'intro' => 'required|string',
            'points' => 'required|array|min:1',
            'points.*' => 'required|string',
            'audience' => 'required|string',
            'speaker_name' => 'required|string|max:255',
            'speaker_role' => 'required|string|max:255',
            'speaker_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('events', 'public');
        }

        if ($request->hasFile('speaker_image')) {
            $validated['speaker_image'] = $request->file('speaker_image')->store('speakers', 'public');
        }

        $event = Event::create($validated);

        return redirect('/admin/events')->with('success', 'Event created successfully.');
    }

    /**
     * Display the specified event.
     */
    public function show(string $slug)
    {
        $event = Event::with('category')->where('slug', $slug)->firstOrFail();

        $relatedEvents = $event->getRelatedEvents();

        return view('backend.events.view', compact('event', 'relatedEvents'));
    }

    /**
     * Show the form for editing the specified event.
     */
    public function edit(Event $event)
    {
        $categories = Category::all();

        return view('backend.events.edit', compact('event', 'categories'));
    }

    /**
     * Update the specified event.
     */
    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255|not_regex:/\d/',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'date' => 'required|date',
            'time' => 'required|string|max:100',
            'location' => 'required|string|max:255',
            'seats' => 'required|string|max:100',
            'admission' => 'nullable|string|max:255',
            'intro' => 'required|string',
            'points' => 'required|array|min:1',
            'points.*' => 'required|string',
            'audience' => 'required|string',
            'speaker_name' => 'required|string|max:255',
            'speaker_role' => 'required|string|max:255',
            'speaker_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('events', 'public');
        }

        if ($request->hasFile('speaker_image')) {
            $validated['speaker_image'] = $request->file('speaker_image')->store('speakers', 'public');
        }

        $event->update($validated);

        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $image) {
                $event->galleries()->create([
                    'image' => $image->store('event-galleries', 'public'),
                ]);
            }
        }

        return redirect('/admin/events')->with('success', 'Event updated successfully.');
    }

    /**
     * Remove the specified event.
     */
    public function destroy(Event $event)
    {
        foreach ($event->galleries as $gallery) {
            Storage::disk('public')->delete($gallery->image);
        }

        $event->delete();

        return redirect('/admin/events')->with('success', 'Event deleted successfully.');
    }
}
