@extends('frontend.layouts.master')

@section('content')
    <main class="main">
        <section class="page-banner"
            style="background: linear-gradient(rgba(0,0,0,0.65), rgba(0,0,0,0.65)), url('{{ asset('assets/img/services.jpg') }}') center/cover no-repeat;">
            <div class="container text-white text-center">
                <small>Services</small>
                <h1 class="fw-bold mb-2" style="font-size: 2.8rem">Our Services</h1>
                <p style="opacity: 0.85; font-size: 1.1rem">AI-powered and traditional solutions to boost productivity &amp;
                    innovation.</p>
                <div class="banner-breadcrumb">
                    <a href="{{ route('home') }}">Home</a>
                    <span class="sep">/</span>
                    <span>Services</span>
                </div>
            </div>
        </section>

        <section id="services-list" class="section" style="background: #f8f9fa; padding: 80px 0">
            <div class="container" data-aos="fade-up">
                <div class="d-flex flex-wrap gap-2 justify-content-center mb-5">
                    <a href="{{ route('services') }}" class="btn btn-filter {{ !$type ? 'active' : '' }}">
                        <i class="bi bi-grid-fill me-1"></i> All Services
                    </a>
                    <a href="{{ route('services', ['type' => 'traditional']) }}"
                        class="btn btn-filter {{ $type == 'traditional' ? 'active' : '' }}">
                        <i class="bi bi-mortarboard-fill me-1"></i> Past
                    </a>
                    <a href="{{ route('services', ['type' => 'future']) }}"
                        class="btn btn-filter {{ $type == 'future' ? 'active' : '' }}">
                        <i class="bi bi-lightning-charge-fill me-1"></i> AI &amp; Future Solutions
                    </a>
                </div>

                <div class="row gy-4 services-grid">
                    @forelse ($services as $service)
                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ ($loop->index + 1) * 100 }}">
                            <div class="service-card h-100 p-4"
                                style="background: #fff; border-radius: 12px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); transition: transform 0.3s ease;">
                                @if ($service->icon)
                                    <i class="{{ $service->icon }}" style="font-size: 2rem; color: #2d465e;"></i>
                                @elseif ($service->image)
                                    <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->title }}"
                                        class="img-fluid mb-3 rounded" style="max-height: 80px; object-fit: cover;" />
                                @endif
                                <h4 class="mt-3">{{ $service->title }}</h4>
                                <p class="text-muted">{{ Str::limit($service->short_description, 100) }}</p>
                                <a href="{{ route('services.detail', $service->slug) }}" class="btn btn-link p-0">Learn
                                    More →</a>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5">
                            <p class="text-muted">No services found.</p>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if ($services->hasPages())
                    <div class="mt-5 d-flex justify-content-center">
                        {{ $services->links() }}
                    </div>
                @endif
            </div>
        </section>
    </main>
@endsection
