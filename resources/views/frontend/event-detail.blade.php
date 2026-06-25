@extends('frontend.layouts.master')

@section('content')

    <main class="main">
        <section class="page-banner events-page-hero"
            style="background: linear-gradient(180deg, rgba(0,0,0,0.45), rgba(0,0,0,0.45)), url('{{ asset('assets/img/hero.png') }}') center/cover no-repeat; color: #fff;">
            <div class="container">
                <small>Events</small>
                <h1>{{ $event->title }}</h1>
                <div class="banner-breadcrumb">
                    <a href="{{ route('home') }}">Home</a>
                    <span class="sep">/</span>
                    <a href="{{ route('events.index') }}">Events</a>
                    <span class="sep">/</span>
                    <span>{{ $event->title }}</span>
                </div>
            </div>
        </section>

        <section class="section" style="background: #faf8f4; padding: 60px 0 80px">
            <div class="container">
                {{-- Bootstrap Toast Messages --}}
                @if (session('success'))
                    <div class="position-fixed top-0 end-0 p-3" style="z-index: 9999;">
                        <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-header bg-success text-white">
                                <i class="bi bi-check-circle-fill me-2"></i>
                                <strong class="me-auto">Success</strong>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"></button>
                            </div>
                            <div class="toast-body">
                                {{ session('success') }}
                            </div>
                        </div>
                    </div>
                @endif

                @if (session('error'))
                    <div class="position-fixed top-0 end-0 p-3" style="z-index: 9999;">
                        <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-header bg-danger text-white">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                <strong class="me-auto">Error</strong>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"></button>
                            </div>
                            <div class="toast-body">
                                {{ session('error') }}
                            </div>
                        </div>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="position-fixed top-0 end-0 p-3" style="z-index: 9999;">
                        <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-header bg-danger text-white">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                <strong class="me-auto">Validation Error</strong>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"></button>
                            </div>
                            <div class="toast-body">
                                @foreach ($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                <div class="row g-5">
                    {{-- LEFT: Speaker & RSVP Form --}}
                    <div class="col-lg-3 col-md-4" data-aos="fade-right">
                        @if ($event->speaker_image)
                            <img src="{{ asset('storage/' . $event->speaker_image) }}" alt="{{ $event->speaker_name }}"
                                class="ed-speaker-img" />
                        @endif
                        <div class="ed-speaker-card mt-4">
                            <p
                                style="font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; opacity: 0.75; margin-bottom: 6px;">
                                Event Speaker
                            </p>
                            <h4>{{ $event->speaker_name }}</h4>
                            <p>{{ $event->speaker_role }}</p>
                        </div>

                        {{-- RSVP Form --}}
                        <div class="ed-rsvp-form mt-4">
                            <h4>
                                <i class="bi bi-send me-2" style="color: #997122"></i>RSVP / Register
                            </h4>

                            @if ($event->isFullyBooked())
                                <div class="alert alert-warning">
                                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                    This event is fully booked!
                                </div>
                            @else
                                <form action="{{ route('events.register', $event) }}" method="POST">
                                    @csrf
                                    <div class="d-flex flex-column gap-2">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            placeholder="Full Name" name="name" value="{{ old('name') }}" required />
                                        @error('name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror

                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            placeholder="Email Address" name="email" value="{{ old('email') }}"
                                            required />
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror

                                        <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                                            placeholder="Phone Number (optional)" name="phone"
                                            value="{{ old('phone') }}" />
                                        @error('phone')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror

                                        <select class="form-control @error('participant_type') is-invalid @enderror"
                                            name="participant_type" required>
                                            <option value="" disabled selected>I am a…</option>
                                            <option value="undergraduate"
                                                {{ old('participant_type') == 'undergraduate' ? 'selected' : '' }}>
                                                Undergraduate Student</option>
                                            <option value="postgraduate"
                                                {{ old('participant_type') == 'postgraduate' ? 'selected' : '' }}>
                                                Postgraduate Student</option>
                                            <option value="faculty"
                                                {{ old('participant_type') == 'faculty' ? 'selected' : '' }}>Faculty
                                                Member</option>
                                            <option value="alumni"
                                                {{ old('participant_type') == 'alumni' ? 'selected' : '' }}>Alumni
                                            </option>
                                            <option value="external"
                                                {{ old('participant_type') == 'external' ? 'selected' : '' }}>External
                                                Guest</option>
                                        </select>
                                        @error('participant_type')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror

                                        <textarea class="form-control @error('message') is-invalid @enderror" placeholder="Any special requirements? (optional)"
                                            name="message" rows="2">{{ old('message') }}</textarea>
                                        @error('message')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror

                                        <button type="submit" class="btn-rsvp">
                                            Confirm My Spot <i class="bi bi-arrow-right ms-2"></i>
                                        </button>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>

                    {{-- MIDDLE: Event Body --}}
                    <div class="col-lg-5 col-md-8 ed-body" data-aos="fade-up" data-aos-delay="80">
                        <span class="ed-category-tag">{{ $event->category->name }}</span>
                        <h1 class="ed-title">{{ $event->title }}</h1>

                        <div class="ed-meta-row">
                            <div class="ed-meta-item">
                                <i class="bi bi-calendar3"></i>
                                <div><strong>{{ $event->date->format('d F Y') }}</strong></div>
                            </div>
                            <div class="ed-meta-item">
                                <i class="bi bi-clock"></i>
                                <div>{{ $event->time }}</div>
                            </div>
                            <div class="ed-meta-item">
                                <i class="bi bi-geo-alt"></i>
                                <div>{{ $event->location }}</div>
                            </div>
                        </div>

                        <p>{{ $event->intro }}</p>

                        @if ($event->points)
                            <h3>What You'll Learn</h3>
                            <ul id="evPoints">
                                @foreach ($event->points as $point)
                                    <li>
                                        <i class="bi bi-check-circle-fill"></i>
                                        {{ $point }}
                                    </li>
                                @endforeach
                            </ul>
                        @endif

                        @if ($event->audience)
                            <h3>Who Should Attend</h3>
                            <p>{{ $event->audience }}</p>
                        @endif

                        {{-- Related Events --}}
                        @if ($upcoming->count() || $past->count())
                            <h3>Related Events</h3>
                            <div class="d-flex flex-column gap-3">
                                @foreach ($upcoming as $related)
                                    <a href="{{ route('events.show', $related->slug) }}" class="ev-item-small">
                                        <div class="ev-date-badge-small">
                                            <span class="d">{{ $related->date->format('d') }}</span>
                                            <span class="m">{{ $related->date->format('M') }}</span>
                                        </div>
                                        <div>
                                            <strong>{{ $related->title }}</strong>
                                            <p class="mb-0 text-muted" style="font-size:0.85rem">
                                                {{ $related->location }}
                                            </p>
                                        </div>
                                    </a>
                                @endforeach
                                @foreach ($past as $related)
                                    <a href="{{ route('events.show', $related->slug) }}"
                                        class="ev-item-small opacity-75">
                                        <div class="ev-date-badge-small">
                                            <span class="d">{{ $related->date->format('d') }}</span>
                                            <span class="m">{{ $related->date->format('M') }}</span>
                                        </div>
                                        <div>
                                            <strong>{{ $related->title }}</strong>
                                            <span class="badge bg-secondary ms-1" style="font-size:0.7rem">Past</span>
                                            <p class="mb-0 text-muted" style="font-size:0.85rem">
                                                {{ $related->location }}
                                            </p>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    {{-- RIGHT: Sidebar with Event Details (Sticky) --}}
                    {{-- RIGHT: Sidebar with Event Details (Sticky) --}}
                    <div class="col-lg-4" data-aos="fade-left" data-aos-delay="120">
                        <div class="ed-sidebar-card">
                            <div class="card-header-strip">
                                <h3>Event Details</h3>
                            </div>
                            <div class="card-body-inner">
                                <div class="ed-info-line">
                                    <div class="icon"><i class="bi bi-calendar3"></i></div>
                                    <div>
                                        <div class="label">Date</div>
                                        <div class="value">{{ $event->date->format('d F Y') }}</div>
                                    </div>
                                </div>
                                <div class="ed-info-line">
                                    <div class="icon"><i class="bi bi-clock"></i></div>
                                    <div>
                                        <div class="label">Time</div>
                                        <div class="value">{{ $event->time }}</div>
                                    </div>
                                </div>
                                <div class="ed-info-line">
                                    <div class="icon"><i class="bi bi-geo-alt"></i></div>
                                    <div>
                                        <div class="label">Location</div>
                                        <div class="value">{{ $event->location }}</div>
                                    </div>
                                </div>
                                <div class="ed-info-line">
                                    <div class="icon"><i class="bi bi-people"></i></div>
                                    <div>
                                        <div class="label">Available Seats</div>
                                        <div class="value">
                                            @if ($event->hasAvailableSeats())
                                                <span class="text-success">{{ $event->available_seats }} /
                                                    {{ $event->seats }}</span>
                                            @else
                                                <span class="text-danger">Fully Booked</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="ed-info-line">
                                    <div class="icon"><i class="bi bi-tag"></i></div>
                                    <div>
                                        <div class="label">Category</div>
                                        <div class="value">{{ $event->category->name }}</div>
                                    </div>
                                </div>
                                @if ($event->admission)
                                    <div class="ed-info-line">
                                        <div class="icon"><i class="bi bi-ticket"></i></div>
                                        <div>
                                            <div class="label">Admission</div>
                                            <div class="value">{{ $event->admission }}</div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
@push('styles')
    <style>
        /* Event Details Card - Sticky */
        .ed-sidebar-card {
            position: sticky;
            top: 30px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.06);
            overflow: hidden;
        }

        .card-header-strip {
            background: #2d465e;
            padding: 15px 20px;
        }

        .card-header-strip h3 {
            color: #fff;
            font-size: 1.1rem;
            margin: 0;
            font-weight: 700;
        }

        .card-body-inner {
            padding: 20px;
        }

        .ed-info-line {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            padding: 10px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .ed-info-line:last-child {
            border-bottom: none;
        }

        .ed-info-line .icon {
            width: 32px;
            height: 32px;
            background: #f8f5f0;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #997122;
            font-size: 1rem;
            flex-shrink: 0;
        }

        .ed-info-line .label {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #999;
            font-weight: 600;
            margin-bottom: 2px;
        }

        .ed-info-line .value {
            font-weight: 600;
            color: #2d465e;
            font-size: 0.95rem;
        }

        .ed-info-line .value .text-success {
            color: #28a745 !important;
        }

        .ed-info-line .value .text-danger {
            color: #dc3545 !important;
        }

        /* Toast styling */
        .toast {
            min-width: 300px;
            border-radius: 8px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .toast-header {
            border-radius: 8px 8px 0 0;
            padding: 10px 15px;
        }

        .toast-body {
            padding: 15px;
            background: #fff;
            border-radius: 0 0 8px 8px;
            color: #333;
        }

        /* Alert styling */
        .alert-warning {
            background-color: #fff3cd;
            border-color: #ffc107;
            color: #856404;
            border-radius: 8px;
            padding: 12px 16px;
        }

        .text-danger {
            font-size: 0.8rem;
        }

        /* Responsive */
        @media (max-width: 991.98px) {
            .ed-sidebar-card {
                position: relative !important;
                top: 0 !important;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        // Auto-hide toasts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                var toasts = document.querySelectorAll('.toast');
                toasts.forEach(function(toast) {
                    var bsToast = bootstrap.Toast.getInstance(toast);
                    if (bsToast) {
                        bsToast.hide();
                    }
                });
            }, 5000);
        });
    </script>
@endpush
