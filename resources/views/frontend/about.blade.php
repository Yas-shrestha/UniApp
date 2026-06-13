@extends('frontend.layouts.master')

@section('content')
    <main class="main">
        <section class="page-banner"
            style="
          background:
            linear-gradient(180deg, rgba(0, 0, 0, 0.45), rgba(0, 0, 0, 0.45)),
            url(&quot;assets/img/hero.png&quot;) center/cover no-repeat;
        ">
            <div class="container">
                <small>About us</small>
                <h1>Building Connections, Creating Impact</h1>
                <div class="banner-breadcrumb">
                    <a href="index.html">Home</a>
                    <span class="sep">/</span>
                    <span>About us</span>
                </div>
            </div>
        </section>

        <!-- Section 1: Introduction -->
        <section id="intro" class="section bg-white" style="padding: 80px 0 60px">
            <div class="container" data-aos="fade-up">
                <div class="row align-items-center gy-5">
                    <div class="col-lg-6">
                        <h2 class="fw-bold mb-3" style="font-size: 2.5rem; color: #2d465e; line-height: 1.2">
                            Building Connections,<br />Creating Impact
                        </h2>
                        <p class="text-muted" style="font-size: 1.05rem; line-height: 1.7; max-width: 500px">
                            AI-Solutions is a Sunderland-based startup providing AI-powered
                            software solutions to improve productivity, innovation, and
                            digital employee experiences.
                        </p>
                    </div>
                    <div class="col-lg-6">
                        <div class="about-image-grid">
                            <div class="about-image-grid-left">
                                <img src="assets/img/about-2.webp" alt="Work space" />
                                <img src="assets/img/solutions-3.png" alt="Collaborative discussion" />
                            </div>
                            <div class="about-image-grid-right">
                                <img src="assets/img/solutions-2.png" alt="Focus work" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section 2: Video -->
        <section id="video-promo" class="section" style="background-color: #fafbfc; padding: 60px 0">
            <div class="container" data-aos="fade-up">
                <div class="row align-items-center gy-4">
                    <div class="col-lg-6">
                        <p class="text-muted"
                            style="
                  font-size: 1.05rem;
                  line-height: 1.7;
                  margin: 0;
                  padding-right: 20px;
                ">
                            We specialize in developing intelligent solutions that assist
                            industries in solving workplace challenges proactively and
                            efficiently. By combining artificial intelligence with modern
                            software technologies, we help organizations streamline
                            operations, improve communication, and support smarter
                            decision-making.
                        </p>
                    </div>
                    <div class="col-lg-6">
                        <div class="about-video-box">
                            <img src="assets/img/services.jpg" alt="Video thumbnail" />
                            <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox about-video-play">
                                <i class="bi bi-play-fill"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section 3: What We Do -->
        <section id="what-we-do" class="section bg-white" style="padding: 80px 0">
            <div class="container" data-aos="fade-up">
                <div class="text-center mb-5">
                    <h2 class="fw-bold" style="font-size: 2.2rem; color: #2d465e">
                        What We Do
                    </h2>
                </div>

                <!-- 3 items on top row, 2 centered on bottom row -->
                <div class="row g-4 mb-4 justify-content-center" id="whatWeDoTop">
                    <!-- Rendered dynamically -->
                </div>
                <div class="row g-4 justify-content-center" id="whatWeDoBottom">
                    <!-- Rendered dynamically -->
                </div>
            </div>
        </section>

        <!-- Section 4: Our Mission & Vision -->
        <section id="mission-vision" class="about-mission-section section">
            <div class="container" data-aos="fade-up">
                <div class="row align-items-center gy-4">
                    <div class="col-lg-5">
                        <img src="assets/img/about-2.webp" class="about-mission-img" alt="Happy coworkers" />
                    </div>
                    <div class="col-lg-7 ps-lg-5">
                        <div class="mb-5">
                            <h3>Our Mission</h3>
                            <p>
                                To innovate and deliver AI-driven technologies that empower
                                businesses, improve workplace experiences, and drive future
                                digital transformation globally.
                            </p>
                        </div>
                        <div>
                            <h3>Our Vision</h3>
                            <p>
                                To become a globally recognized AI solutions provider that
                                helps organizations work smarter, faster, and more efficiently
                                through intelligent technology.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section 5: Quote Statement -->
        <section id="quote-statement" class="about-quote-section section">
            <div class="container" data-aos="fade-up">
                <p>
                    At AI-Solutions, we believe that the future of work is powered by
                    intelligent technology. We are committed to helping businesses
                    cost-save innovation and achieve long-term digital outcomes.
                </p>
            </div>
        </section>
    </main>

    <!-- Footer -->
@endsection
