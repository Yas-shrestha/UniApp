@extends('backend.layouts.main')
@section('container')
    <main id="main" class="main">
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid p-4">

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="mb-0">{{ $service->title }}</h4>
                        <a href="{{ route('services.index') }}" class="btn btn-primary">
                            <i class="bx bx-list-ul"></i>
                        </a>
                    </div>

                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('services.index') }}">Services</a></li>
                            <li class="breadcrumb-item active">{{ $service->title }}</li>
                        </ol>
                    </nav>

                    <div class="card">
                        <div class="card-body">
                            @if ($service->image)
                                <img src="{{ asset('storage/' . $service->image) }}" class="img-fluid mb-3"
                                    style="max-height:300px;" alt="{{ $service->title }}">
                            @endif

                            <p><strong>Type:</strong> <span class="text-capitalize">{{ $service->type }}</span></p>
                            <p><strong>Icon:</strong> {{ $service->icon ?? '-' }}</p>
                            <p><strong>Featured:</strong> {{ $service->is_featured ? 'Yes' : 'No' }}</p>

                            @if ($service->short_description)
                                <hr>
                                <h5>Short Description</h5>
                                <p>{{ $service->short_description }}</p>
                            @endif

                            <h5>Body</h5>
                            <div>{!! $service->body !!}</div>

                            @if ($service->points)
                                <h5>Points</h5>
                                <ul>
                                    @foreach ($service->points as $point)
                                        <li>{{ $point }}</li>
                                    @endforeach
                                </ul>
                            @endif

                            <div class="mt-3">
                                @if ($service->catalog_pdf)
                                    <a href="{{ asset('storage/' . $service->catalog_pdf) }}" target="_blank"
                                        class="btn btn-sm btn-outline-primary">
                                        <i class="bx bx-file-blank"></i> Catalog PDF
                                    </a>
                                @endif
                                @if ($service->catalog_doc)
                                    <a href="{{ asset('storage/' . $service->catalog_doc) }}" target="_blank"
                                        class="btn btn-sm btn-outline-primary">
                                        <i class="bx bx-file-blank"></i> Catalog DOC
                                    </a>
                                @endif
                            </div>

                            <hr>
                            <h5>Related Services</h5>
                            <div class="row">
                                @forelse ($relatedServices as $related)
                                    <div class="col-md-4 mb-3">
                                        <div class="card h-100">
                                            @if ($related->image)
                                                <img src="{{ asset('storage/' . $related->image) }}" class="card-img-top"
                                                    alt="{{ $related->title }}">
                                            @endif
                                            <div class="card-body">
                                                <h6 class="card-title">{{ $related->title }}</h6>
                                                <a href="{{ route('services.show', $related->slug) }}"
                                                    class="btn btn-sm btn-secondary">View</a>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <p>No related services.</p>
                                @endforelse
                            </div>

                            <hr>
                            <h5>All Services</h5>
                            <ul>
                                @foreach ($allServices as $s)
                                    <li><a href="{{ route('services.show', $s->slug) }}">{{ $s->title }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                </div>
            </section>
        </div>
    </main>
@endsection
