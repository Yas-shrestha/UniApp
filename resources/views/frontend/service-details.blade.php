@extends('frontend.layouts.master')

@section('content')
    <main class="main">
        <section class="page-banner light-background" style="background: #faf8f4; padding: 90px 0 40px">
            <div class="container">
                <small>Services</small>
                <h1>{{ $service->title }}</h1>
                <div class="banner-breadcrumb">
                    <a href="{{ route('home') }}">Home</a>
                    <span class="sep">/</span>
                    <a href="{{ route('services') }}">Services</a>
                    <span class="sep">/</span>
                    <span>{{ $service->title }}</span>
                </div>
            </div>
            <div class="text-center mb-4">

                <h2>Client Reviews</h2>

                <p class="text-muted mb-0">
                    {{ $service->average_rating }}/5
                    ({{ $service->reviews_count }} reviews)
                </p>

            </div>
        </section>

        <section id="service-details" class="service-details section">
            <div class="container">
                <div class="row gy-5">
                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="service-box">
                            <h4>Services List</h4>
                            <div class="services-list">
                                @foreach ($allServices as $item)
                                    <a href="{{ route('services.detail', $item->slug) }}"
                                        class="{{ $item->id == $service->id ? 'active' : '' }}">
                                        <i class="bi bi-arrow-right-circle"></i>
                                        <span>{{ $item->title }}</span>
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        @if ($service->catalog_pdf || $service->catalog_doc)
                            <div class="service-box">
                                <h4>Download Catalog</h4>
                                <div class="download-catalog">
                                    @if ($service->catalog_pdf)
                                        <a href="{{ asset('storage/' . $service->catalog_pdf) }}" target="_blank">
                                            <i class="bi bi-filetype-pdf"></i>
                                            <span>Catalog PDF</span>
                                        </a>
                                    @endif
                                    @if ($service->catalog_doc)
                                        <a href="{{ asset('storage/' . $service->catalog_doc) }}" target="_blank">
                                            <i class="bi bi-file-earmark-word"></i>
                                            <span>Catalog DOC</span>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endif

                        <div class="help-box d-flex flex-column justify-content-center align-items-center">
                            <i class="bi bi-headset help-icon"></i>
                            <h4>Have a Question?</h4>
                            <p class="d-flex align-items-center mt-2 mb-0">
                                <i class="bi bi-telephone me-2"></i>
                                <span>+1 5589 55488 55</span>
                            </p>
                            <p class="d-flex align-items-center mt-1 mb-0">
                                <i class="bi bi-envelope me-2"></i>
                                <a href="mailto:contact@example.com">contact@example.com</a>
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-8 ps-lg-5" data-aos="fade-up" data-aos-delay="200">
                        @if ($service->image)
                            <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}"
                                class="img-fluid services-img" />
                        @endif

                        {!! $service->body !!}

                        @if ($service->points)
                            <ul>
                                @foreach ($service->points as $point)
                                    <li>
                                        <i class="bi bi-check-circle"></i>
                                        <span>{{ $point }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif

                        @if ($relatedServices->count())
                            <div class="related-services mt-5">
                                <h3>Related Services</h3>
                                <div class="row gy-4">
                                    @foreach ($relatedServices as $related)
                                        <div class="col-md-6">
                                            <div class="service-card-item">
                                                @if ($related->icon)
                                                    <div class="service-card-icon-wrapper">
                                                        <i class="{{ $related->icon }}"></i>
                                                    </div>
                                                @elseif ($related->image)
                                                    <img src="{{ asset('storage/' . $related->image) }}"
                                                        alt="{{ $related->title }}" class="img-fluid rounded mb-3" />
                                                @endif
                                                <span class="service-badge {{ $related->type }}">
                                                    {{ $related->type === 'future' ? 'AI & Future' : 'Traditional' }}
                                                </span>
                                                <h5 class="service-card-title">{{ $related->title }}</h5>
                                                @if ($related->short_description)
                                                    <p class="service-card-desc">
                                                        {{ Str::limit($related->short_description, 80) }}
                                                    </p>
                                                @endif
                                                <a href="{{ route('services.detail', $related->slug) }}"
                                                    class="btn btn-link p-0 mt-2">Learn More →</a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <section id="service-reviews" class="section bg-light py-5">
            <div class="container" data-aos="fade-up">
                <h2 class="mb-4 text-center">What Our Clients Say</h2>
                <div class="service-review-form mt-5">
                    <h3 class="mb-4">
                        <i class="bi bi-chat-square-text me-2 text-warning"></i>
                        Leave a Review
                    </h3>

                    <form action="{{ route('services.reviews.store', $service) }}" method="POST">
                        @csrf

                        <div class="row g-3">

                            {{-- Name --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    Full Name <span class="text-danger">*</span>
                                </label>

                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                    placeholder="John Doe" required>

                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Email --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">
                                    Email <small class="text-muted">(optional)</small>
                                </label>

                                <input type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                                    placeholder="john@example.com">

                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Rating --}}
                            <div class="col-12">
                                <label class="form-label fw-semibold d-block">
                                    Rating <span class="text-danger">*</span>
                                </label>

                                <input type="hidden" name="rating" id="rating" value="{{ old('rating') }}">

                                <div id="rating-stars">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="bi bi-star-fill star-rating" data-rating="{{ $i }}"></i>
                                    @endfor
                                </div>

                                @error('rating')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Review --}}
                            <div class="col-12">

                                <label class="form-label fw-semibold">
                                    Your Review <span class="text-danger">*</span>
                                </label>

                                <textarea name="review" rows="5" class="form-control @error('review') is-invalid @enderror"
                                    placeholder="Share your experience with this service..." required>{{ old('review') }}</textarea>

                                @error('review')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            <div class="col-12">

                                <button class="btn btn-warning px-4">

                                    <i class="bi bi-send me-2"></i>

                                    Submit Review

                                </button>

                                <small class="text-muted ms-3">
                                    Reviews are published after admin approval.
                                </small>

                            </div>

                        </div>
                    </form>
                </div>
            </div>

            <div class="container my-5">
                @if ($service->approvedReviews->count())
                    @foreach ($service->approvedReviews as $review)
                        <div class="card shadow-sm border-0 mb-3">
                            <div class="card-body">

                                <div class="d-flex align-items-center mb-3">

                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($review->name) }}&background=997122&color=fff"
                                        class="rounded-circle me-3" width="55" height="55"
                                        alt="{{ $review->name }}">

                                    <div>

                                        <h6 class="mb-1">{{ $review->name }}</h6>

                                        <small class="text-muted">
                                            {{ $review->created_at->format('d M Y') }}
                                        </small>

                                    </div>

                                </div>

                                <div class="mb-2">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $review->rating)
                                            <i class="bi bi-star-fill text-warning"></i>
                                        @else
                                            <i class="bi bi-star text-warning"></i>
                                        @endif
                                    @endfor
                                </div>

                                <p class="mb-0">
                                    {{ $review->review }}
                                </p>

                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="alert alert-light border text-center">
                        No reviews yet. Be the first to review this service.
                    </div>
                @endif
            </div>
        </section>
    </main>
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {

                const stars = document.querySelectorAll('.star-rating');
                const ratingInput = document.getElementById('rating');

                function updateStars(rating) {

                    stars.forEach(function(star) {

                        if (Number(star.dataset.rating) <= Number(rating)) {
                            star.classList.add('active');
                        } else {
                            star.classList.remove('active');
                        }

                    });

                }

                stars.forEach(function(star) {

                    star.addEventListener('mouseenter', function() {

                        updateStars(this.dataset.rating);

                    });

                    star.addEventListener('click', function() {

                        ratingInput.value = this.dataset.rating;

                        updateStars(this.dataset.rating);

                    });

                });

                document.getElementById('rating-stars')
                    .addEventListener('mouseleave', function() {

                        updateStars(ratingInput.value);

                    });

                if (ratingInput.value) {
                    updateStars(ratingInput.value);
                }

            });
        </script>
    @endpush
@endsection
