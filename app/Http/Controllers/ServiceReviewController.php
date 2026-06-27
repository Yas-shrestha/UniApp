<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceReview;
use Illuminate\Http\Request;

class ServiceReviewController extends Controller
{
    /**
     * Frontend - Store Review
     */
    public function store(Request $request, Service $service)
    {
        $validated = $request->validate([
            'name'   => 'required|string|max:100',
            'email'  => 'nullable|email|max:255',
            'rating' => 'required|integer|between:1,5',
            'review' => 'required|string|min:20|max:1000',
        ]);

        $service->reviews()->create([
            ...$validated,
            'status' => 'pending',
        ]);

        return back()->with(
            'success',
            'Thank you! Your review has been submitted and is awaiting admin approval.'
        );
    }

    /**
     * Admin - Review List
     */
    public function index(Request $request)
    {
        $query = ServiceReview::with('service')->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('review', 'like', "%{$search}%")
                    ->orWhereHas('service', function ($service) use ($search) {
                        $service->where('title', 'like', "%{$search}%");
                    });
            });
        }

        $reviews = $query
            ->paginate(15)
            ->withQueryString();

        return view('backend.service-reviews.index', compact('reviews'));
    }

    /**
     * Admin - Show Review
     */
    public function show(ServiceReview $serviceReview)
    {
        $serviceReview->load('service');

        return view('backend.service-reviews.show', compact('serviceReview'));
    }

    /**
     * Approve Review
     */
    public function approve(ServiceReview $serviceReview)
    {
        $serviceReview->update([
            'status' => 'approved',
        ]);

        return redirect()
            ->route('admin.service-reviews.index')
            ->with('success', 'Review approved successfully.');
    }

    /**
     * Reject Review
     */
    public function reject(ServiceReview $serviceReview)
    {
        $serviceReview->update([
            'status' => 'rejected',
        ]);

        return redirect()
            ->route('admin.service-reviews.index')
            ->with('success', 'Review rejected successfully.');
    }

    /**
     * Move Review Back To Pending
     */
    public function pending(ServiceReview $serviceReview)
    {
        $serviceReview->update([
            'status' => 'pending',
        ]);

        return redirect()
            ->route('admin.service-reviews.index')
            ->with('success', 'Review moved back to pending.');
    }

    /**
     * Delete Review
     */
    public function destroy(ServiceReview $serviceReview)
    {
        $serviceReview->delete();

        return redirect()
            ->route('admin.service-reviews.index')
            ->with('success', 'Review deleted successfully.');
    }
}