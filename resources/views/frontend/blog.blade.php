@extends('frontend.layouts.master')

@section('content')
    <main class="main">

        <section class="page-banner"
            style="background: linear-gradient(180deg, rgba(0, 0, 0, 0.50), rgba(0, 0, 0, 0.50)), url('{{ asset('assets/img/hero.png') }}') center/cover no-repeat; padding: 110px 0;">
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

                    {{-- Blog List --}}
                    <div class="col-lg-8" id="blog-list">
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
                            <p class="text-muted py-4">No blog posts found.</p>
                        @endforelse

                        {{ $blogs->links() }}
                    </div>

                    {{-- Sidebar --}}
                    <div class="col-lg-4">
                        <div class="blog-filter-card" data-aos="fade-left">
                            <h4>Filter Posts</h4>

                            {{-- Live Search --}}
                            <div class="filter-group">
                                <label for="postSearch">Search</label>
                                <div class="position-relative">
                                    <input id="postSearch" type="text" class="form-control"
                                        placeholder="Search articles..." value="{{ $search }}" autocomplete="off" />
                                    <span id="search-spinner"
                                        class="position-absolute top-50 end-0 translate-middle-y me-2 d-none">
                                        <span class="spinner-border spinner-border-sm text-secondary"></span>
                                    </span>
                                </div>
                            </div>

                            {{-- Category Filter Form --}}
                            <form id="filter-form" action="{{ route('blogs') }}" method="GET">
                                <input type="hidden" name="search" id="search-hidden" value="{{ $search }}" />
                                <div class="filter-group">
                                    <label>Categories</label>
                                    <div class="tag-list">
                                        <button class="{{ !$category ? 'active' : '' }}" type="submit" name="category"
                                            value="">All</button>
                                        @foreach ($categories as $cat)
                                            <button class="{{ $category == $cat->slug ? 'active' : '' }}" type="submit"
                                                name="category" value="{{ $cat->slug }}">
                                                {{ $cat->name }}
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                            </form>

                            {{-- Featured --}}
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

    <script>
        (function() {
            const input = document.getElementById('postSearch');
            const hidden = document.getElementById('search-hidden');
            const form = document.getElementById('filter-form');
            const spinner = document.getElementById('search-spinner');
            const list = document.getElementById('blog-list');
            let timer;

            input.addEventListener('input', function() {
                clearTimeout(timer);
                hidden.value = this.value;
                spinner.classList.remove('d-none');

                timer = setTimeout(() => {
                    const params = new URLSearchParams(new FormData(form));

                    fetch(`{{ route('blogs') }}?${params}`, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(r => r.text())
                        .then(html => {
                            const doc = new DOMParser().parseFromString(html, 'text/html');
                            const fresh = doc.getElementById('blog-list');
                            if (fresh) list.innerHTML = fresh.innerHTML;
                            spinner.classList.add('d-none');
                            history.pushState({}, '', `{{ route('blogs') }}?${params}`);
                        })
                        .catch(() => spinner.classList.add('d-none'));
                }, 400);
            });
        })();
    </script>
@endsection
