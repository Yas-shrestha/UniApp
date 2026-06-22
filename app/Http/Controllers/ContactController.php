<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::orderBy('created_at', 'desc');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('company_name', 'like', "%{$search}%")
                    ->orWhere('job_title', 'like', "%{$search}%")
                    ->orWhere('job_details', 'like', "%{$search}%");
            });
        }

        $messages = $query->paginate(10)->withQueryString();
        $unreadCount = Contact::unread()->count();

        return view('backend.contact.index', compact('messages', 'unreadCount'));
    }

    public function store(StoreContactRequest $request)
    {
        // Validate the request
        $validated = $request->validated();

        // Create the contact message
        $contact = Contact::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'company_name' => $validated['company_name'],
            'job_title' => $validated['job_title'],
            'job_details' => $validated['job_details'],
            'phone' => $validated['phone'] ?? null,
            'message' => $validated['message'],
            'status' => 'unread',
        ]);

        // Optional: Send email notification to admin
        // You can uncomment this if you have mail configured
        // \Mail::to('admin@yourdomain.com')->send(new \App\Mail\ContactMessageReceived($contact));

        // Optional: Send auto-reply to user
        // \Mail::to($contact->email)->send(new \App\Mail\ContactAutoReply($contact));

        // Redirect back with success message
        return redirect()->back()->with('success', 'Thank you for your message! We\'ll get back to you within 24 hours.');
    }

    public function show($id)
    {
        $message = Contact::findOrFail($id);

        if ($message->isUnread()) {
            $message->markAsRead();
        }

        return view('backend.contact.show', compact('message'));
    }

    public function destroy($id)
    {
        $message = Contact::findOrFail($id);
        $message->delete();

        return redirect()->route('admin.contact.index')
            ->with('success', 'Message deleted successfully!');
    }

    public function markAsRead($id)
    {
        $message = Contact::findOrFail($id);
        $message->markAsRead();

        return redirect()->back()->with('success', 'Message marked as read!');
    }

    public function markAsReplied($id)
    {
        $message = Contact::findOrFail($id);
        $message->markAsReplied('Replied via email');

        return redirect()->back()->with('success', 'Message marked as replied!');
    }
}
