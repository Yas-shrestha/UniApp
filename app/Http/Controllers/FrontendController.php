<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Event;
use App\Models\Service;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $upcomingEvents = Event::with('category')->upcoming()->take(3)->get();
        $latestBlogs    = Blog::with('category')->published()->latest('published_at')->take(3)->get();

        return view('frontend.index', compact('upcomingEvents', 'latestBlogs'));
    }
    public function about()
    {
        return view('frontend.about');
    }
    public function blog(Request $request)
    {
        $search   = $request->input('search');
        $category = $request->input('category');

        $blogs = Blog::with('category')
            ->published()
            ->when($search, fn($q) => $q->where('title', 'like', "%{$search}%")
                ->orWhere('excerpt', 'like', "%{$search}%"))
            ->when($category, fn($q) => $q->whereHas('category', fn($q) => $q->where('slug', $category)))
            ->latest('published_at')
            ->paginate(6)
            ->withQueryString(); // keeps ?search=&category= on pagination links

        $featured   = Blog::with('category')->published()->latest('published_at')->first();
        $categories = Category::orderBy('name')->get();

        return view('frontend.blog', compact('blogs', 'featured', 'categories', 'search', 'category'));
    }
    public function blogDetail(string $slug)
    {
        $blog = Blog::with('category')->where('slug', $slug)->firstOrFail();

        $relatedBlogs = Blog::with('category')
            ->where('category_id', $blog->category_id)
            ->where('id', '!=', $blog->id)
            ->published()
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('frontend.blog-detail', compact('blog', 'relatedBlogs'));
    }
    public function contact()
    {
        return view('frontend.contact');
    }
    public function courses()
    {
        return view('frontend.courses');
    }
    public function eventDetail(Event $event)
    {
        $event->load('category');

        $upcoming = Event::upcoming()
            ->where('category_id', $event->category_id)
            ->where('id', '!=', $event->id)
            ->latest('date')
            ->take(3)
            ->get();

        $past = Event::past()
            ->where('category_id', $event->category_id)
            ->latest('date')
            ->take(3)
            ->get();

        return view('frontend.event-detail', compact('event', 'upcoming', 'past'));
    }
    public function events(Request $request)
    {
        $query = Event::with('category')->upcoming();

        if ($request->filled('category')) {
            $query->byCategory($request->category);
        }

        $events = $query->paginate(6)->withQueryString();

        $categories = Category::orderBy('name')->get();

        return view('frontend.events', compact('events', 'categories'));
    }
    public function serviceDetails(string $slug)
    {
        $service = Service::where('slug', $slug)->firstOrFail();

        $allServices = Service::orderBy('title')->get();

        $relatedServices = Service::where('type', $service->type)
            ->where('id', '!=', $service->id)
            ->latest()
            ->take(3)
            ->get();

        return view('frontend.service-details', compact('service', 'allServices', 'relatedServices'));
    }
    public function services(Request $request)
    {
        $type = $request->input('type');

        $query = Service::query();

        if ($type) {
            $query->where('type', $type);
        }

        $services = $query->paginate(6)->withQueryString();

        return view('frontend.services', compact('services', 'type'));
    }
    public function starterPage()
    {
        return view('frontend.starter-page');
    }
}
