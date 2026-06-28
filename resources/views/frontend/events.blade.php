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

        <section class="section" style="background: #faf8f4; padding: 60px 0 80px">
            <div class="container">
                <div class="events-summary-header" data-aos="fade-up">
                    <div class="events-summary-left">
                        <h2>Past Events and Workshop</h2>
                        <div class="events-summary-line"></div>
                    </div>

                    <div class="events-summary-right">
                        <span>Upcoming Event and Workshop</span>
                    </div>
                </div>

                <p class="events-summary-note">
                    Browse our workshop archive and discover the next major experience coming soon.
                </p>

                <div class="events-filters">
                    <a href="{{ route('events.index') }}"
                        class="ev-filter-btn {{ !request('filter') ? 'active' : '' }}">
                        All
                    </a>
                    <a href="{{ route('events.index', ['filter' => 'upcoming']) }}"
                        class="ev-filter-btn {{ request('filter') === 'upcoming' ? 'active' : '' }}">
                        Upcoming
                    </a>
                    <a href="{{ route('events.index', ['filter' => 'past']) }}"
                        class="ev-filter-btn {{ request('filter') === 'past' ? 'active' : '' }}">
                        Past
                    </a>
                </div>

                <!-- Events List -->
                <div class="d-flex flex-column gap-3">
                    @forelse ($events as $event)
                        @php
                            $isPast = $event->date->isPast();
                        @endphp
                        <a href="{{ route('events.show', $event->slug) }}"
                            class="ev-item {{ $isPast ? 'ev-item--past' : '' }}" data-aos="fade-up"
                            data-aos-delay="{{ $loop->index * 60 }}">

                            <div class="ev-thumb">
                                <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" />
                                <div class="ev-date-badge">
                                    <span class="d">{{ $event->date->format('d') }}</span>
                                    <span class="m">{{ $event->date->format('M') }}</span>
                                </div>
                            </div>

                            <div class="ev-body">
                                <div class="d-flex align-items-center gap-2 flex-wrap mb-1">
                                    <span class="ev-category">{{ $event->category->name }}</span>
                                    @if ($isPast)
                                        <span class="ev-status-badge ev-status-badge--past">
                                            <i class="bi bi-clock-history me-1"></i>Past
                                        </span>
                                    @else
                                        <span class="ev-status-badge ev-status-badge--upcoming"
                                            data-eventdate="{{ $event->date->toIso8601String() }}">
                                            <i class="bi bi-hourglass-split me-1"></i>
                                            <span class="ev-countdown">Upcoming</span>
                                        </span>
                                    @endif
                                </div>

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


     <div class="ev-gallery my-5">
    <div class="d-flex align-items-center gap-2 mb-4">
        <i class="bi bi-images fs-4 text-warning"></i>
        <h2 class="fw-bold mb-0">Event Gallery</h2>
    </div>

    @if ($galleryImages->count())
        <div class="row g-3">
            @foreach ($galleryImages as $i => $gallery)
                <div class="col-6 col-sm-4 col-lg-3">
                    <a href="{{ asset('storage/' . $gallery->image) }}"
                        data-lightbox="event-gallery"
                        class="gallery-item d-block rounded-3 overflow-hidden position-relative">
                        <img src="{{ asset('storage/' . $gallery->image) }}"
                            alt="Gallery Image {{ $i + 1 }}"
                            class="w-100 gallery-thumb">
                        <div class="gallery-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center">
                            <i class="bi bi-zoom-in fs-3 text-white"></i>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-gallery text-center py-5 rounded-4 border border-dashed">
            <div class="empty-icon mb-3">
                <i class="bi bi-image fs-1 text-muted opacity-50"></i>
            </div>
            <h5 class="fw-semibold mb-1">No Gallery Images Yet</h5>
            <p class="text-muted small mb-0">Event gallery images will appear here once added.</p>
        </div>
    @endif
</div>

                <!-- Pagination -->
           
            </div>
        </section>
    </main>


    <script>
        (function() {
            function formatCountdown(targetDate) {
                const now = new Date();
                const diff = targetDate - now;

                if (diff <= 0) return 'Starting now';

                const days = Math.floor(diff / (1000 * 60 * 60 * 24));
                const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));

                if (days > 0) return `In ${days}d ${hours}h`;
                if (hours > 0) return `In ${hours}h ${minutes}m`;
                return `In ${minutes}m`;
            }

            function updateCountdowns() {
                document.querySelectorAll('.ev-status-badge--upcoming').forEach(badge => {
                    const target = new Date(badge.dataset.eventdate);
                    const countdown = badge.querySelector('.ev-countdown');
                    if (countdown) countdown.textContent = formatCountdown(target);
                });
            }

            updateCountdowns();
            setInterval(updateCountdowns, 60000); // update every minute
        })();
    </script>
@endsection
