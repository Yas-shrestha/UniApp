<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    /**
     * Display a listing of services.
     */
    public function index(Request $request)
    {
        $type = $request->query('type');

        $services = Service::when($type, fn($q) => $q->byType($type))
            ->latest()
            ->get();

        return view('backend.services.index', compact('services', 'type'));
    }

    /**
     * Show the form for creating a new service.
     */
    public function create()
    {
        return view('backend.services.create');
    }

    /**
     * Store a newly created service.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type'               => 'required|in:traditional,future',
            'title'              => 'required|string|max:255',
            'image'              => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'icon'               => 'nullable|string|max:100',
            'short_description'  => 'nullable|string|max:500',
            'body'               => 'required|string',
            'points'             => 'nullable|array',
            'points.*'           => 'required|string',
            'catalog_pdf'        => 'nullable|file|mimes:pdf|max:5120',
            'catalog_doc'        => 'nullable|file|mimes:doc,docx|max:5120',
            'is_featured'        => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('services', 'public');
        }

        if ($request->hasFile('catalog_pdf')) {
            $validated['catalog_pdf'] = $request->file('catalog_pdf')->store('catalogs', 'public');
        }

        if ($request->hasFile('catalog_doc')) {
            $validated['catalog_doc'] = $request->file('catalog_doc')->store('catalogs', 'public');
        }

        $validated['is_featured'] = $request->boolean('is_featured');

        Service::create($validated);

        return redirect()->route('services')->with('success', 'Service created successfully.');
    }

    /**
     * Display the specified service.
     */
    public function show(string $slug)
    {
        $service = Service::where('slug', $slug)->firstOrFail();

        $allServices   = Service::orderBy('title')->get();
        $relatedServices = $service->getRelatedServices();

        return view('backend.services.view', compact('service', 'allServices', 'relatedServices'));
    }

    /**
     * Show the form for editing the specified service.
     */
    public function edit(Service $service)
    {
        return view('backend.services.edit', compact('service'));
    }

    /**
     * Update the specified service.
     */
    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'type'               => 'required|in:traditional,future',
            'title'              => 'required|string|max:255',
            'image'              => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'icon'               => 'nullable|string|max:100',
            'short_description'  => 'nullable|string|max:500',
            'body'               => 'required|string',
            'points'             => 'nullable|array',
            'points.*'           => 'required|string',
            'catalog_pdf'        => 'nullable|file|mimes:pdf|max:5120',
            'catalog_doc'        => 'nullable|file|mimes:doc,docx|max:5120',
            'is_featured'        => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('services', 'public');
        }

        if ($request->hasFile('catalog_pdf')) {
            $validated['catalog_pdf'] = $request->file('catalog_pdf')->store('catalogs', 'public');
        }

        if ($request->hasFile('catalog_doc')) {
            $validated['catalog_doc'] = $request->file('catalog_doc')->store('catalogs', 'public');
        }

        $validated['is_featured'] = $request->boolean('is_featured');

        $service->update($validated);

        return redirect()->route('services')->with('success', 'Service updated successfully.');
    }

    /**
     * Remove the specified service.
     */
    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('services')->with('success', 'Service deleted successfully.');
    }
    public function filter(Request $request)
    {
        $type = $request->get('type');

        if ($type) {
            $services = Service::where('type', $type)->orderBy('created_at')->get();
        } else {
            $services = Service::orderBy('created_at')->get();
        }

        // If it's an AJAX request, return only the partial view
        if ($request->ajax() || $request->header('X-Requested-With') === 'XMLHttpRequest') {
            return view('frontend.partials.services-grid', compact('services'))->render();
        }

        // For regular requests, return the full page
        return view('frontend.services.index', compact('services', 'type'));
    }
}
