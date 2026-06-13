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
    </main>
@endsection
