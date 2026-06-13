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
                        @php
                            $isPast = $event->date->isPast();
                        @endphp
                        <a href="{{ route('events.show', $event->slug) }}"
                            class="ev-item {{ $isPast ? 'ev-item--past' : '' }}" data-aos="fade-up"
                            data-aos-delay="{{ $loop->index * 60 }}">

                            <div class="ev-thumb">
                                <img src="{{ asset($event->image) }}" alt="{{ $event->title }}" />
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

                <!-- Pagination -->
                <div class="ev-pagination">
                    {{ $events->links() }}
                </div>
            </div>
        </section>
    </main>

    <style>
        .ev-item--past {
            opacity: 0.75;
        }

        .ev-item--past .ev-thumb img {
            filter: grayscale(40%);
        }

        .ev-status-badge {
            display: inline-flex;
            align-items: center;
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            padding: 3px 10px;
            border-radius: 50px;
        }

        .ev-status-badge--past {
            background: rgba(100, 100, 100, 0.1);
            color: #666;
            border: 1px solid rgba(100, 100, 100, 0.2);
        }

        .ev-status-badge--upcoming {
            background: rgba(153, 113, 34, 0.1);
            color: #997122;
            border: 1px solid rgba(153, 113, 34, 0.25);
        }
    </style>

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
