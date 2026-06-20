@extends('frontend.layouts.master')

@section('content')
    <main class="main">
        <!-- Hero Section -->
        <section class="page-banner"
            style="
            background:
                linear-gradient(135deg, rgba(26, 35, 48, 0.92) 0%, rgba(45, 70, 94, 0.85) 100%),
                url('{{ asset('assets/img/hero.png') }}') center/cover no-repeat;
            padding: 120px 0 80px;
            position: relative;
            overflow: hidden;
            ">
            <div class="container text-white text-center position-relative" style="z-index: 2;">
                <div class="mb-3">
                    <span class="badge bg-warning text-dark px-4 py-2 rounded-pill fw-semibold"
                        style="font-size: 0.8rem; letter-spacing: 1px;">
                        <i class="bi bi-chat-dots me-2"></i> GET IN TOUCH
                    </span>
                </div>
                <h1 class="fw-bold mb-3" style="font-size: 3.5rem; letter-spacing: -1px;">Contact Us</h1>
                <p style="font-size: 1.15rem; opacity: 0.9; max-width: 600px; margin: 0 auto; line-height: 1.7;">
                    We'd love to hear from you. Reach out for admissions, support, or general enquiries.
                </p>
                <div class="banner-breadcrumb justify-content-center mt-3">
                    <a href="{{ route('home') }}"
                        class="text-white text-decoration-none opacity-75 hover-opacity-100">Home</a>
                    <span class="sep mx-2 opacity-50">/</span>
                    <span class="opacity-100">Contact Us</span>
                </div>
            </div>
            <!-- Decorative Elements -->
            <div class="position-absolute top-0 end-0 w-50 h-100 opacity-10"
                style="background: radial-gradient(circle at 70% 50%, #fff 0%, transparent 70%);"></div>
            <div class="position-absolute bottom-0 start-0 w-25 h-25 opacity-5"
                style="background: radial-gradient(circle at 30% 100%, #fff 0%, transparent 70%);"></div>
        </section>

        <!-- Contact Section -->
        <section class="section" style="padding: 80px 0; background: #f5f7fa;">
            <div class="container" data-aos="fade-up">
                <!-- Success/Error Messages -->
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show shadow-lg border-0 rounded-4" role="alert"
                        style="background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);">
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <div class="bg-success bg-opacity-25 p-2 rounded-circle">
                                    <i class="bi bi-check-lg text-success" style="font-size: 1.5rem;"></i>
                                </div>
                            </div>
                            <div>
                                <strong class="d-block text-success">Message Sent Successfully!</strong>
                                <span class="text-success-emphasis">{{ session('success') }}</span>
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if (session('error') || $errors->any())
                    <div class="alert alert-danger alert-dismissible fade show shadow-lg border-0 rounded-4" role="alert"
                        style="background: linear-gradient(135deg, #f8d7da 0%, #f1c0c0 100%);">
                        <div class="d-flex align-items-start">
                            <div class="me-3">
                                <div class="bg-danger bg-opacity-25 p-2 rounded-circle">
                                    <i class="bi bi-exclamation-lg text-danger" style="font-size: 1.5rem;"></i>
                                </div>
                            </div>
                            <div>
                                <strong class="d-block text-danger">Oops! Something went wrong.</strong>
                                @if ($errors->any())
                                    <ul class="mb-0 mt-1 ps-3 text-danger-emphasis">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <span class="text-danger-emphasis">{{ session('error') }}</span>
                                @endif
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="row g-5 align-items-start">
                    <!-- Left Column -->
                    <div class="col-lg-5" data-aos="fade-right" data-aos-delay="100">
                        <div class="card border-0 shadow-lg rounded-4 overflow-hidden h-100" style="background: #ffffff;">
                            <div class="card-body p-4 p-xl-5">
                                <div class="text-center mb-4">
                                    <div class="bg-primary bg-opacity-10 d-inline-block p-3 rounded-3 mb-3">
                                        <i class="bi bi-building text-primary" style="font-size: 2rem;"></i>
                                    </div>
                                    <h3 class="fw-bold mb-2" style="color: #1a2330;">Campus Contact</h3>
                                    <p class="text-muted small" style="line-height: 1.7;">
                                        Whether you're a prospective applicant, current student, or alumnus, we're here to
                                        help.
                                    </p>
                                </div>

                                <div class="contact-item d-flex align-items-start p-3 rounded-3 mb-2 transition"
                                    style="border-left: 3px solid #2d465e; background: #f8f9fa;">
                                    <div class="me-3 mt-1">
                                        <div class="bg-primary bg-opacity-10 p-2 rounded-circle">
                                            <i class="bi bi-geo-alt text-primary"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-1" style="color: #1a2330;">Location</h6>
                                        <p class="text-muted small mb-0">108 University Parkway, Grandview Campus, GV 10245
                                        </p>
                                    </div>
                                </div>

                                <div class="contact-item d-flex align-items-start p-3 rounded-3 mb-2 transition"
                                    style="border-left: 3px solid #28a745; background: #f8f9fa;">
                                    <div class="me-3 mt-1">
                                        <div class="bg-success bg-opacity-10 p-2 rounded-circle">
                                            <i class="bi bi-telephone text-success"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-1" style="color: #1a2330;">Phone</h6>
                                        <p class="text-muted small mb-0">+1 (555) 019-9300 <br class="d-md-none"> <span
                                                class="text-muted">General</span></p>
                                        <p class="text-muted small mb-0">+1 (555) 019-9311 <br class="d-md-none"> <span
                                                class="text-muted">Admissions</span></p>
                                    </div>
                                </div>

                                <div class="contact-item d-flex align-items-start p-3 rounded-3 mb-2 transition"
                                    style="border-left: 3px solid #dc3545; background: #f8f9fa;">
                                    <div class="me-3 mt-1">
                                        <div class="bg-danger bg-opacity-10 p-2 rounded-circle">
                                            <i class="bi bi-envelope text-danger"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-1" style="color: #1a2330;">Email</h6>
                                        <p class="text-muted small mb-0">
                                            <a href="mailto:admissions@grandview.edu"
                                                class="text-decoration-none text-primary">admissions@grandview.edu</a>
                                        </p>
                                        <p class="text-muted small mb-0">
                                            <a href="mailto:info@grandview.edu"
                                                class="text-decoration-none text-primary">info@grandview.edu</a>
                                        </p>
                                    </div>
                                </div>

                                <div class="contact-item d-flex align-items-start p-3 rounded-3 mb-3 transition"
                                    style="border-left: 3px solid #ffc107; background: #f8f9fa;">
                                    <div class="me-3 mt-1">
                                        <div class="bg-warning bg-opacity-10 p-2 rounded-circle">
                                            <i class="bi bi-clock text-warning"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-1" style="color: #1a2330;">Office Hours</h6>
                                        <p class="text-muted small mb-0">Mon – Fri: 8:00 AM – 6:00 PM</p>
                                        <p class="text-muted small mb-0">Sat: 9:00 AM – 1:00 PM</p>
                                    </div>
                                </div>

                                <div class="text-center pt-2">
                                    <p class="text-muted small mb-2">Follow Us</p>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="#" class="btn btn-outline-dark btn-sm rounded-circle"
                                            style="width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; border-width: 2px;">
                                            <i class="bi bi-twitter-x"></i>
                                        </a>
                                        <a href="#" class="btn btn-outline-dark btn-sm rounded-circle"
                                            style="width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; border-width: 2px;">
                                            <i class="bi bi-facebook"></i>
                                        </a>
                                        <a href="#" class="btn btn-outline-dark btn-sm rounded-circle"
                                            style="width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; border-width: 2px;">
                                            <i class="bi bi-instagram"></i>
                                        </a>
                                        <a href="#" class="btn btn-outline-dark btn-sm rounded-circle"
                                            style="width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; border-width: 2px;">
                                            <i class="bi bi-linkedin"></i>
                                        </a>
                                        <a href="#" class="btn btn-outline-dark btn-sm rounded-circle"
                                            style="width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; border-width: 2px;">
                                            <i class="bi bi-youtube"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Form -->
                    <div class="col-lg-7" data-aos="fade-left" data-aos-delay="200">
                        <div class="card border-0 shadow-lg rounded-4" style="background: #ffffff;">
                            <div class="card-body p-4 p-xl-5">
                                <div class="text-center mb-4">
                                    <div class="bg-success bg-opacity-10 d-inline-block p-3 rounded-3 mb-3">
                                        <i class="bi bi-pencil-square text-success" style="font-size: 2rem;"></i>
                                    </div>
                                    <h3 class="fw-bold mb-2" style="color: #1a2330;">Send Us a Message</h3>
                                    <p class="text-muted small" style="line-height: 1.7;">
                                        Fill out the form below and we'll get back to you within 24 hours.
                                    </p>
                                </div>

                                <form action="{{ route('contact.store') }}" method="POST">
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text" id="contactName" name="name"
                                                    class="form-control rounded-3 @error('name') is-invalid @enderror"
                                                    placeholder="Full Name" value="{{ old('name') }}" required />
                                                <label for="contactName">
                                                    <i class="bi bi-person me-2"></i>Full Name <span
                                                        class="text-danger">*</span>
                                                </label>
                                            </div>
                                            @error('name')
                                                <div class="text-danger small mt-1"><i
                                                        class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="email" id="contactEmail" name="email"
                                                    class="form-control rounded-3 @error('email') is-invalid @enderror"
                                                    placeholder="Email Address" value="{{ old('email') }}" required />
                                                <label for="contactEmail">
                                                    <i class="bi bi-envelope me-2"></i>Email <span
                                                        class="text-danger">*</span>
                                                </label>
                                            </div>
                                            @error('email')
                                                <div class="text-danger small mt-1"><i
                                                        class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="tel" id="contactPhone" name="phone"
                                                    class="form-control rounded-3 @error('phone') is-invalid @enderror"
                                                    placeholder="Phone Number" value="{{ old('phone') }}" />
                                                <label for="contactPhone">
                                                    <i class="bi bi-phone me-2"></i>Phone Number
                                                </label>
                                            </div>
                                            @error('phone')
                                                <div class="text-danger small mt-1"><i
                                                        class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <select id="contactSubject" name="subject"
                                                    class="form-select rounded-3 @error('subject') is-invalid @enderror"
                                                    style="height: calc(3.5rem + 2px);" required>
                                                    <option value="" disabled
                                                        {{ old('subject') ? '' : 'selected' }}>Select a subject…</option>
                                                    <option value="Admissions Enquiry"
                                                        {{ old('subject') == 'Admissions Enquiry' ? 'selected' : '' }}>
                                                        Admissions Enquiry</option>
                                                    <option value="Financial Aid"
                                                        {{ old('subject') == 'Financial Aid' ? 'selected' : '' }}>Financial
                                                        Aid</option>
                                                    <option value="Academic Programs"
                                                        {{ old('subject') == 'Academic Programs' ? 'selected' : '' }}>
                                                        Academic Programs</option>
                                                    <option value="Campus Services"
                                                        {{ old('subject') == 'Campus Services' ? 'selected' : '' }}>Campus
                                                        Services</option>
                                                    <option value="General Information"
                                                        {{ old('subject') == 'General Information' ? 'selected' : '' }}>
                                                        General Information</option>
                                                    <option value="Other"
                                                        {{ old('subject') == 'Other' ? 'selected' : '' }}>Other</option>
                                                </select>
                                                <label for="contactSubject">
                                                    <i class="bi bi-tag me-2"></i>Subject <span
                                                        class="text-danger">*</span>
                                                </label>
                                            </div>
                                            @error('subject')
                                                <div class="text-danger small mt-1"><i
                                                        class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-12">
                                            <div class="form-floating">
                                                <textarea id="contactMessage" name="message" class="form-control rounded-3 @error('message') is-invalid @enderror"
                                                    placeholder="Write your message here…" style="height: 150px; resize: none;" required>{{ old('message') }}</textarea>
                                                <label for="contactMessage">
                                                    <i class="bi bi-chat me-2"></i>Message <span
                                                        class="text-danger">*</span>
                                                </label>
                                            </div>
                                            @error('message')
                                                <div class="text-danger small mt-1"><i
                                                        class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-12 mt-3">
                                            <button type="submit"
                                                class="btn btn-primary btn-lg w-100 rounded-3 py-3 fw-semibold"
                                                style="background: linear-gradient(135deg, #2d465e 0%, #1a2330 100%); border: none; box-shadow: 0 10px 30px rgba(45, 70, 94, 0.25); transition: all 0.3s ease;">
                                                <i class="bi bi-send me-2"></i> Send Message
                                                <span class="ms-2 opacity-50 small">→</span>
                                            </button>
                                        </div>
                                    </div>
                                </form>

                                <div class="mt-3 text-center">
                                    <p class="text-muted small mb-0">
                                        <i class="bi bi-shield-check me-1 text-success"></i>
                                        Your information is safe with us. We'll never share your data.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Map Section -->
        <section style="padding: 0; position: relative;">
            <div class="container">
                <div style="height: 450px; overflow: hidden; position: relative;">
                    <div class="position-absolute top-0 start-0 w-100 h-100"
                        style="pointer-events: none; z-index: 1; background: linear-gradient(to bottom, transparent 80%, rgba(245, 247, 250, 1) 100%);">
                    </div>
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d112488.41424352468!2d83.87421773595993!3d28.229697706608693!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3995937bbf0376ff%3A0xf6cf823b25802164!2sPokhara!5e0!3m2!1sen!2snp!4v1781967853783!5m2!1sen!2snp"
                        width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('styles')
    <style>
        .page-banner {
            position: relative;
            isolation: isolate;
        }

        .page-banner::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 60%;
            height: 200%;
            background: radial-gradient(ellipse at 70% 50%, rgba(255, 255, 255, 0.05) 0%, transparent 70%);
            pointer-events: none;
            z-index: 0;
            animation: pulseGlow 8s ease-in-out infinite;
        }

        @keyframes pulseGlow {

            0%,
            100% {
                transform: scale(1) rotate(0deg);
            }

            50% {
                transform: scale(1.1) rotate(5deg);
            }
        }

        .hover-opacity-100:hover {
            opacity: 1 !important;
        }

        .transition {
            transition: all 0.3s ease;
        }

        .contact-item:hover {
            transform: translateX(5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05) !important;
        }

        .form-floating>.form-control:focus,
        .form-floating>.form-select:focus {
            border-color: #2d465e;
            box-shadow: 0 0 0 0.25rem rgba(45, 70, 94, 0.1);
        }

        .form-floating>.form-control.is-invalid:focus,
        .form-floating>.form-select.is-invalid:focus {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.1);
        }

        .form-floating>label {
            color: #6c757d;
            font-weight: 500;
        }

        .form-floating>.form-control:focus~label,
        .form-floating>.form-control:not(:placeholder-shown)~label,
        .form-floating>.form-select:focus~label,
        .form-floating>.form-select:not([value=""]):valid~label {
            color: #2d465e;
            font-weight: 600;
        }

        .btn-primary:hover {
            transform: translateY(-3px) scale(1.01);
            box-shadow: 0 15px 40px rgba(45, 70, 94, 0.35) !important;
        }

        .btn-primary:active {
            transform: translateY(0px) scale(0.99);
        }

        .card {
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        @media (max-width: 767.98px) {
            .page-banner {
                padding: 80px 0 60px !important;
            }

            .page-banner h1 {
                font-size: 2.2rem !important;
            }

            .card-body {
                padding: 25px 20px !important;
            }

            .contact-item {
                padding: 12px 15px !important;
            }

            .form-floating {
                margin-bottom: 5px;
            }
        }

        @media (min-width: 768px) and (max-width: 991.98px) {
            .card-body {
                padding: 30px 25px !important;
            }
        }

        /* Custom scrollbar for textarea */
        textarea::-webkit-scrollbar {
            width: 6px;
        }

        textarea::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        textarea::-webkit-scrollbar-thumb {
            background: #2d465e;
            border-radius: 10px;
        }

        textarea::-webkit-scrollbar-thumb:hover {
            background: #1a2330;
        }

        /* Alert animation */
        .alert {
            animation: slideDown 0.5s ease forwards;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endpush
