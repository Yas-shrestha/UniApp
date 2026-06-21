@extends('backend.layouts.main')
@section('container')
    <main id="main" class="main">
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid p-4">

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="mb-0">{{ $blog->title }}</h4>
                        <a href="{{ route('admin.blogs.index') }}" class="btn btn-primary">
                            <i class="bx bx-list-ul"></i>
                        </a>
                    </div>

                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.blogs.index') }}">Blogs</a></li>
                            <li class="breadcrumb-item active">{{ $blog->title }}</li>
                        </ol>
                    </nav>

                    <div class="card">
                        <div class="card-body">
                            @if ($blog->image)
                                <img src="{{ asset('storage/' . $blog->image) }}" class="img-fluid mb-3"
                                    style="max-height:300px;" alt="{{ $blog->title }}">
                            @endif

                            <p><strong>Category:</strong> {{ $blog->category->name ?? '-' }}</p>
                            <p><strong>Author:</strong> {{ $blog->author }}</p>
                            <p><strong>Published At:</strong>
                                {{ \Carbon\Carbon::parse($blog->published_at)->format('Y-m-d') }}</p>
                            <p><strong>Featured:</strong> {{ $blog->is_featured ? 'Yes' : 'No' }}</p>

                            <hr>
                            <h5>Excerpt</h5>
                            <p>{{ $blog->excerpt }}</p>

                            <h5>Body</h5>
                            <div>{!! $blog->body !!}</div>

                            @if ($blog->quick_links)
                                <hr>
                                <h5>Quick Links</h5>
                                <ul>
                                    @foreach ($blog->quick_links as $link)
                                        <li><a href="{{ $link['url'] }}" target="_blank">{{ $link['label'] }}</a></li>
                                    @endforeach
                                </ul>
                            @endif

                            <hr>
                            <h5>Related Blogs</h5>
                            <div class="row">
                                @forelse ($relatedBlogs as $related)
                                    <div class="col-md-4 mb-3">
                                        <div class="card h-100">
                                            @if ($related->image)
                                                <img src="{{ asset('storage/' . $related->image) }}" class="card-img-top"
                                                    alt="{{ $related->title }}">
                                            @endif
                                            <div class="card-body">
                                                <h6 class="card-title">{{ $related->title }}</h6>
                                                <a href="{{ route('admin.blogs.show', $related->slug) }}"
                                                    class="btn btn-sm btn-secondary">View</a>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <p>No related blogs.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>

                </div>
            </section>
        </div>
    </main>
@endsection
