@extends('frontend.layouts.master')

@section('content')
    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero">
            <div class="container text-start" data-aos="fade-up" data-aos-delay="100">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="hero-content">
                            <h1 class="mb-4">
                                AI Solutions for the<br />
                                Future of Work
                            </h1>
                            <div class="hero-buttons">
                                <a href="{{ route('services') }}" class="btn btn-primary">Schedule Demo</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Our Story Section -->
        <section id="story" class="story section" style="padding: 80px 0; background-color: #fafafa">
            <div class="container" data-aos="fade-up">
                <div class="text-center mb-5">
                    <h2 class="fw-bold" style="font-size: 2.2rem; color: #2d465e">
                        Our Story
                    </h2>
                    <p class="text-muted">
                        Grandview began with a vision to make AI accessible to businesses
                        that want smarter workflows and better employee experiences.
                    </p>
                </div>
            </div>
        </section>

        <!-- AI Solutions Section -->
        <section id="services" class="solutions section">
            <div class="container" data-aos="fade-up">
                <div class="row align-items-center mb-5">
                    <div class="col-md-8 col-12">
                        <h2 class="fw-bold mb-2" style="font-size: 2.2rem; color: #2d465e">
                            Our AI-Powered Solutions
                        </h2>
                    </div>
                    <div class="col-md-4 col-12 text-md-end mt-3 mt-md-0">
                        <ul class="nav nav-pills solutions-tabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active solutions-tab-btn" id="past-tab" data-bs-toggle="tab"
                                    data-bs-target="#past-solutions" type="button" role="tab"
                                    aria-controls="past-solutions" aria-selected="true">
                                    Past
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link solutions-tab-btn" id="future-tab" data-bs-toggle="tab"
                                    data-bs-target="#future-solutions" type="button" role="tab"
                                    aria-controls="future-solutions" aria-selected="false">
                                    Future
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Tab Content -->
                <div class="tab-content">
                    <!-- Past Solutions -->
                    <div class="tab-pane fade show active" id="past-solutions" role="tabpanel" aria-labelledby="past-tab">
                        <div class="row g-4">
                            @forelse($solutionsPast as $index => $solution)
                                <div class="col-lg-6 col-md-6 col-12" data-aos="fade-up"
                                    data-aos-delay="{{ ($index + 1) * 100 }}">
                                    <div class="solutions-card">
                                        <img src="{{ asset('storage/' . $solution->image) }}"
                                            alt="{{ $solution->title }}" />
                                        <div class="solutions-card-overlay">
                                            <h3>{{ $solution->title }}</h3>
                                            <button class="btn-seemore">SEE MORE</button>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12 text-center">
                                    <p class="text-muted">No past solutions available.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Future Solutions -->
                    <div class="tab-pane fade" id="future-solutions" role="tabpanel" aria-labelledby="future-tab">
                        <div class="row g-4">
                            @forelse($solutionsFuture as $index => $solution)
                                <div class="col-lg-6 col-md-6 col-12" data-aos="fade-up"
                                    data-aos-delay="{{ ($index + 1) * 100 }}">
                                    <div class="solutions-card">
                                        <img src="{{ asset('storage/' . $solution->image) }}"
                                            alt="{{ $solution->title }}" />
                                        <div class="solutions-card-overlay">
                                            <h3>{{ $solution->title }}</h3>
                                            <button class="btn-seemore">SEE MORE</button>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12 text-center">
                                    <p class="text-muted">No future solutions available.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Testimonials Section -->
        <section id="testimonials" class="testimonials section">
    <div class="container section-title" data-aos="fade-up">
        <h2 class="fw-bold" style="font-size: 2.2rem">
            What Our Clients Say
        </h2>
        <p>
            Community development is defined as a community next to community
            planning and may involve stakeholders, foundations.
        </p>
    </div>

    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="testimonials-platform">
            <div class="testimonials-slider-wrapper">
                <div class="testimonials-track" id="testimonialsTrack">
                    @foreach ($testimonials as $slideGroup)
                        <div class="testimonials-slide">
                            <div class="row g-4">
                                @foreach ($slideGroup as $t)
                                    <div class="col-lg-4 col-md-6 col-12">
                                        <div class="testimonial-item">
                                            <div class="stars">
                                                @for ($i = 0; $i < $t->rating; $i++)
                                                    <i class="bi bi-star-fill"></i>
                                                @endfor
                                            </div>

                                            <p>{{ $t->testimonial }}</p>

                                            <div class="d-flex align-items-center mt-3">
                                                <img
                                                    src="{{ $t->image_url }}"
                                                    class="testimonial-img me-3"
                                                    alt="{{ $t->name }}"
                                                    style="width:50px;height:50px;border-radius:50%;object-fit:cover;"
                                                />

                                                <div>
                                                    <h4 class="m-0 fw-bold" style="font-size:1rem;color:#2d465e;">
                                                        {{ $t->name }}
                                                    </h4>

                                                    <span class="text-muted" style="font-size:0.8rem;">
                                                        {{ $t->role }}
                                                        @if($t->company)
                                                            · {{ $t->company }}
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="testimonials-controls">
                <button class="testimonials-btn" id="testimonialsPrev" aria-label="Previous slide">
                    <i class="bi bi-chevron-left"></i>
                </button>

                <div class="testimonials-dots" id="testimonialsDots"></div>

                <button class="testimonials-btn testimonials-btn--active" id="testimonialsNext" aria-label="Next slide">
                    <i class="bi bi-chevron-right"></i>
                </button>
            </div>
        </div>
    </div>
</section>

        <!-- About Us Section -->
        <section id="about" class="section" style="padding: 80px 0; background-color: #fafafa">
            <div class="container" data-aos="fade-up">
                <div class="text-center mb-5">
                    <h2 class="fw-bold" style="font-size: 2.2rem; color: #2d465e">
                        About us
                    </h2>
                    <p class="text-muted">
                        Grandview is a trusted partner for AI-led transformation across
                        services, events, and operations.
                    </p>
                </div>
                <div class="row g-4 justify-content-center">
                    <div class="col-lg-4">
                        <div class="p-4"
                            style="background: #fff; border-radius: 20px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);">
                            <h3 class="h5 mb-3">Mission</h3>
                            <p class="text-muted">
                                Deliver AI tools that simplify work and amplify impact for
                                modern teams.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="p-4"
                            style="background: #fff; border-radius: 20px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);">
                            <h3 class="h5 mb-3">Vision</h3>
                            <p class="text-muted">
                                Create better employee experiences through intelligent
                                automation and design.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Explore Types Section -->
        <section id="types" class="types section">
            <div class="container" data-aos="fade-up">
                <div class="text-center mb-5">
                    <h2 class="fw-bold mb-2" style="font-size: 2.2rem; color: #2d465e">
                        Explore all the Types
                    </h2>
                    <p class="text-muted">Acquire standard clean yet high tech feel</p>
                </div>

                <div class="row g-4 mb-4 justify-content-center" id="typesRowTop">
                    <!-- Rendered dynamically by JavaScript -->
                </div>
                <div class="row g-4 justify-content-center" id="typesRowBottom">
                    <!-- Rendered dynamically by JavaScript -->
                </div>
            </div>
        </section>

        <!-- Events Section -->
        <section id="events" class="section" style="padding: 80px 0">
            <div class="container" data-aos="fade-up">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-3 mb-5">
                    <div class="text-center text-md-start w-100">
                        <h2 class="fw-bold" style="font-size: 2.2rem; color: #2d465e">
                            Events
                        </h2>
                        <p class="text-muted mb-0">
                            Stay connected with our upcoming workshops, webinars, and AI talks.
                        </p>
                    </div>

                    @if (Route::has('events.index'))
                        <div class="text-center text-md-end">
                            <a href="{{ route('events.index') }}" class="course-link text-decoration-none">
                                View All Events <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    @endif
                </div>

                <div class="row g-4">
                    @forelse ($upcomingEvents as $event)
                        @php
                            $eventDate = $event->start_date ?? ($event->event_date ?? ($event->date ?? null));
                            $eventImage = $event->featured_image ?? ($event->image ?? ($event->thumbnail ?? null));
                            $eventExcerpt =
                                $event->excerpt ??
                                \Illuminate\Support\Str::limit(
                                    strip_tags($event->description ?? ($event->content ?? '')),
                                    120,
                                );
                        @endphp

                        <div class="col-lg-4 col-md-6">
                            <div class="event-card h-100">
                                <div class="event-img-wrapper">
                                    <a href="{{ route('events.show', $event->slug) }}">
                                        <img src="{{ $eventImage ? asset('storage/' . $eventImage) : asset('assets/img/hero.png') }}"
                                            alt="{{ $event->title }}" class="event-img">
                                    </a>

                                    @if ($eventDate)
                                        <div class="event-date">
                                            <span
                                                class="day">{{ \Carbon\Carbon::parse($eventDate)->format('d') }}</span>
                                            <span
                                                class="month">{{ \Carbon\Carbon::parse($eventDate)->format('M') }}</span>
                                        </div>
                                    @endif
                                </div>

                                <div class="event-content d-flex flex-column h-100">
                                    <h3>
                                        <a href="{{ route('events.show', $event->slug) }}"
                                            class="text-decoration-none text-dark">
                                            {{ $event->title }}
                                        </a>
                                    </h3>

                                    <div class="time">
                                        @if ($eventDate)
                                            <span class="me-3">
                                                <i class="bi bi-calendar3"></i>
                                                {{ \Carbon\Carbon::parse($eventDate)->format('M d, Y') }}
                                            </span>
                                        @endif

                                        @if (!empty($event->time))
                                            <span class="me-3">
                                                <i class="bi bi-clock"></i>
                                                {{ $event->time }}
                                            </span>
                                        @elseif(!empty($event->start_time))
                                            <span class="me-3">
                                                <i class="bi bi-clock"></i>
                                                {{ \Carbon\Carbon::parse($event->start_time)->format('h:i A') }}
                                            </span>
                                        @endif

                                        @if (!empty($event->location))
                                            <span>
                                                <i class="bi bi-geo-alt"></i>
                                                {{ $event->location }}
                                            </span>
                                        @endif
                                    </div>

                                    <p class="desc mb-4">
                                        {{ $eventExcerpt }}
                                    </p>

                                    <div class="mt-auto">
                                        <a href="{{ route('events.show', $event->slug) }}"
                                            class="course-link text-decoration-none">
                                            View Event <i class="bi bi-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="text-center py-5 bg-light rounded-4">
                                <h5 class="mb-2">No upcoming events yet</h5>
                                <p class="text-muted mb-0">New events will appear here once they are published.</p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        <!-- Blog Section -->
        <section id="blog" class="section" style="padding: 80px 0; background-color: #fafafa">
            <div class="container" data-aos="fade-up">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-3 mb-5">
                    <div class="text-center text-md-start w-100">
                        <h2 class="fw-bold" style="font-size: 2.2rem; color: #2d465e">
                            Blog
                        </h2>
                        <p class="text-muted mb-0">
                            Explore insights on AI, workplace innovation, and digital transformation.
                        </p>
                    </div>

                    @if (Route::has('blogs'))
                        <div class="text-center text-md-end">
                            <a href="{{ route('blogs') }}" class="course-link text-decoration-none">
                                View All Articles <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    @endif
                </div>

                <div class="row g-4">
                    @forelse ($latestBlogs as $blog)
                        @php
                            $blogImage = $blog->featured_image ?? ($blog->image ?? ($blog->thumbnail ?? null));
                            $blogDate = $blog->published_at ?? ($blog->created_at ?? null);
                            $blogExcerpt =
                                $blog->excerpt ??
                                \Illuminate\Support\Str::limit(strip_tags($blog->content ?? ($blog->body ?? '')), 120);
                        @endphp

                        <div class="col-lg-4 col-md-6">
                            <div class="course-card">
                                <div class="course-img-wrapper">
                                    <a href="{{ route('blogs.show', $blog->slug) }}">
                                        <img src="{{ $blogImage ? asset('storage/' . $blogImage) : asset('assets/img/hero.png') }}"
                                            alt="{{ $blog->title }}" class="course-img">
                                    </a>

                                    @if (!empty($blog->category?->name))
                                        <span class="course-badge">{{ $blog->category->name }}</span>
                                    @endif
                                </div>

                                <div class="course-content">
                                    <h3>
                                        <a href="{{ route('blogs.show', $blog->slug) }}"
                                            class="text-decoration-none text-dark">
                                            {{ $blog->title }}
                                        </a>
                                    </h3>

                                    <div class="degree">
                                        @if ($blogDate)
                                            {{ \Carbon\Carbon::parse($blogDate)->format('M d, Y') }}
                                        @else
                                            Latest Article
                                        @endif
                                    </div>

                                    <p class="desc">
                                        {{ $blogExcerpt }}
                                    </p>

                                    <div class="course-meta d-flex justify-content-between align-items-center mt-auto">
                                        <div class="duration">
                                            @if ($blogDate)
                                                <i class="bi bi-calendar3"></i>
                                                {{ \Carbon\Carbon::parse($blogDate)->format('M d, Y') }}
                                            @endif
                                        </div>

                                        <a href="{{ route('blogs.show', $blog->slug) }}"
                                            class="course-link text-decoration-none">
                                            Read More <i class="bi bi-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="text-center py-5 bg-white rounded-4">
                                <h5 class="mb-2">No blog posts yet</h5>
                                <p class="text-muted mb-0">Published blog articles will appear here.</p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section id="contact" class="section" style="padding: 80px 0">
            <div class="container" data-aos="fade-up">
                <div class="text-center mb-4">
                    <h2 class="fw-bold" style="font-size: 2.2rem; color: #2d465e">
                        Contact Us
                    </h2>
                    <p class="text-muted">
                        Have questions? Reach out and we’ll connect you with the right AI solution.
                    </p>
                </div>
                <div class="text-center">
                    <a href="{{ route('contact') }}" class="btn btn-primary">Go to Contact Page</a>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('scripts')
    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

    <script>
        // Solutions Tab Switching Logic - Updated
        function renderSolutions(tabKey) {
            const pastContainer = document.getElementById("solutionsPast");
            const futureContainer = document.getElementById("solutionsFuture");

            if (!pastContainer || !futureContainer) return;

            // Update visibility
            if (tabKey === 'past') {
                pastContainer.classList.remove('d-none');
                futureContainer.classList.add('d-none');
            } else {
                pastContainer.classList.add('d-none');
                futureContainer.classList.remove('d-none');
            }

            // Refresh AOS for new visible elements
            if (typeof AOS !== 'undefined') {
                setTimeout(() => {
                    AOS.refresh();
                }, 100);
            }
        }

        function switchTab(tabKey) {
            // Update button active states
            document.querySelectorAll(".solutions-tab-btn").forEach((btn) => {
                btn.classList.toggle(
                    "active",
                    btn.textContent.toLowerCase().trim() === tabKey.toLowerCase().trim()
                );
            });

            renderSolutions(tabKey);
        }

        // Remove the static solutionsData array since you're using Laravel data
        // And update the DOMContentLoaded event
        document.addEventListener("DOMContentLoaded", () => {
            // Start with Past visible
            renderSolutions("past");
            renderTypes();
            renderTestimonials();
            initSlider();
        });
        // Render Types Logic
        function renderTypes() {
            const topRow = document.getElementById("typesRowTop");
            const bottomRow = document.getElementById("typesRowBottom");
            if (!topRow || !bottomRow) return;

            topRow.innerHTML = "";
            bottomRow.innerHTML = "";

            typesData.forEach((item, idx) => {
                const cardHtml = `
                    <div class="col-lg-4 col-md-6 col-12" data-aos="fade-up" data-aos-delay="${(idx + 1) * 100}">
                        <div class="types-card">
                            <img src="${item.image}" alt="${item.title}" />
                            <div class="types-card-overlay">
                                <h3>${item.title}</h3>
                            </div>
                        </div>
                    </div>
                `;

                if (idx < 3) {
                    topRow.innerHTML += cardHtml;
                } else {
                    bottomRow.innerHTML += cardHtml;
                }
            });
        }
        // Initialize Testimonial Slider Controls
        function initSlider() {
            const track = document.getElementById("testimonialsTrack");
            const dotsWrap = document.getElementById("testimonialsDots");
            const prevBtn = document.getElementById("testimonialsPrev");
            const nextBtn = document.getElementById("testimonialsNext");

            if (!track || !dotsWrap || !prevBtn || !nextBtn) return;

            const slides = track.querySelectorAll(".testimonials-slide");
            const total = slides.length;
            let current = 0;

            if (!total) return;

            dotsWrap.innerHTML = "";

            slides.forEach((_, i) => {
                const dot = document.createElement("button");
                dot.className = "testimonials-dot" + (i === 0 ? " active" : "");
                dot.setAttribute("aria-label", "Go to slide " + (i + 1));
                dot.addEventListener("click", () => goTo(i));
                dotsWrap.appendChild(dot);
            });

            function goTo(idx) {
                current = (idx + total) % total;
                track.style.transform = `translateX(-${current * 100}%)`;

                dotsWrap.querySelectorAll(".testimonials-dot")
                    .forEach((d, i) => d.classList.toggle("active", i === current));

                prevBtn.classList.toggle("testimonials-btn--active", current > 0);
                nextBtn.classList.toggle("testimonials-btn--active", current < total - 1);
            }

            prevBtn.addEventListener("click", () => goTo(current - 1));
            nextBtn.addEventListener("click", () => goTo(current + 1));

            goTo(0);
        }

        document.addEventListener("DOMContentLoaded", () => {
            renderSolutions("past");
            renderTypes();
            renderTestimonials();
            initSlider();
        });
    </script>

    <!-- Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
@endpush
