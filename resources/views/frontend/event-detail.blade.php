@extends('frontend.layouts.master')

@section('content')
    <main class="main">
        <section class="page-banner light-background" style="background: #faf8f4; padding: 90px 0 40px">
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
                <div class="row g-5">

                    {{-- LEFT: Speaker --}}
                    <div class="col-lg-3 col-md-4" data-aos="fade-right">
                        @if ($event->speaker_image)
                            <img src="{{ asset('storage/' . $event->speaker_image) }}" alt="{{ $event->speaker_name }}"
                                class="ed-speaker-img" />
                        @endif
                        <div class="ed-speaker-card mt-4">
                            <p
                                style="font-size: 0.72rem; font-weight: 700; text-transform: uppercase;
                                letter-spacing: 0.5px; opacity: 0.75; margin-bottom: 6px;">
                                Event Speaker
                            </p>
                            <h4>{{ $event->speaker_name }}</h4>
                            <p>{{ $event->speaker_role }}</p>
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
                                    <a href="{{ route('events.show', $related->slug) }}" class="ev-item-small opacity-75">
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

                    {{-- RIGHT: Sidebar --}}
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
                                        <div class="label">Capacity</div>
                                        <div class="value">{{ $event->seats }}</div>
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

                        {{-- RSVP Form --}}
                        <div class="ed-rsvp-form">
                            <h4>
                                <i class="bi bi-send me-2" style="color: #997122"></i>RSVP / Register
                            </h4>
                            <div class="d-flex flex-column gap-2">
                                <input type="text" class="form-control" placeholder="Full Name" id="rsvpName" />
                                <input type="email" class="form-control" placeholder="Email Address" id="rsvpEmail" />
                                <select class="form-control" id="rsvpType">
                                    <option value="" disabled selected>I am a…</option>
                                    <option>Undergraduate Student</option>
                                    <option>Postgraduate Student</option>
                                    <option>Faculty Member</option>
                                    <option>Alumni</option>
                                    <option>External Guest</option>
                                </select>
                                <button class="btn-rsvp" onclick="submitRSVP()">
                                    Confirm My Spot <i class="bi bi-arrow-right ms-2"></i>
                                </button>
                                <p id="rsvpMsg" style="font-size: 0.82rem; color: #1a7a4a; margin: 0; display: none;">
                                    <i class="bi bi-check-circle-fill me-1"></i> You're registered! Check your email for
                                    confirmation.
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main>

    <script>
        function submitRSVP() {
            const name = document.getElementById('rsvpName').value.trim();
            const email = document.getElementById('rsvpEmail').value.trim();
            const type = document.getElementById('rsvpType').value;
            const msg = document.getElementById('rsvpMsg');

            if (!name || !email || !type) {
                alert('Please fill in all fields.');
                return;
            }
            msg.style.display = 'block';
        }
    </script>
@endsection
