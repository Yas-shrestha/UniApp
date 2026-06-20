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

        <section id="intro" class="section bg-white" style="padding: 80px 0 60px">
            <div class="container" data-aos="fade-up">
                <div class="row align-items-center gy-5">
                    <div class="col-lg-6">
                        <h2 class="fw-bold mb-3" style="font-size: 2.5rem; color: #2d465e; line-height: 1.2"> Our Story
                            Begins with a Simple Belief </h2>
                        <p class="text-muted" style="font-size: 1.05rem; line-height: 1.7; max-width: 500px"> At
                            AI-Solutions, we believe the future belongs to businesses that can adapt, automate, and innovate
                            with confidence. Our journey began with a vision to make advanced artificial intelligence more
                            practical, accessible, and impactful for organizations navigating a rapidly changing digital
                            world. </p>
                    </div>
                    <div class="col-lg-6">
                        <div class="about-image-grid">
                            <div class="about-image-grid-left"> <img src="assets/img/about-2.webp" alt="Work space" /> <img
                                    src="assets/img/solutions-3.png" alt="Collaborative discussion" /> </div>
                            <div class="about-image-grid-right"> <img src="assets/img/solutions-2.png" alt="Focus work" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> <!-- Section 2: Story -->
        <section id="video-promo" class="section" style="background-color: #fafbfc; padding: 60px 0">
            <div class="container" data-aos="fade-up">
                <div class="row align-items-center gy-4">
                    <div class="col-lg-6">
                        <div class="about-video-box"> <img src="assets/img/services.jpg"
                                alt="AI innovation and digital transformation" /> <a
                                href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox about-video-play"> <i
                                    class="bi bi-play-fill"></i> </a> </div>
                    </div>
                    <div class="col-lg-6">
                        <p class="text-muted"
                            style=" font-size: 1.05rem; line-height: 1.7; margin: 0; padding-right: 20px; "> We founded
                            AI-Solutions to bridge the gap between emerging AI technologies and real business challenges. As
                            industries evolve, organizations need more than software—they need intelligent systems that
                            enhance productivity, simplify operations, and help teams make smarter decisions. That is where
                            we come in. <br><br> From automation and digital transformation to AI-powered workplace
                            solutions, our focus is on building future-ready services that create measurable value. We work
                            with businesses to reimagine how they operate, collaborate, and grow in an increasingly
                            connected world. </p>
                    </div>

                </div>
            </div>
        </section> <!-- Section 3: What Drives Us -->
        <!-- Section 4: Mission & Vision -->
        <section id="mission-vision" class="about-mission-section section">
            <div class="container" data-aos="fade-up">
                <div class="row align-items-center gy-4">
                    <div class="col-lg-5"> <img src="assets/img/about-2.webp" class="about-mission-img"
                            alt="Team collaboration" /> </div>
                    <div class="col-lg-7 ps-lg-5">
                        <div class="mb-5">
                            <h3>Our Mission</h3>
                            <p> To empower organizations with intelligent, future-focused AI services that improve
                                productivity, strengthen workplace experiences, and accelerate meaningful digital
                                transformation. </p>
                        </div>
                        <div>
                            <h3>Our Vision</h3>
                            <p> To become a trusted global AI partner for businesses seeking to innovate boldly, operate
                                smarter, and create lasting impact through technology. </p>
                        </div>
                    </div>
                </div>
            </div>
        </section> <!-- Section 5: Closing Statement -->
        <section id="quote-statement" class="about-quote-section section">
            <div class="container" data-aos="fade-up">
                <p> Our story is still being written—through every challenge solved, every process improved, and every
                    business empowered by intelligent technology. At AI-Solutions, we are not only building services for
                    today; we are helping shape the future of how people work, connect, and grow. </p>
            </div>
        </section>
    </main>

    <!-- Footer -->
@endsection
