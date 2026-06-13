<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Event;
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
    public function blog()
    {
        $blogs = Blog::with('category')
            ->published()
            ->latest('published_at')
            ->paginate(6);

        $featured = $blogs->first();
        $categories = Category::orderBy('name')->get();
        $search = request('search');
        $category = request('category');

        return view('frontend.blog', compact('blogs', 'featured', 'categories', 'search', 'category'));
    }
    public function blogDetail(Blog $blog)
    {
        $blog->load('category');

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
    public function events()
    {
        $events = Event::with('category')
            ->upcoming()
            ->latest('date')
            ->paginate(6);

        $categories = Category::orderBy('name')->get();

        return view('frontend.events', compact('events', 'categories'));
    }
    public function serviceDetails()
    {
        return view('frontend.service-details');
    }
    public function services()
    {
        return view('frontend.services');
    }
    public function starterPage()
    {
        return view('frontend.starter-page');
    }
}
