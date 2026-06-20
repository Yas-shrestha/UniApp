@extends('frontend.layouts.master')

@section('content')
    <main class="main">
        <section class="page-banner"
            style="background: linear-gradient(180deg, rgba(0, 0, 0, 0.50), rgba(0, 0, 0, 0.50)), url('{{ asset('assets/img/hero.png') }}') center/cover no-repeat; padding: 110px 0;">
            <div class="container py-5">
                <small style="text-transform: uppercase; letter-spacing: 1px; color: rgba(255, 255, 255, 0.8);">Blog</small>
                <h1 class="mt-3">{{ $blog->title }}</h1>
                <div class="ed-breadcrumb banner-breadcrumb">
                    <a href="{{ route('home') }}">Home</a>
                    <span class="sep">/</span>
                    <a href="{{ route('blogs.index') }}">Blog</a>
                    <span class="sep">/</span>
                    <span>{{ $blog->title }}</span>
                </div>
            </div>
        </section>
        <section class="section" style="background: #f8f9fb; padding: 0 0 40px">
            <div class="container">
                <div class="row gy-5">
                    <div class="col-lg-8">
                        <div class="bd-article">
                            <div class="bd-meta">
                                <span><i class="bi bi-person"></i> {{ $blog->author }}</span>
                                <span><i class="bi bi-calendar3"></i> {{ $blog->published_at->format('M d, Y') }}</span>
                                <span><i class="bi bi-tags"></i> {{ $blog->category->name }}</span>
                            </div>

                            @if ($blog->image)
                                <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" />
                            @endif

                            {!! $blog->body !!}
                        </div>

                        @if ($relatedBlogs->count())
                            <div class="related-blogs mt-5">
                                <h3>Related Posts</h3>
                                <div class="row gy-4">
                                    @foreach ($relatedBlogs as $related)
                                        <div class="col-md-4">
                                            <div class="blog-card">
                                                @if ($related->image)
                                                    <img src="{{ asset('storage/' . $related->image) }}"
                                                        alt="{{ $related->title }}" />
                                                @endif
                                                <div class="blog-card-body">
                                                    <h5>{{ $related->title }}</h5>
                                                    <a href="{{ route('blogs.show', $related->slug) }}"
                                                        class="btn btn-link p-0">Read More →</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-4">
                        @if ($blog->quick_links)
                            <div class="bd-sidebar-card" data-aos="fade-left">
                                <h4>Quick Links</h4>
                                <ul>
                                    @foreach ($blog->quick_links as $link)
                                        <li><a href="{{ $link['url'] }}">{{ $link['label'] }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
