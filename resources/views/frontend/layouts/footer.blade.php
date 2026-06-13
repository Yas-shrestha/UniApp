 <!-- Footer -->
 <footer id="footer" class="footer">
     <div class="container footer-top">
         <div class="row gy-4">
             <div class="col-lg-3 col-md-6 footer-links">
                 <h4>Services</h4>
                 <ul>
                     <li><a href="#">Technical Support</a></li>
                     <li><a href="#">Cloud Solutions</a></li>
                     <li><a href="#">Managed Services</a></li>
                     <li><a href="#">Consulting</a></li>
                 </ul>
             </div>

             <div class="col-lg-3 col-md-6 footer-links">
                 <h4>Usefuls</h4>
                 <ul>
                     <li><a href="#">Contact Us</a></li>
                     <li><a href="#">Blog</a></li>
                     <li><a href="#">Help Center</a></li>
                 </ul>
             </div>

             <div class="col-lg-3 col-md-6 footer-links">
                 <h4>Company</h4>
                 <ul>
                     <li><a href="#">About us</a></li>
                     <li><a href="#">Careers</a></li>
                     <li><a href="#">Feedback</a></li>
                 </ul>
             </div>

             <div class="col-lg-3 col-md-6">
                 <h4>Subscribe</h4>
                 <div class="footer-subscribe-box">
                     <input type="email" placeholder="Email Address" />
                     <button type="button"><i class="bi bi-chevron-right"></i></button>
                 </div>
                 <p class="mt-3" style="font-size: 0.85rem; opacity: 0.75">
                     Join our community to keep up to date with our news and events.
                 </p>
             </div>
         </div>
     </div>

     <div class="container copyright text-center mt-4">
         <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
             <a href="{{ route('home') }}" class="logo d-flex align-items-center mb-3 mb-md-0">
                 <span class="sitename" style="color: #fff; font-weight: 700; font-size: 1.5rem">Grandview</span>
             </a>
             <div class="d-flex gap-4 mb-3 mb-md-0" style="font-size: 0.9rem">
                 <a href="#" style="color: #bfae8f">Terms</a>
                 <a href="#" style="color: #bfae8f">Privacy</a>
                 <a href="#" style="color: #bfae8f">Policy</a>
             </div>
             <div class="social-links d-flex">
                 <a href="#" class="me-2" style="color: #bfae8f"><i class="bi bi-twitter-x"></i></a>
                 <a href="#" class="me-2" style="color: #bfae8f"><i class="bi bi-facebook"></i></a>
                 <a href="#" class="me-2" style="color: #bfae8f"><i class="bi bi-instagram"></i></a>
                 <a href="#" style="color: #bfae8f"><i class="bi bi-linkedin"></i></a>
             </div>
         </div>
     </div>
 </footer>

 <!-- Scroll Top -->
 <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
         class="bi bi-arrow-up-short"></i></a>

 <!-- Vendor JS Files -->
 <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
 <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
 <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
 <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

 <!-- Dynamic Rendering & Logic Script -->
 <script>
     // Backend Friendly Data Arrays
     const solutionsData = {
         past: [{
                 title: "AI-Powered Virtual Assistant",
                 image: "assets/img/solutions-1.png",
             },
             {
                 title: "Prototyping Solutions",
                 image: "assets/img/solutions-2.png",
             },
             {
                 title: "Business Automation",
                 image: "assets/img/solutions-3.png"
             },
             {
                 title: "Designing",
                 image: "assets/img/solutions-4.png"
             },
         ],
         future: [{
                 title: "Business Automation",
                 image: "assets/img/solutions-3.png"
             },
             {
                 title: "Designing",
                 image: "assets/img/solutions-4.png"
             },
             {
                 title: "AI-Powered Virtual Assistant",
                 image: "assets/img/solutions-1.png",
             },
             {
                 title: "Prototyping Solutions",
                 image: "assets/img/solutions-2.png",
             },
         ],
     };

     const testimonialsData = [
         [
             // Slide 1
             {
                 name: "Kate Winslet",
                 role: "HR Manager",
                 stars: 5,
                 text: "The preference system is system is system is system. The preference is system in system is system.",
                 image: "assets/img/testimonials/testimonials-1.jpg",
             },
             {
                 name: "Tom",
                 role: "HR Manager",
                 stars: 5,
                 text: "The preference system is system is system is system. The preference is system in system is system.",
                 image: "assets/img/testimonials/testimonials-2.jpg",
             },
             {
                 name: "Elena",
                 role: "HR Manager",
                 stars: 5,
                 text: "The preference system is system is system is system. The preference is system in system is system.",
                 image: "assets/img/testimonials/testimonials-3.jpg",
             },
         ],
         [
             // Slide 2
             {
                 name: "Sophia Martinez",
                 role: "HR Manager",
                 stars: 5,
                 text: "The preference system is system is system is system. The preference is system in system is system.",
                 image: "assets/img/avatar-2.webp",
             },
             {
                 name: "Marcus Sterling",
                 role: "HR Manager",
                 stars: 5,
                 text: "The preference system is system is system is system. The preference is system in system is system.",
                 image: "assets/img/avatar-1.webp",
             },
             {
                 name: "Aiden Patel",
                 role: "HR Manager",
                 stars: 5,
                 text: "The preference system is system is system is system. The preference is system in system is system.",
                 image: "assets/img/avatar-3.webp",
             },
         ],
     ];

     const typesData = [{
             title: "Townhouses",
             image: "assets/img/types-1.png"
         },
         {
             title: "Skyscrapers",
             image: "assets/img/types-2.png"
         },
         {
             title: "Social & Co-working",
             image: "assets/img/types-3.png"
         },
         {
             title: "Multi-family Res",
             image: "assets/img/types-4.png"
         },
         {
             title: "Suburban landscape",
             image: "assets/img/types-5.png"
         },
     ];

     // Solutions Tab Switching Logic
     function renderSolutions(tabKey) {
         const container = document.getElementById("solutionsContainer");
         if (!container) return;

         container.innerHTML = "";
         const items = solutionsData[tabKey] || [];

         items.forEach((item, idx) => {
             const cardHtml = `
            <div class="col-lg-6 col-md-6 col-12" data-aos="fade-up" data-aos-delay="${(idx + 1) * 100}">
              <div class="solutions-card">
                <img src="${item.image}" alt="${item.title}" />
                <div class="solutions-card-overlay">
                  <h3>${item.title}</h3>
                  <button class="btn-seemore">SEE MORE</button>
                </div>
              </div>
            </div>
          `;
             container.innerHTML += cardHtml;
         });
     }

     function switchTab(tabKey) {
         // Update tab buttons active state
         document.querySelectorAll(".solutions-tab-btn").forEach((btn) => {
             btn.classList.toggle(
                 "active",
                 btn.textContent.toLowerCase() === tabKey.toLowerCase(),
             );
         });
         renderSolutions(tabKey);
     }

     // Render Types Logic
     function renderTypes() {
         const topRow = document.getElementById("typesRowTop");
         const bottomRow = document.getElementById("typesRowBottom");
         if (!topRow || !bottomRow) return;

         topRow.innerHTML = "";
         bottomRow.innerHTML = "";

         typesData.forEach((item, idx) => {
             const cardHtml = `
            <div class="col-lg-4 col-md-6 col-12" data-aos="fade-up" data-aos-delay="${(idx + 1) * 100}">
              <div class="types-card">
                <img src="${item.image}" alt="${item.title}" />
                <div class="types-card-overlay">
                  <h3>${item.title}</h3>
                </div>
              </div>
            </div>
          `;
             if (idx < 3) {
                 topRow.innerHTML += cardHtml;
             } else {
                 // Adjust bootstrap class for centering bottom row
                 const bottomCardHtml = `
              <div class="col-lg-4 col-md-6 col-12" data-aos="fade-up" data-aos-delay="${(idx + 1) * 100}">
                <div class="types-card">
                  <img src="${item.image}" alt="${item.title}" />
                  <div class="types-card-overlay">
                    <h3>${item.title}</h3>
                  </div>
                </div>
              </div>
            `;
                 bottomRow.innerHTML += bottomCardHtml;
             }
         });
     }

     // Render Testimonials Logic
     function renderTestimonials() {
         const track = document.getElementById("testimonialsTrack");
         if (!track) return;

         track.innerHTML = "";
         testimonialsData.forEach((slideGroup) => {
             let slideHtml = `<div class="testimonials-slide"><div class="row g-4">`;

             slideGroup.forEach((t) => {
                 let starsHtml = "";
                 for (let i = 0; i < t.stars; i++) {
                     starsHtml += `<i class="bi bi-star-fill"></i>`;
                 }

                 slideHtml += `
              <div class="col-lg-4 col-md-6 col-12">
                <div class="testimonial-item">
                  <div class="stars">${starsHtml}</div>
                  <p>${t.text}</p>
                  <div class="d-flex align-items-center mt-3">
                    <img src="${t.image}" class="testimonial-img me-3" alt="${t.name}" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;" />
                    <div>
                      <h4 class="m-0 fw-bold" style="font-size: 1rem; color: #2d465e;">${t.name}</h4>
                      <span class="text-muted" style="font-size: 0.8rem;">${t.role}</span>
                    </div>
                  </div>
                </div>
              </div>
            `;
             });

             slideHtml += `</div></div>`;
             track.innerHTML += slideHtml;
         });
     }

     // Initialize Testimonial Slider Controls
     function initSlider() {
         const track = document.getElementById("testimonialsTrack");
         const dotsWrap = document.getElementById("testimonialsDots");
         const prevBtn = document.getElementById("testimonialsPrev");
         const nextBtn = document.getElementById("testimonialsNext");

         if (!track || !dotsWrap) return;

         const slides = track.querySelectorAll(".testimonials-slide");
         const total = slides.length;
         let current = 0;

         dotsWrap.innerHTML = "";
         slides.forEach((_, i) => {
             const dot = document.createElement("button");
             dot.className = "testimonials-dot" + (i === 0 ? " active" : "");
             dot.setAttribute("aria-label", "Go to slide " + (i + 1));
             dot.addEventListener("click", () => goTo(i));
             dotsWrap.appendChild(dot);
         });

         function goTo(idx) {
             current = (idx + total) % total;
             track.style.transform = `translateX(-${current * 100}%)`;

             dotsWrap
                 .querySelectorAll(".testimonials-dot")
                 .forEach((d, i) => d.classList.toggle("active", i === current));

             prevBtn.classList.toggle("testimonials-btn--active", current > 0);
             nextBtn.classList.toggle(
                 "testimonials-btn--active",
                 current < total - 1,
             );
         }

         prevBtn.addEventListener("click", () => goTo(current - 1));
         nextBtn.addEventListener("click", () => goTo(current + 1));

         // Initial state
         goTo(0);
     }

     // Page Init
     document.addEventListener("DOMContentLoaded", () => {
         renderSolutions("past");
         renderTypes();
         renderTestimonials();
         initSlider();
     });
 </script>

 <!-- Main JS File -->
 <script src="{{ asset('assets/js/main.js') }}"></script>
 </body>

 </html>
