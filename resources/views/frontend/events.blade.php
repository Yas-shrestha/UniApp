@extends('frontend.layouts.master')

@section('content')
    <main class="main">
        <section class="page-banner events-page-hero"
            style="background: linear-gradient(180deg, rgba(0,0,0,0.45), rgba(0,0,0,0.45)), url('{{ asset('assets/img/hero.png') }}') center/cover no-repeat; color: #fff;">
            <div class="container">
                <small>Events</small>
                <h1>Events &amp; Workshops</h1>
                <p class="subtitle">
                    Discover what's happening on campus — AI talks, research symposia,
                    career fairs &amp; more.
                </p>
                <div class="banner-breadcrumb">
                    <a href="{{ url('/') }}">Home</a>
                    <span class="sep">/</span>
                    <span>Events</span>
                </div>
            </div>
        </section>

        <!-- Events List -->
        <section class="section" style="background: #faf8f4; padding: 60px 0 80px">
            <div class="container">
                <!-- Filter Pills -->
                <div class="events-filters">
                    <a href="{{ route('events.index') }}"
                        class="ev-filter-btn {{ !request('category') ? 'active' : '' }}">All</a>
                    @foreach ($categories as $cat)
                        <a href="{{ route('events.index', ['category' => $cat->slug]) }}"
                            class="ev-filter-btn {{ request('category') === $cat->slug ? 'active' : '' }}">
                            {{ $cat->name }}
                        </a>
                    @endforeach
                </div>

                <!-- Events List -->
                <div class="d-flex flex-column gap-3">
                    @forelse ($events as $event)
                        <a href="{{ route('events.show', $event->slug) }}" class="ev-item" data-aos="fade-up"
                            data-aos-delay="{{ $loop->index * 60 }}">
                            <div class="ev-thumb">
                                <img src="{{ asset($event->image) }}" alt="{{ $event->title }}" />
                                <div class="ev-date-badge">
                                    <span class="d">{{ $event->date->format('d') }}</span>
                                    <span class="m">{{ $event->date->format('M') }}</span>
                                </div>
                            </div>
                            <div class="ev-body">
                                <span class="ev-category">{{ $event->category_label }}</span>
                                <h3 class="ev-title">{{ $event->title }}</h3>
                                <div class="ev-meta">
                                    <span><i class="bi bi-clock"></i>{{ $event->time }}</span>
                                    <span><i class="bi bi-geo-alt"></i>{{ $event->location }}</span>
                                    <span><i class="bi bi-people"></i>{{ $event->seats }}</span>
                                </div>
                            </div>
                            <div class="ev-arrow"><i class="bi bi-arrow-right"></i></div>
                        </a>
                    @empty
                        <p class="text-center text-muted py-5">No events found.</p>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="ev-pagination">
                    {{ $events->links() }}
                </div>
            </div>
        </section>
    </main>
@endsection
