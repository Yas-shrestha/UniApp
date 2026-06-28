<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Event;
use App\Models\Blog;
use App\Models\Service;
use Illuminate\Support\Facades\Log;

class ChatbotController extends Controller
{
    public function index()
    {
        return view('chatbot');
    }

    private function buildSystemPrompt(): string
    {
        $events   = Event::select('title', 'slug', 'date', 'location', 'admission')->latest()->get();
        $services = Service::select('title', 'slug', 'short_description')->latest()->get();
        $blogs    = Blog::select('title', 'slug', 'author', 'published_at', 'excerpt')->latest()->take(10)->get();

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

        return "You are a helpful assistant for Grandview College.
You answer questions about our events, services, blogs, and general queries.

CRITICAL FORMATTING RULES — FOLLOW EXACTLY:

1. For EVENTS, output each one like this (opening AND closing tag required):
[EVENT] title={title} | date={date} | location={location} | slug={slug} [/EVENT]

2. For SERVICES, output each one like this:
[SERVICE] title={title} | slug={slug} | description={description} [/SERVICE]

3. For BLOGS, output each one like this:
[BLOG] title={title} | slug={slug} | author={author} [/BLOG]

RULES:
- Every opening tag [EVENT], [SERVICE], [BLOG] MUST have a matching closing tag [/EVENT], [/SERVICE], [/BLOG].
- NEVER omit the closing tag. NEVER output [EVENT]...[EVENT] without [/EVENT] in between.
- Each item must be on its own line.
- Do NOT use markdown (**bold**, bullet points, dashes) inside the tags.
- You may write plain text before or after the structured blocks.
- Only use structured format when user asks about events, services, or blogs.

EXAMPLE of correct output:
Here are the upcoming events:
[EVENT] title={Tech Workshop} | date={Jul 01, 2026} | location={Main Hall} | slug={tech-workshop} [/EVENT]
[EVENT] title={AI Summit} | date={Jul 15, 2026} | location={Online} | slug={ai-summit} [/EVENT]
Let me know if you need more details!

CURRENT DATA:

Events:
{$eventsText}

Services:
{$servicesText}

Blogs:
{$blogsText}

Keep answers friendly and helpful.";
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
                'parts' => [['text' => 'Understood! I will strictly follow the formatting rules and always include closing tags like [/EVENT], [/SERVICE], [/BLOG] for every item.']],
            ],
        ];

        foreach ($request->messages as $msg) {
            $geminiMessages[] = [
                'role'  => $msg['role'] === 'assistant' ? 'model' : 'user',
                'parts' => [['text' => $msg['content']]],
            ];
        }

        $apiKey = config('services.gemini.key');

        $response = Http::withoutVerifying()->post(
            "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key={$apiKey}",
            ['contents' => $geminiMessages]
        );

        if ($response->failed()) {
            Log::error('Gemini API error', [
                'status' => $response->status(),
                'body'   => $response->json(),
            ]);
            return response()->json(['error' => 'Sorry, something went wrong.'], 500);
        }

        $data  = $response->json();
$reply = $data['candidates'][0]['content']['parts'][0]['text'] ?? 'Sorry, I could not generate a response.';

// Remove any duplicate closing tags the AI might add
$reply = preg_replace('/(\[\/EVENT\])\s*\[\/EVENT\]/', '$1', $reply);
$reply = preg_replace('/(\[\/SERVICE\])\s*\[\/SERVICE\]/', '$1', $reply);
$reply = preg_replace('/(\[\/BLOG\])\s*\[\/BLOG\]/', '$1', $reply);

return response()->json(['reply' => $reply]);
    }
}