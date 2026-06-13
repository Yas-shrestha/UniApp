@extends('frontend.layouts.master')

@section('content')
  
    <main class="main">
        <section class="page-banner light-background" style="background: #faf8f4; padding: 90px 0 40px">
            <div class="container">
                <small>Events</small>
                <h1>Event Detail</h1>
                <div class="banner-breadcrumb">
                    <a href="index.html">Home</a>
                    <span class="sep">/</span>
                    <a href="events.html">Events</a>
                    <span class="sep">/</span>
                    <span>Event Detail</span>
                </div>
            </div>
        </section>

        <!-- Main Content -->
        <section class="section" style="background: #faf8f4; padding: 60px 0 80px">
            <div class="container">
                <div class="row g-5">
                    <!-- LEFT: Speaker image + bio -->
                    <div class="col-lg-3 col-md-4" data-aos="fade-right">
                        <img id="speakerImg" src="assets/img/avatar-1.webp" alt="Speaker" class="ed-speaker-img" />
                        <div class="ed-speaker-card mt-4">
                            <p
                                style="
                    font-size: 0.72rem;
                    font-weight: 700;
                    text-transform: uppercase;
                    letter-spacing: 0.5px;
                    opacity: 0.75;
                    margin-bottom: 6px;
                  ">
                                Event Speaker
                            </p>
                            <h4 id="speakerName">Dr. Sarah Chen</h4>
                            <p id="speakerRole">Lead AI Researcher, Grandview Tech Lab</p>
                        </div>
                    </div>

                    <!-- MIDDLE: Event body -->
                    <div class="col-lg-5 col-md-8 ed-body" data-aos="fade-up" data-aos-delay="80">
                        <span class="ed-category-tag" id="evCategoryTag">AI &amp; Tech</span>
                        <h1 class="ed-title" id="evTitle">
                            AI Innovation Workshop: Building Intelligent Systems
                        </h1>

                        <div class="ed-meta-row" id="evMetaRow">
                            <div class="ed-meta-item">
                                <i class="bi bi-calendar3"></i>
                                <div><strong>10 June 2026</strong></div>
                            </div>
                            <div class="ed-meta-item">
                                <i class="bi bi-clock"></i>
                                <div>10:00 AM – 02:00 PM</div>
                            </div>
                            <div class="ed-meta-item">
                                <i class="bi bi-geo-alt"></i>
                                <div>Tech Hub, Room 204</div>
                            </div>
                        </div>

                        <p id="evIntro">
                            Join us for an immersive full-day workshop where you'll learn
                            how modern AI systems are designed, trained, and deployed in
                            real-world enterprise environments. This hands-on session is led
                            by Dr. Sarah Chen, one of Grandview's leading AI researchers.
                        </p>

                        <h3>What You'll Learn</h3>
                        <ul id="evPoints">
                            <li>
                                <i class="bi bi-check-circle-fill"></i>Fundamentals of neural
                                network architecture and deep learning pipelines.
                            </li>
                            <li>
                                <i class="bi bi-check-circle-fill"></i>How to build and
                                fine-tune large language models for domain-specific use cases.
                            </li>
                            <li>
                                <i class="bi bi-check-circle-fill"></i>Responsible AI — bias
                                detection, explainability, and ethical deployment frameworks.
                            </li>
                            <li>
                                <i class="bi bi-check-circle-fill"></i>Hands-on labs using
                                industry-standard tools: PyTorch, Hugging Face, and LangChain.
                            </li>
                            <li>
                                <i class="bi bi-check-circle-fill"></i>Live demonstration of
                                Grandview's proprietary AI campus assistant prototype.
                            </li>
                        </ul>

                        <h3>Who Should Attend</h3>
                        <p id="evAudience">
                            This workshop is open to all Grandview students, postgraduate
                            researchers, and faculty members with an interest in artificial
                            intelligence. Prior coding experience in Python is recommended
                            but not required.
                        </p>

                        <h3>Related Events</h3>
                        <div id="relatedEvents">
                            <!-- Rendered by JS -->
                        </div>
                    </div>

                    <!-- RIGHT: Sidebar info + RSVP -->
                    <div class="col-lg-4" data-aos="fade-left" data-aos-delay="120">
                        <div class="ed-sidebar-card">
                            <div class="card-header-strip">
                                <h3>Event Details</h3>
                            </div>
                            <div class="card-body-inner">
                                <div class="ed-info-line">
                                    <div class="icon"><i class="bi bi-calendar3"></i></div>
                                    <div>
                                        <div class="label">Date</div>
                                        <div class="value" id="sideDate">10 June 2026</div>
                                    </div>
                                </div>
                                <div class="ed-info-line">
                                    <div class="icon"><i class="bi bi-clock"></i></div>
                                    <div>
                                        <div class="label">Time</div>
                                        <div class="value" id="sideTime">10:00 AM – 02:00 PM</div>
                                    </div>
                                </div>
                                <div class="ed-info-line">
                                    <div class="icon"><i class="bi bi-geo-alt"></i></div>
                                    <div>
                                        <div class="label">Location</div>
                                        <div class="value" id="sideLocation">
                                            Tech Hub, Room 204
                                        </div>
                                    </div>
                                </div>
                                <div class="ed-info-line">
                                    <div class="icon"><i class="bi bi-people"></i></div>
                                    <div>
                                        <div class="label">Capacity</div>
                                        <div class="value" id="sideSeats">40 seats remaining</div>
                                    </div>
                                </div>
                                <div class="ed-info-line">
                                    <div class="icon"><i class="bi bi-tag"></i></div>
                                    <div>
                                        <div class="label">Category</div>
                                        <div class="value" id="sideCat">AI &amp; Technology</div>
                                    </div>
                                </div>
                                <div class="ed-info-line">
                                    <div class="icon"><i class="bi bi-ticket"></i></div>
                                    <div>
                                        <div class="label">Admission</div>
                                        <div class="value">Free for Grandview students</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- RSVP Form -->
                        <div class="ed-rsvp-form">
                            <h4>
                                <i class="bi bi-send me-2" style="color: #997122"></i>RSVP /
                                Register
                            </h4>
                            <div class="d-flex flex-column gap-2">
                                <input type="text" class="form-control" placeholder="Full Name" id="rsvpName" />
                                <input type="email" class="form-control" placeholder="Email Address" id="rsvpEmail" />
                                <select class="form-control" id="rsvpType">
                                    <option value="" disabled selected>I am a…</option>
                                    <option>Undergraduate Student</option>
                                    <option>Postgraduate Student</option>
                                    <option>Faculty Member</option>
                                    <option>Alumni</option>
                                    <option>External Guest</option>
                                </select>
                                <button class="btn-rsvp" onclick="submitRSVP()">
                                    Confirm My Spot <i class="bi bi-arrow-right ms-2"></i>
                                </button>
                                <p id="rsvpMsg"
                                    style="
                      font-size: 0.82rem;
                      color: #1a7a4a;
                      margin: 0;
                      display: none;
                    ">
                                    <i class="bi bi-check-circle-fill me-1"></i> You're
                                    registered! Check your email for confirmation.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
@endsection
