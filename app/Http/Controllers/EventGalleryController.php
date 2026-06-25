<?php

namespace App\Http\Controllers;

use App\Models\EventGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventGalleryController extends Controller
{
    /**
     * Display gallery images.
     */
    public function index()
    {
        $galleryImages = EventGallery::latest()->paginate(12);

        return view('backend.event-galleries.index', compact('galleryImages'));
    }

    /**
     * Show upload form.
     */
    public function create()
    {
        return view('backend.event-galleries.create');
    }

    /**
     * Store multiple gallery images.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'images' => 'required|array|min:1',
            'images.*' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        foreach ($request->file('images') as $image) {
            EventGallery::create([
                'image' => $image->store('event-galleries', 'public'),
            ]);
        }

        return redirect()
            ->route('admin.event-galleries.index')
            ->with('success', 'Gallery images uploaded successfully.');
    }

    /**
     * Delete a gallery image.
     */
    public function destroy(EventGallery $eventGallery)
    {
        Storage::disk('public')->delete($eventGallery->image);
        $eventGallery->delete();

        return redirect()
            ->route('admin.event-galleries.index')
            ->with('success', 'Gallery image deleted successfully.');
    }
}