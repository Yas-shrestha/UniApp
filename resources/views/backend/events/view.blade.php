@extends('backend.layouts.main')
@section('container')
    <main id="main" class="main">
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid p-4">

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="mb-0">{{ $event->title }}</h4>
                        <a href="{{ route('admin.events.index') }}" class="btn btn-primary">
                            <i class="bx bx-list-ul"></i>
                        </a>
                    </div>

                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.events.index') }}">Events</a></li>
                            <li class="breadcrumb-item active">{{ $event->title }}</li>
                        </ol>
                    </nav>

                    <div class="card">
                        <div class="card-body">
                            @if ($event->image)
                                <img src="{{ asset('storage/' . $event->image) }}" class="img-fluid mb-3"
                                    style="max-height:300px;" alt="{{ $event->title }}">
                            @endif

                            <p><strong>Category:</strong> {{ $event->category->name ?? '-' }}</p>
                            <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($event->date)->format('Y-m-d') }}</p>
                            <p><strong>Time:</strong> {{ $event->time }}</p>
                            <p><strong>Location:</strong> {{ $event->location }}</p>
                            <p><strong>Seats:</strong> {{ $event->seats }}</p>
                            <p><strong>Admission:</strong> {{ $event->admission ?? '-' }}</p>

                            <hr>
                            <h5>Intro</h5>
                            <p>{{ $event->intro }}</p>

                            @if ($event->points)
                                <h5>Points</h5>
                                <ul>
                                    @foreach ($event->points as $point)
                                        <li>{{ $point }}</li>
                                    @endforeach
                                </ul>
                            @endif

                            <h5>Audience</h5>
                            <p>{{ $event->audience }}</p>

                            <hr>
                            <h5>Speaker</h5>
                            <div class="d-flex align-items-center gap-3">
                                @if ($event->speaker_image)
                                    <img src="{{ asset('storage/' . $event->speaker_image) }}" height="80"
                                        width="80" class="rounded-circle" alt="{{ $event->speaker_name }}">
                                @endif
                                <div>
                                    <p class="mb-0"><strong>{{ $event->speaker_name }}</strong></p>
                                    <p class="mb-0 text-muted">{{ $event->speaker_role }}</p>
                                </div>
                            </div>

                            <hr>
                            <h5>Related Events</h5>
                            <div class="row">
                                @forelse ($relatedEvents as $related)
                                    <div class="col-md-4 mb-3">
                                        <div class="card h-100">
                                            @if ($related->image)
                                                <img src="{{ asset('storage/' . $related->image) }}" class="card-img-top"
                                                    alt="{{ $related->title }}">
                                            @endif
                                            <div class="card-body">
                                                <h6 class="card-title">{{ $related->title }}</h6>
                                                <a href="{{ route('admin.events.show', $related->slug) }}"
                                                    class="btn btn-sm btn-secondary">View</a>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <p>No related events.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>

                </div>
            </section>
        </div>
    </main>
@endsection
