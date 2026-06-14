<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Event;
use App\Models\Blog;
use App\Models\Service;

class ChatbotController extends Controller
{
    public function index()
    {
        return view('chatbot');
    }

    private function buildSystemPrompt(): string
    {
        $events = Event::select('title', 'slug', 'date', 'location', 'admission')->latest()->get();
        $services = Service::select('title', 'slug', 'short_description')->latest()->get();
        $blogs = Blog::select('title', 'slug', 'author', 'published_at', 'excerpt')->latest()->take(10)->get();

        $eventsText = $events->map(
            fn($e) =>
            "- {$e->title} | date: " . \Carbon\Carbon::parse($e->date)->format('M d, Y') . " | location: {$e->location} | admission: {$e->admission} | slug: {$e->slug}"
        )->join("\n");

        $servicesText = $services->map(
            fn($s) =>
            "- {$s->title} | slug: {$s->slug} | description: " . str($s->short_description)->limit(80)
        )->join("\n");

        $blogsText = $blogs->map(
            fn($b) =>
            "- {$b->title} | slug: {$b->slug} | author: {$b->author}"
        )->join("\n");

        return "You are a helpful assistant for Grandview college.
You answer questions about our events, services, blogs, and general queries.

IMPORTANT FORMATTING RULES:
- When listing events, ALWAYS use exactly this format for each event:
  [EVENT] title={title} | date={date} | location={location} | slug={slug} [/EVENT]
- When listing services, ALWAYS use exactly this format for each service:
  [SERVICE] title={title} | slug={slug} | description={short description} [/SERVICE]
- When listing blogs, ALWAYS use exactly this format for each blog:
  [BLOG] title={title} | slug={slug} | author={author} [/BLOG]
- You can add plain text before or after the structured items.
- Never use markdown bold (**) or bullet points for structured items.

CURRENT DATA:

Events:
{$eventsText}

Services:
{$servicesText}

Blogs:
{$blogsText}

Keep answers friendly and helpful. Only use the structured format when the user asks about events, services, or blogs.";
    }

    public function chat(Request $request)
    {
        $request->validate([
            'messages'           => 'required|array',
            'messages.*.role'    => 'required|in:user,assistant',
            'messages.*.content' => 'required|string|max:2000',
        ]);

        $geminiMessages = [
            [
                'role'  => 'user',
                'parts' => [['text' => 'System instructions: ' . $this->buildSystemPrompt()]],
            ],
            [
                'role'  => 'model',
                'parts' => [['text' => 'Understood! I will help with events, services, blogs and general questions.']],
            ],
        ];

        foreach ($request->messages as $msg) {
            $geminiMessages[] = [
                'role'  => $msg['role'] === 'assistant' ? 'model' : 'user',
                'parts' => [['text' => $msg['content']]],
            ];
        }

        $apiKey   = config('services.gemini.key');
        $response = Http::post(
            "https://generativelanguage.googleapis.com/v1beta/models/gemini-flash-latest:generateContent?key={$apiKey}",
            ['contents' => $geminiMessages]
        );

        if ($response->failed()) {
            return response()->json(['error' => 'Sorry, something went wrong.'], 500);
        }

        $data  = $response->json();
        $reply = $data['candidates'][0]['content']['parts'][0]['text'] ?? 'Sorry, I could not generate a response.';

        return response()->json(['reply' => $reply]);
    }
}
