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
                                <a href="services.html" class="btn btn-primary">Schedule Demo</a>
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
                        <div class="solutions-tabs">
                            <button class="solutions-tab-btn active" onclick="switchTab('past')">
                                Past
                            </button>
                            <button class="solutions-tab-btn" onclick="switchTab('future')">
                                Future
                            </button>
                        </div>
                    </div>
                </div>

                <div class="row g-4" id="solutionsContainer">
                    <!-- Rendered dynamically by JavaScript -->
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
                            <!-- Rendered dynamically by JavaScript -->
                        </div>
                    </div>

                    <div class="testimonials-controls">
                        <button class="testimonials-btn" id="testimonialsPrev" aria-label="Previous slide">
                            <i class="bi bi-chevron-left"></i>
                        </button>
                        <div class="testimonials-dots" id="testimonialsDots"></div>
                        <button class="testimonials-btn testimonials-btn--active" id="testimonialsNext"
                            aria-label="Next slide">
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
                            style="
                  background: #fff;
                  border-radius: 20px;
                  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
                ">
                            <h3 class="h5 mb-3">Mission</h3>
                            <p class="text-muted">
                                Deliver AI tools that simplify work and amplify impact for
                                modern teams.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="p-4"
                            style="
                  background: #fff;
                  border-radius: 20px;
                  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
                ">
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

                <!-- 3 on top row, 2 centered on bottom row -->
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
                <div class="text-center mb-5">
                    <h2 class="fw-bold" style="font-size: 2.2rem; color: #2d465e">
                        Events
                    </h2>
                    <p class="text-muted">
                        Stay connected with our upcoming workshops, webinars, and AI
                        talks.
                    </p>
                </div>
            </div>
        </section>

        <!-- Blog Section -->
        <section id="blog" class="section" style="padding: 80px 0; background-color: #fafafa">
            <div class="container" data-aos="fade-up">
                <div class="text-center mb-5">
                    <h2 class="fw-bold" style="font-size: 2.2rem; color: #2d465e">
                        Blog
                    </h2>
                    <p class="text-muted">
                        Explore insights on AI, workplace innovation, and digital
                        transformation.
                    </p>
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
                        Have questions? Reach out and we’ll connect you with the right AI
                        solution.
                    </p>
                </div>
                <div class="text-center">
                    <a href="contact.html" class="btn btn-primary">Go to Contact Page</a>
                </div>
            </div>
        </section>
    </main>
@endsection
