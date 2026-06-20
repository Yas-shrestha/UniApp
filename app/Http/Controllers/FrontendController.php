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

        $solutionsPast   = Service::where('type', 'traditional')->orderBy('created_at')->get();
        $solutionsFuture = Service::where('type', 'future')->orderBy('created_at')->get();

        $testimonials = [
            [
                ['name' => 'Kate Winslet', 'role' => 'HR Manager', 'stars' => 5, 'text' => 'The preference system is system is system is system.', 'image' => 'assets/img/testimonials/testimonials-1.jpg'],
                ['name' => 'Tom',          'role' => 'HR Manager', 'stars' => 5, 'text' => 'The preference system is system is system is system.', 'image' => 'assets/img/testimonials/testimonials-2.jpg'],
                ['name' => 'Elena',        'role' => 'HR Manager', 'stars' => 5, 'text' => 'The preference system is system is system is system.', 'image' => 'assets/img/testimonials/testimonials-3.jpg'],
            ],
            [
                ['name' => 'Sophia Martinez', 'role' => 'HR Manager', 'stars' => 5, 'text' => 'The preference system is system is system is system.', 'image' => 'assets/img/avatar-2.webp'],
                ['name' => 'Marcus Sterling', 'role' => 'HR Manager', 'stars' => 5, 'text' => 'The preference system is system is system is system.', 'image' => 'assets/img/avatar-1.webp'],
                ['name' => 'Aiden Patel',     'role' => 'HR Manager', 'stars' => 5, 'text' => 'The preference system is system is system is system.', 'image' => 'assets/img/avatar-3.webp'],
            ],
        ];
        return view('frontend.index', compact(
            'upcomingEvents',
            'latestBlogs',
            'testimonials',
            'solutionsPast',
            'solutionsFuture',
        ));
    }
    public function about()
    {
        return view('frontend.about');
    }
    public function ourStory()
    {
        $stories = [
            [
                'id' => 1,
                'label' => 'Chapter 01',
                'title' => 'Where It Started',
                'excerpt' => 'Grandview began with a simple belief: technology should help businesses work with more clarity, efficiency, and confidence.',
                'content' => 'Grandview was built around the idea that digital transformation should solve real business problems rather than add more complexity. As organizations adopted new tools and systems, many still faced disconnected workflows, repetitive manual tasks, and operational inefficiencies. We saw an opportunity to create a more intelligent approach—one that combines practical business understanding with modern AI-driven solutions.'
            ],
            [
                'id' => 2,
                'label' => 'Chapter 02',
                'title' => 'From Vision to Service',
                'excerpt' => 'What started as a belief in smarter technology evolved into a service-led company focused on meaningful business outcomes.',
                'content' => 'From the beginning, our focus was never just to build software for the sake of innovation. We wanted to create services that help organizations solve operational challenges, improve internal experiences, and make better decisions. That meant understanding how teams work, where inefficiencies exist, and how intelligent systems could create measurable value in day-to-day operations.'
            ],
            [
                'id' => 3,
                'label' => 'Chapter 03',
                'title' => 'Building Smarter Experiences',
                'excerpt' => 'As business needs evolved, so did our work—toward AI-powered services that improve workflows, communication, and employee experiences.',
                'content' => 'As we worked more closely with organizations, one thing became clear: the future of work is not only about automation, but also about experience. Businesses needed systems that reduced friction, supported employees more effectively, and made information easier to access and act on. This shaped our approach to building smarter workplace solutions that feel useful, intuitive, and aligned with the way modern teams operate.'
            ],
            [
                'id' => 4,
                'label' => 'Chapter 04',
                'title' => 'Expanding Our Impact',
                'excerpt' => 'Grandview continues to support organizations through intelligent automation, digital transformation, and future-ready AI services.',
                'content' => 'Today, Grandview works with businesses looking to modernize operations, improve digital processes, and unlock the value of AI in practical ways. Our role has grown from delivering solutions to becoming a partner in helping organizations adapt, innovate, and move forward with confidence. Every project we take on is guided by the same principle that shaped our beginning: technology should make work smarter, not harder.'
            ],
        ];

        return view('frontend.our-story', compact('stories'));
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
    public function eventDetail(string $slug)
    {
        $event = Event::with(['category', 'registrations'])->where('slug', $slug)->firstOrFail();

        $upcoming = Event::upcoming()
            ->where('category_id', $event->category_id)
            ->where('id', '!=', $event->id)
            ->take(3)
            ->get();

        $past = Event::past()
            ->where('category_id', $event->category_id)
            ->where('id', '!=', $event->id)
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
        $type = $request->get('type');

        $query = Service::orderBy('created_at');

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
