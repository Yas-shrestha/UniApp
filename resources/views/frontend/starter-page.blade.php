@extends('frontend.layouts.master')

@section('content')
<main class="main">
      <section
        class="page-banner light-background"
        style="background: #faf8f4; padding: 90px 0 40px"
      >
        <div class="container">
          <small>Starter Page</small>
          <h1>Starter Page</h1>
          <div class="banner-breadcrumb">
            <a href="index.html">Home</a>
            <span class="sep">/</span>
            <span>Starter Page</span>
          </div>
        </div>
      </section>

      <!-- Starter Section Section -->
      <section id="starter-section" class="starter-section section">
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
          <h2>Starter Section</h2>
          <p>
            Necessitatibus eius consequatur ex aliquid fuga eum quidem sint
            consectetur velit
          </p>
        </div>
        <!-- End Section Title -->

        <div class="container" data-aos="fade-up">
          <p>Use this page as a starter for your own custom pages.</p>
        </div>
      </section>
      <!-- /Starter Section Section -->
    </main>
@endsection
