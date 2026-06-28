<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Event;
use App\Models\Service;
use App\Models\Contact;
use App\Models\EventRegistration;
use App\Models\ServiceReview;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Date filter
        $dateFilter = $request->get('date_filter', 'all');
        $startDate  = null;
        $endDate    = now();

        switch ($dateFilter) {
            case 'today':
                $startDate = today();
                break;
            case 'week':
                $startDate = now()->startOfWeek();
                break;
            case 'month':
                $startDate = now()->startOfMonth();
                break;
            case 'custom':
                $startDate = $request->filled('start_date') ? Carbon::parse($request->start_date)->startOfDay() : null;
                $endDate   = $request->filled('end_date')   ? Carbon::parse($request->end_date)->endOfDay()     : now();
                break;
        }

        // Helper scope
        $filtered = fn($model) => $startDate
            ? $model::whereBetween('created_at', [$startDate, $endDate])
            : $model::query();

        // Counts
        $totalBlogs         = $filtered(Blog::class)->count();
        $totalEvents        = $filtered(Event::class)->count();
        $totalServices      = Service::count(); // services don't change by date usually
        $totalMessages      = $filtered(Contact::class)->count();
        $unreadMessages     = Contact::where('status', 'unread')->count();
        $totalRegistrations = $filtered(EventRegistration::class)->count();
        $pendingReviews     = ServiceReview::where('status', 'pending')->count();

        // Upcoming events (always future, not filtered)
        $upcomingEvents = Event::where('date', '>=', today())
            ->orderBy('date')
            ->take(5)
            ->get();

        // Recent messages
        $recentMessages = $filtered(Contact::class)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Monthly registrations chart (last 6 months)
        $registrationChart = collect(range(5, 0))->map(function ($i) use ($startDate, $endDate, $dateFilter) {
            $month = now()->subMonths($i);
            $query = EventRegistration::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month);
            if ($startDate && $dateFilter !== 'all') {
                $query->whereBetween('created_at', [$startDate, $endDate]);
            }
            return [
                'month' => $month->format('M Y'),
                'count' => $query->count(),
            ];
        });

        // Monthly messages chart (last 6 months)
        $messagesChart = collect(range(5, 0))->map(function ($i) use ($startDate, $endDate, $dateFilter) {
            $month = now()->subMonths($i);
            $query = Contact::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month);
            if ($startDate && $dateFilter !== 'all') {
                $query->whereBetween('created_at', [$startDate, $endDate]);
            }
            return [
                'month' => $month->format('M Y'),
                'count' => $query->count(),
            ];
        });

        // Message status breakdown
        $messageStatusChart = [
            'unread'  => $filtered(Contact::class)->where('status', 'unread')->count(),
            'read'    => $filtered(Contact::class)->where('status', 'read')->count(),
            'replied' => $filtered(Contact::class)->where('status', 'replied')->count(),
        ];

        $recentBlogs = $filtered(Blog::class)->orderBy('created_at', 'desc')->take(5)->get();

        return view('backend.index', compact(
            'totalBlogs',
            'totalEvents',
            'totalServices',
            'totalMessages',
            'unreadMessages',
            'totalRegistrations',
            'pendingReviews',
            'upcomingEvents',
            'recentMessages',
            'registrationChart',
            'messagesChart',
            'messageStatusChart',
            'recentBlogs',
            'dateFilter'
        ));
    }
}
