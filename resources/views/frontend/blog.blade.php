@extends('frontend.layouts.master')

@section('content')
    <main class="main">
        <section class="blog-hero">
            <div class="container py-5">
                <small style="text-transform: uppercase; letter-spacing: 1px; color: rgba(255, 255, 255, 0.8);">News &
                    Blog</small>
                <h1 class="mt-3">Latest Insights & Articles</h1>
                <div class="banner-breadcrumb">
                    <a href="{{ route('home') }}">Home</a>
                    <span class="sep">/</span>
                    <span>Blog</span>
                </div>
            </div>
        </section>
        <section class="section" style="background: #eef2f7; padding: 0 0 40px">
            <div class="container">
                <div class="row gy-5">
                    <div class="col-lg-8">
                        @forelse ($blogs as $blog)
                            <div class="blog-card mb-4" data-aos="fade-up">
                                @if ($blog->image)
                                    <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" />
                                @endif
                                <div class="blog-card-body">
                                    <div class="blog-card-meta mb-3">
                                        <span>{{ $blog->category->name }}</span>
                                        <span>{{ $blog->published_at->format('M d, Y') }}</span>
                                    </div>
                                    <h3>{{ $blog->title }}</h3>
                                    <p>{{ $blog->excerpt }}</p>
                                    <a href="{{ route('blogs.show', $blog->slug) }}" class="btn btn-link p-0">Read More
                                        →</a>
                                </div>
                            </div>
                        @empty
                            <p>No blog posts found.</p>
                        @endforelse

                        {{ $blogs->links() }}
                    </div>
                    <div class="col-lg-4">
                        <div class="blog-filter-card" data-aos="fade-left">
                            <h4>Filter Posts</h4>
                            <form action="{{ route('blogs.index') }}" method="GET">
                                <div class="filter-group">
                                    <label for="postSearch">Search</label>
                                    <input id="postSearch" name="search" type="text" class="form-control"
                                        placeholder="Search articles" value="{{ $search }}" />
                                </div>
                                <div class="filter-group">
                                    <label>Categories</label>
                                    <div class="tag-list">
                                        <button class="{{ !$category ? 'active' : '' }}" type="submit" name="category"
                                            value="">All</button>
                                        @foreach ($categories as $cat)
                                            <button class="{{ $category == $cat->slug ? 'active' : '' }}" type="submit"
                                                name="category" value="{{ $cat->slug }}">{{ $cat->name }}</button>
                                        @endforeach
                                    </div>
                                </div>
                            </form>

                            @if ($featured)
                                <div class="filter-group blog-sidebar-small">
                                    <h5>Featured Insight</h5>
                                    <p>{{ $featured->excerpt }}</p>
                                    <a href="{{ route('blogs.show', $featured->slug) }}">Read more →</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
