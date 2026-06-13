<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a listing of blogs with optional search & category filter.
     */
    public function index(Request $request)
    {
        $categories = Category::all();
        $category   = $request->query('category');
        $search     = $request->query('search');

        $blogs = Blog::with('category')
            ->published()
            ->when($category, fn($q) => $q->byCategory($category))
            ->when($search, fn($q) => $q->search($search))
            ->paginate(6)
            ->withQueryString();

        $featured = Blog::with('category')->published()->featured()->first();

        return view('backend.blogs.index', compact('blogs', 'categories', 'category', 'search', 'featured'));
    }

    /**
     * Show the form for creating a new blog post.
     */
    public function create()
    {
        $categories = Category::all();

        return view('backend.blogs.create', compact('categories'));
    }

    /**
     * Store a newly created blog post.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id'  => 'required|exists:categories,id',
            'title'        => 'required|string|max:255',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'author'       => 'required|string|max:255',
            'published_at' => 'required|date',
            'excerpt'      => 'required|string|max:500',
            'body'         => 'required|string',
            'quick_links'  => 'nullable|array',
            'quick_links.*.label' => 'required_with:quick_links|string',
            'quick_links.*.url'   => 'required_with:quick_links|string',
            'is_featured'  => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('blogs', 'public');
        }

        $validated['is_featured'] = $request->boolean('is_featured');

        Blog::create($validated);

        return redirect()->route('blogs.index')->with('success', 'Blog post created successfully.');
    }

    /**
     * Display the specified blog post.
     */
    public function show(string $slug)
    {
        $blog = Blog::with('category')->where('slug', $slug)->firstOrFail();

        $relatedBlogs = $blog->getRelatedBlogs();

        return view('backend.blogs.show', compact('blog', 'relatedBlogs'));
    }

    /**
     * Show the form for editing the specified blog post.
     */
    public function edit(Blog $blog)
    {
        $categories = Category::all();

        return view('backend.blogs.edit', compact('blog', 'categories'));
    }

    /**
     * Update the specified blog post.
     */
    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'category_id'  => 'required|exists:categories,id',
            'title'        => 'required|string|max:255',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'author'       => 'required|string|max:255',
            'published_at' => 'required|date',
            'excerpt'      => 'required|string|max:500',
            'body'         => 'required|string',
            'quick_links'  => 'nullable|array',
            'quick_links.*.label' => 'required_with:quick_links|string',
            'quick_links.*.url'   => 'required_with:quick_links|string',
            'is_featured'  => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('blogs', 'public');
        }

        $validated['is_featured'] = $request->boolean('is_featured');

        $blog->update($validated);

        return redirect()->route('blogs.index')->with('success', 'Blog post updated successfully.');
    }

    /**
     * Remove the specified blog post.
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();

        return redirect()->route('blogs.index')->with('success', 'Blog post deleted successfully.');
    }
}
