@extends('frontend.layouts.master')

@section('content')
<main class="main">
      <section
        class="page-banner"
        style="
          background:
            linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),
            url(&quot;assets/img/hero.png&quot;) center/cover no-repeat;
        "
      >
        <div class="container text-white text-center">
          <h1 class="fw-bold mb-2" style="font-size: 2.8rem">Contact Us</h1>
          <p style="opacity: 0.85; font-size: 1.05rem">
            We'd love to hear from you. Reach out for admissions, support, or
            general enquiries.
          </p>
          <div class="banner-breadcrumb justify-content-center">
            <a href="index.html">Home</a>
            <span class="sep">/</span>
            <span>Contact Us</span>
          </div>
        </div>
      </section>

      <!-- Contact Section -->
      <section
        id="contact"
        class="section"
        style="background: #f8f9fa; padding: 80px 0"
      >
        <div class="container" data-aos="fade-up">
          <div class="row g-4 g-lg-5">
            <!-- Left: Contact Info Box -->
            <div class="col-lg-5" data-aos="fade-right" data-aos-delay="100">
              <div class="contact-info-box">
                <h2>Campus Contact</h2>
                <p class="subtitle">
                  Whether you are a prospective applicant, current student, or
                  alumnus, our administrative offices are here to help answer
                  your questions.
                </p>

                <div class="contact-info-item">
                  <div class="icon-wrap">
                    <i class="bi bi-geo-alt-fill"></i>
                  </div>
                  <div class="text">
                    <h4>Our Location</h4>
                    <p>
                      108 University Parkway<br />Grandview Campus, GV 10245
                    </p>
                  </div>
                </div>

                <div class="contact-info-item">
                  <div class="icon-wrap">
                    <i class="bi bi-telephone-fill"></i>
                  </div>
                  <div class="text">
                    <h4>Phone Numbers</h4>
                    <p>
                      +1 (555) 019-9300 — General<br />+1 (555) 019-9311 —
                      Admissions
                    </p>
                  </div>
                </div>

                <div class="contact-info-item">
                  <div class="icon-wrap">
                    <i class="bi bi-envelope-fill"></i>
                  </div>
                  <div class="text">
                    <h4>Email Addresses</h4>
                    <p>admissions@grandview.edu<br />info@grandview.edu</p>
                  </div>
                </div>

                <div class="contact-info-item">
                  <div class="icon-wrap"><i class="bi bi-clock-fill"></i></div>
                  <div class="text">
                    <h4>Office Hours</h4>
                    <p>
                      Mon – Fri: 8:00 AM – 6:00 PM<br />Sat: 9:00 AM – 1:00 PM
                    </p>
                  </div>
                </div>

                <div class="contact-social-links">
                  <a href="#" aria-label="Twitter"
                    ><i class="bi bi-twitter-x"></i
                  ></a>
                  <a href="#" aria-label="Facebook"
                    ><i class="bi bi-facebook"></i
                  ></a>
                  <a href="#" aria-label="Instagram"
                    ><i class="bi bi-instagram"></i
                  ></a>
                  <a href="#" aria-label="LinkedIn"
                    ><i class="bi bi-linkedin"></i
                  ></a>
                </div>
              </div>
            </div>

            <!-- Right: Contact Form -->
            <div class="col-lg-7" data-aos="fade-left" data-aos-delay="200">
              <div class="contact-form-box">
                <h2>Get In Touch</h2>
                <p class="subtitle">
                  Fill out the form below and a member of our team will get back
                  to you within one business day.
                </p>

                <form
                  id="contactForm"
                  action="forms/contact.php"
                  method="post"
                  class="php-email-form"
                >
                  <div class="row gy-3">
                    <div class="col-md-6">
                      <label
                        for="contactName"
                        class="form-label fw-semibold"
                        style="font-size: 0.85rem; color: #555"
                        >Full Name <span class="text-danger">*</span></label
                      >
                      <input
                        type="text"
                        id="contactName"
                        name="name"
                        class="form-control"
                        placeholder="John Doe"
                        required
                      />
                    </div>
                    <div class="col-md-6">
                      <label
                        for="contactEmail"
                        class="form-label fw-semibold"
                        style="font-size: 0.85rem; color: #555"
                        >Email Address <span class="text-danger">*</span></label
                      >
                      <input
                        type="email"
                        id="contactEmail"
                        name="email"
                        class="form-control"
                        placeholder="john@example.com"
                        required
                      />
                    </div>
                    <div class="col-md-6">
                      <label
                        for="contactPhone"
                        class="form-label fw-semibold"
                        style="font-size: 0.85rem; color: #555"
                        >Phone Number</label
                      >
                      <input
                        type="tel"
                        id="contactPhone"
                        name="phone"
                        class="form-control"
                        placeholder="+1 (555) 000-0000"
                      />
                    </div>
                    <div class="col-md-6">
                      <label
                        for="contactSubject"
                        class="form-label fw-semibold"
                        style="font-size: 0.85rem; color: #555"
                        >Subject <span class="text-danger">*</span></label
                      >
                      <select
                        id="contactSubject"
                        name="subject"
                        class="form-control"
                        required
                      >
                        <option value="" disabled selected>
                          Select a subject…
                        </option>
                        <option>Admissions Enquiry</option>
                        <option>Financial Aid</option>
                        <option>Academic Programs</option>
                        <option>Campus Services</option>
                        <option>General Information</option>
                        <option>Other</option>
                      </select>
                    </div>
                    <div class="col-12">
                      <label
                        for="contactMessage"
                        class="form-label fw-semibold"
                        style="font-size: 0.85rem; color: #555"
                        >Message <span class="text-danger">*</span></label
                      >
                      <textarea
                        id="contactMessage"
                        name="message"
                        class="form-control"
                        rows="6"
                        placeholder="Write your message here…"
                        required
                      ></textarea>
                    </div>

                    <!-- Form status messages -->
                    <div class="col-12">
                      <div class="loading">Loading…</div>
                      <div class="error-message"></div>
                      <div class="sent-message">
                        Your message has been sent. Thank you!
                      </div>
                    </div>

                    <div
                      class="col-12 d-flex align-items-center gap-4 flex-wrap"
                    >
                      <button type="submit" class="btn-send">
                        Send Message <i class="bi bi-send ms-2"></i>
                      </button>
                      <p class="mb-0" style="font-size: 0.82rem; color: #aaa">
                        We typically reply within 24 hours.
                      </p>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Embedded Map -->
      <div style="height: 380px; overflow: hidden">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.215256657707!2d-73.9870527!3d40.7484445!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNDDCsDQ0JzU0LjQiTiA3M8KwNTknMTMuNCJX!5e0!3m2!1sen!2sus!4v1609459200000"
          width="100%"
          height="380"
          style="border: 0; display: block; filter: grayscale(25%)"
          allowfullscreen=""
          loading="lazy"
          title="Grandview University Map"
        >
        </iframe>
      </div>
    </main>

    <!-- Footer -->
@endsection
