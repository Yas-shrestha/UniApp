@extends('frontend.layouts.master')

@section('content')
<main class="main">
      <section
        class="page-banner light-background"
        style="background: #faf8f4; padding: 90px 0 40px"
      >
        <div class="container">
          <small>Academics</small>
          <h1>Academics &amp; Degree Programs</h1>
          <p>
            Your pathway to knowledge, research, and professional success begins
            here.
          </p>
          <div class="banner-breadcrumb">
            <a href="index.html">Home</a>
            <span class="sep">/</span>
            <span>Academics</span>
          </div>
        </div>
      </section>

      <!-- Undergraduate Programs Section -->
      <section id="undergraduate" class="undergraduate section">
        <div class="container" data-aos="fade-up">
          <div class="section-title text-center mb-5">
            <h2>Undergraduate Programs</h2>
            <p>
              Four-year bachelor degrees focused on foundational theories,
              practical application, and career preparedness.
            </p>
          </div>

          <div class="row g-4">
            <!-- CS & AI -->
            <div class="col-lg-6" data-aos="zoom-in" data-aos-delay="100">
              <div
                class="course-detail-card d-flex flex-column flex-md-row bg-white p-4 shadow-sm rounded-4 border-start border-primary border-4 h-100"
              >
                <div class="flex-grow-1">
                  <span class="badge bg-primary-subtle text-primary mb-2"
                    >School of Engineering</span
                  >
                  <h3 class="fw-bold mb-2">B.Sc. Computer Science &amp; AI</h3>
                  <p class="text-muted small mb-3">
                    Duration: 4 Years | Core Intake: Fall, Spring
                  </p>
                  <p class="mb-0">
                    A comprehensive major that explores algorithms, machine
                    learning model training, systems engineering, and robotics.
                    Graduates are equipped to join major tech firms as software
                    developers and data engineers.
                  </p>
                </div>
              </div>
            </div>

            <!-- Business Administration -->
            <div class="col-lg-6" data-aos="zoom-in" data-aos-delay="200">
              <div
                class="course-detail-card d-flex flex-column flex-md-row bg-white p-4 shadow-sm rounded-4 border-start border-warning border-4 h-100"
              >
                <div class="flex-grow-1">
                  <span class="badge bg-warning-subtle text-warning mb-2"
                    >School of Business</span
                  >
                  <h3 class="fw-bold mb-2">
                    B.B.A. Global Business Management
                  </h3>
                  <p class="text-muted small mb-3">
                    Duration: 4 Years | Core Intake: Fall
                  </p>
                  <p class="mb-0">
                    Designed to build leaders in international finance,
                    marketing, and business strategy. Includes a mandatory
                    semester abroad at one of our 200+ partner universities.
                  </p>
                </div>
              </div>
            </div>

            <!-- Biomedical Science -->
            <div class="col-lg-6" data-aos="zoom-in" data-aos-delay="300">
              <div
                class="course-detail-card d-flex flex-column flex-md-row bg-white p-4 shadow-sm rounded-4 border-start border-success border-4 h-100"
              >
                <div class="flex-grow-1">
                  <span class="badge bg-success-subtle text-success mb-2"
                    >School of Sciences</span
                  >
                  <h3 class="fw-bold mb-2">B.Sc. Biomedical Science</h3>
                  <p class="text-muted small mb-3">
                    Duration: 4 Years | Core Intake: Fall
                  </p>
                  <p class="mb-0">
                    Study human anatomy, molecular biology, and pathology.
                    Features direct lab research opportunities in clinical
                    diagnostics, prepping students for pre-med and clinical
                    research careers.
                  </p>
                </div>
              </div>
            </div>

            <!-- Digital Arts & Design -->
            <div class="col-lg-6" data-aos="zoom-in" data-aos-delay="400">
              <div
                class="course-detail-card d-flex flex-column flex-md-row bg-white p-4 shadow-sm rounded-4 border-start border-info border-4 h-100"
              >
                <div class="flex-grow-1">
                  <span class="badge bg-info-subtle text-info mb-2"
                    >School of Design &amp; Arts</span
                  >
                  <h3 class="fw-bold mb-2">
                    B.F.A. Digital Design &amp; Media
                  </h3>
                  <p class="text-muted small mb-3">
                    Duration: 4 Years | Core Intake: Fall, Spring
                  </p>
                  <p class="mb-0">
                    Focuses on game development, visual effects, 3D modelling,
                    and user experience design. Learn alongside industry
                    practitioners in high-end design clusters.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Postgraduate Section -->
      <section id="postgraduate" class="postgraduate section light-background">
        <div class="container" data-aos="fade-up">
          <div class="section-title text-center mb-5">
            <h2>Postgraduate &amp; Research Programs</h2>
            <p>
              Advanced masters degrees and fully-funded doctoral research
              fellowships targeting major academic breakthroughs.
            </p>
          </div>

          <div class="row g-4">
            <!-- M.Sc Data Science -->
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
              <div
                class="bg-white p-4 h-100 rounded-4 shadow-sm d-flex flex-column justify-content-between"
              >
                <div>
                  <span class="text-primary fw-bold text-uppercase small"
                    >Master of Science</span
                  >
                  <h4 class="fw-bold mt-1 mb-3">
                    M.Sc. Data Science &amp; Big Data
                  </h4>
                  <p class="text-muted">
                    A two-year research-driven program focusing on statistical
                    modelling, deep learning, cloud computation, and ethics in
                    automated systems.
                  </p>
                </div>
                <p class="text-primary small fw-medium mt-3 mb-0">
                  Duration: 2 Years | Thesis Track
                </p>
              </div>
            </div>

            <!-- MBA -->
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
              <div
                class="bg-white p-4 h-100 rounded-4 shadow-sm d-flex flex-column justify-content-between"
              >
                <div>
                  <span class="text-warning fw-bold text-uppercase small"
                    >Business Administration</span
                  >
                  <h4 class="fw-bold mt-1 mb-3">Executive M.B.A. Strategy</h4>
                  <p class="text-muted">
                    Accelerated curriculum designed for executives. Explores
                    corporate finance, venture capital, and negotiation
                    strategies.
                  </p>
                </div>
                <p class="text-warning small fw-medium mt-3 mb-0">
                  Duration: 1.5 Years | Weekend Track
                </p>
              </div>
            </div>

            <!-- PhD Biotech -->
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
              <div
                class="bg-white p-4 h-100 rounded-4 shadow-sm d-flex flex-column justify-content-between"
              >
                <div>
                  <span class="text-success fw-bold text-uppercase small"
                    >Doctoral Fellowship</span
                  >
                  <h4 class="fw-bold mt-1 mb-3">PhD in Biotechnology</h4>
                  <p class="text-muted">
                    Fully funded 4-year doctoral research fellowship targeting
                    genetic engineering, vaccine development, and
                    bioinformatics.
                  </p>
                </div>
                <p class="text-success small fw-medium mt-3 mb-0">
                  Duration: 4 Years | Fully Funded
                </p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Executive Certificates Section -->
      <section id="certificates" class="certificates section">
        <div class="container" data-aos="fade-up">
          <div class="section-title text-center mb-5">
            <h2>Executive Education &amp; Short Certificates</h2>
            <p>
              Micro-credentials and specialized skills certifications for
              working professionals seeking career pivots.
            </p>
          </div>

          <div class="row justify-content-center g-4">
            <div class="col-lg-5" data-aos="zoom-in" data-aos-delay="100">
              <div
                class="p-4 bg-light rounded-4 h-100 d-flex gap-3 align-items-start"
              >
                <div class="fs-1 text-primary">
                  <i class="bi bi-shield-check"></i>
                </div>
                <div>
                  <h4 class="fw-bold mb-2">
                    Professional Certificate in Cybersecurity
                  </h4>
                  <p class="text-muted mb-0">
                    A 6-month online certificate covering network penetration
                    testing, digital forensics, and ethical hacking. Starts
                    monthly.
                  </p>
                </div>
              </div>
            </div>

            <div class="col-lg-5" data-aos="zoom-in" data-aos-delay="200">
              <div
                class="p-4 bg-light rounded-4 h-100 d-flex gap-3 align-items-start"
              >
                <div class="fs-1 text-primary"><i class="bi bi-cpu"></i></div>
                <div>
                  <h4 class="fw-bold mb-2">
                    AI for Business Leaders Certificate
                  </h4>
                  <p class="text-muted mb-0">
                    3-month hybrid course explaining machine learning adoption,
                    automated pipeline management, and AI risk strategies.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Admissions Requirements Section -->
      <section
        id="admission-requirements"
        class="admission-requirements section light-background"
      >
        <div class="container" data-aos="fade-up">
          <div class="section-title text-center mb-5">
            <h2>Admission Requirements</h2>
            <p>
              Find out what credentials and documentation you need to submit for
              a successful application.
            </p>
          </div>

          <div class="row justify-content-center">
            <div class="col-lg-10">
              <div class="accordion" id="requirementsAccordion">
                <!-- Undergrad Requirements -->
                <div
                  class="accordion-item border-0 mb-3 shadow-sm rounded-4 overflow-hidden"
                >
                  <h2 class="accordion-header" id="headingOne">
                    <button
                      class="accordion-button fw-bold text-dark bg-white"
                      type="button"
                      data-bs-toggle="collapse"
                      data-bs-target="#collapseOne"
                      aria-expanded="true"
                      aria-controls="collapseOne"
                    >
                      Undergraduate Admission Criteria
                    </button>
                  </h2>
                  <div
                    id="collapseOne"
                    class="accordion-collapse collapse show"
                    aria-labelledby="headingOne"
                    data-bs-parent="#requirementsAccordion"
                  >
                    <div class="accordion-body bg-white text-muted">
                      <ul>
                        <li class="mb-2">
                          <i class="bi bi-check-circle text-primary me-2"></i>
                          High School Diploma or equivalent academic secondary
                          qualification.
                        </li>
                        <li class="mb-2">
                          <i class="bi bi-check-circle text-primary me-2"></i>
                          Cumulative High School GPA of 3.0 or higher on a 4.0
                          scale.
                        </li>
                        <li class="mb-2">
                          <i class="bi bi-check-circle text-primary me-2"></i>
                          Official academic transcripts of the last 3 years of
                          study.
                        </li>
                        <li class="mb-2">
                          <i class="bi bi-check-circle text-primary me-2"></i>
                          Proof of English Proficiency (IELTS 6.5 or equivalent
                          for non-native speakers).
                        </li>
                        <li class="mb-2">
                          <i class="bi bi-check-circle text-primary me-2"></i>
                          Standardized test scores (SAT/ACT) are optional but
                          recommended.
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>

                <!-- Graduate Requirements -->
                <div
                  class="accordion-item border-0 mb-3 shadow-sm rounded-4 overflow-hidden"
                >
                  <h2 class="accordion-header" id="headingTwo">
                    <button
                      class="accordion-button collapsed fw-bold text-dark bg-white"
                      type="button"
                      data-bs-toggle="collapse"
                      data-bs-target="#collapseTwo"
                      aria-expanded="false"
                      aria-controls="collapseTwo"
                    >
                      Postgraduate &amp; Doctoral Admission Criteria
                    </button>
                  </h2>
                  <div
                    id="collapseTwo"
                    class="accordion-collapse collapse"
                    aria-labelledby="headingTwo"
                    data-bs-parent="#requirementsAccordion"
                  >
                    <div class="accordion-body bg-white text-muted">
                      <ul>
                        <li class="mb-2">
                          <i class="bi bi-check-circle text-primary me-2"></i>
                          Accredited Bachelor’s Degree in a related field.
                        </li>
                        <li class="mb-2">
                          <i class="bi bi-check-circle text-primary me-2"></i>
                          Minimum undergraduate GPA of 3.0 on a 4.0 scale.
                        </li>
                        <li class="mb-2">
                          <i class="bi bi-check-circle text-primary me-2"></i>
                          Two letters of recommendation from academic or
                          professional references.
                        </li>
                        <li class="mb-2">
                          <i class="bi bi-check-circle text-primary me-2"></i>
                          Detailed statement of purpose outlining research goals
                          (especially for PhD).
                        </li>
                        <li class="mb-2">
                          <i class="bi bi-check-circle text-primary me-2"></i>
                          Proof of English Proficiency (IELTS 7.0 or
                          equivalent).
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>
@endsection
