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

 <!-- Chatbot Bubble -->
 <div id="chat-bubble" onclick="toggleChat()" title="Ask us anything">
     <i class="bi bi-chat-dots-fill"></i>
 </div>

 <div id="chat-popup">
     <div id="chat-popup-header">
         <span>College Assistant</span>
         <button onclick="toggleChat()" aria-label="Close chat"><i class="bi bi-x-lg"></i></button>
     </div>
     <div id="chat-messages">
         <div class="chat-msg bot">Hi! Ask me about our events, services, blogs, or anything else.</div>
     </div>
     <div id="chat-input-row">
         <input type="text" id="chat-input" placeholder="Type a message..." autocomplete="off" />
         <button id="chat-send" onclick="chatSend()"><i class="bi bi-send-fill"></i></button>
     </div>
 </div>

 <style>
     #chat-bubble {
         position: fixed;
         bottom: 60px;
         right: 28px;
         width: 56px;
         height: 56px;
         background: #bfae8f;
         color: #fff;
         border-radius: 50%;
         display: flex;
         align-items: center;
         justify-content: center;
         font-size: 24px;
         cursor: pointer;
         z-index: 9999;
         transition: background 0.2s;
     }

     #chat-bubble:hover {
         background: #a89470;
     }

     #chat-popup {
         display: none;
         flex-direction: column;
         position: fixed;
         bottom: 96px;
         right: 28px;
         width: 340px;
         height: 480px;
         background: #1a1a2e;
         border: 1px solid #2e2e4e;
         border-radius: 14px;
         overflow: hidden;
         z-index: 9999;
     }

     #chat-popup.open {
         display: flex;
     }

     #chat-popup-header {
         display: flex;
         align-items: center;
         justify-content: space-between;
         padding: 14px 16px;
         background: #bfae8f;
         color: #fff;
         font-weight: 600;
         font-size: 15px;
     }

     #chat-popup-header button {
         background: none;
         border: none;
         color: #fff;
         font-size: 16px;
         cursor: pointer;
     }

     #chat-messages {
         flex: 1;
         overflow-y: auto;
         padding: 14px;
         display: flex;
         flex-direction: column;
         gap: 10px;
     }

     .chat-msg {
         max-width: 82%;
         padding: 9px 13px;
         border-radius: 12px;
         font-size: 13.5px;
         line-height: 1.55;
         word-break: break-word;
     }

     .chat-msg.user {
         align-self: flex-end;
         background: #bfae8f;
         color: #fff;
         border-bottom-right-radius: 3px;
     }

     .chat-msg.bot {
         align-self: flex-start;
         background: #2a2a3e;
         color: #e0ddd5;
         border-bottom-left-radius: 3px;
     }

     .chat-msg.typing {
         color: #888;
         font-style: italic;
     }

     .chat-msg.bot-html {
         align-self: flex-start;
         background: transparent;
         padding: 0;
         max-width: 100%;
     }

     /* Event card */
     .chat-card {
         display: block;
         border-radius: 10px;
         padding: 10px 13px;
         margin-bottom: 8px;
         cursor: pointer;
         text-decoration: none;
         transition: border-color 0.2s, background 0.2s;
         border: 1px solid #3a3a5e;
         background: #2a2a3e;
     }

     .chat-card:hover {
         border-color: #bfae8f;
         background: #32324a;
     }

     .chat-card-type {
         font-size: 10px;
         font-weight: 700;
         letter-spacing: 1px;
         text-transform: uppercase;
         margin-bottom: 4px;
     }

     .type-event {
         color: #bfae8f;
     }

     .type-service {
         color: #7ec8a4;
     }

     .type-blog {
         color: #7ab8f5;
     }

     .chat-card-title {
         color: #e0ddd5;
         font-weight: 600;
         font-size: 13.5px;
         margin-bottom: 4px;
     }

     .chat-card-meta {
         color: #a0a0b0;
         font-size: 11.5px;
         display: flex;
         gap: 10px;
         flex-wrap: wrap;
     }

     .chat-card-meta span {
         display: flex;
         align-items: center;
         gap: 4px;
     }

     #chat-input-row {
         display: flex;
         gap: 8px;
         padding: 10px 12px;
         border-top: 1px solid #2e2e4e;
         background: #1a1a2e;
     }

     #chat-input {
         flex: 1;
         padding: 9px 12px;
         border-radius: 8px;
         border: 1px solid #2e2e4e;
         background: #2a2a3e;
         color: #e0ddd5;
         font-size: 13.5px;
         outline: none;
     }

     #chat-input::placeholder {
         color: #666;
     }

     #chat-input:focus {
         border-color: #bfae8f;
     }

     #chat-send {
         padding: 9px 13px;
         background: #bfae8f;
         color: #fff;
         border: none;
         border-radius: 8px;
         cursor: pointer;
         font-size: 15px;
     }

     #chat-send:hover {
         background: #a89470;
     }

     #chat-send:disabled {
         background: #555;
         cursor: not-allowed;
     }
 </style>

 <script>
     const chatHistory = [];

     function toggleChat() {
         document.getElementById('chat-popup').classList.toggle('open');
         if (document.getElementById('chat-popup').classList.contains('open'))
             document.getElementById('chat-input').focus();
     }

     async function chatSend() {
         const input = document.getElementById('chat-input');
         const sendBtn = document.getElementById('chat-send');
         const text = input.value.trim();
         if (!text) return;

         addChatMsg('user', text);
         chatHistory.push({
             role: 'user',
             content: text
         });
         input.value = '';
         sendBtn.disabled = true;

         const typing = addChatMsg('bot', 'Typing...', true);

         try {
             const res = await fetch('/chatbot/chat', {
                 method: 'POST',
                 headers: {
                     'Content-Type': 'application/json',
                     'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                 },
                 body: JSON.stringify({
                     messages: chatHistory
                 }),
             });
             const data = await res.json();
             const reply = data.reply || data.error || 'Something went wrong.';
             typing.remove();
             renderBotReply(reply);
             chatHistory.push({
                 role: 'assistant',
                 content: reply
             });
         } catch (e) {
             typing.remove();
             addChatMsg('bot', 'Connection error. Please try again.');
         }

         sendBtn.disabled = false;
         input.focus();
     }

     function parseStructured(text) {
         const items = [];
         const patterns = [{
                 type: 'event',
                 rx: /\[EVENT\]([\s\S]*?)\[\/EVENT\]/g
             },
             {
                 type: 'service',
                 rx: /\[SERVICE\]([\s\S]*?)\[\/SERVICE\]/g
             },
             {
                 type: 'blog',
                 rx: /\[BLOG\]([\s\S]*?)\[\/BLOG\]/g
             },
         ];

         let parsed = text;
         patterns.forEach(({
             type,
             rx
         }) => {
             parsed = parsed.replace(rx, (_, inner) => {
                 const get = (key) => {
                     const m = inner.match(new RegExp(key + '=([^|\\]]+)'));
                     return m ? m[1].trim() : '';
                 };
                 items.push({
                     type,
                     title: get('title'),
                     slug: get('slug'),
                     date: get('date'),
                     location: get('location'),
                     description: get('description')
                 });
                 return ''; // remove from plain text
             });
         });

         return {
             plainText: parsed.trim(),
             items
         };
     }

     function makeCard(item) {
         const urls = {
             event: `/events/${item.slug}`,
             service: `/services/${item.slug}`,
             blog: `/blog/${item.slug}`,
         };
         const labels = {
             event: 'Event',
             service: 'Service',
             blog: 'Blog'
         };
         const icons = {
             event: 'bi-calendar3',
             service: 'bi-gear',
             blog: 'bi-file-text'
         };

         const a = document.createElement('a');
         a.className = 'chat-card';
         a.href = urls[item.type] || '#';

         let meta = '';
         if (item.date) meta += `<span><i class="bi bi-calendar3"></i> ${item.date}</span>`;
         if (item.location) meta += `<span><i class="bi bi-geo-alt"></i> ${item.location}</span>`;
         if (item.description) meta += `<span>${item.description}</span>`;

         a.innerHTML = `
        <div class="chat-card-type type-${item.type}"><i class="bi ${icons[item.type]}"></i> ${labels[item.type]}</div>
        <div class="chat-card-title">${item.title}</div>
        ${meta ? `<div class="chat-card-meta">${meta}</div>` : ''}
    `;
         return a;
     }

     function renderBotReply(text) {
         const msgs = document.getElementById('chat-messages');
         const {
             plainText,
             items
         } = parseStructured(text);

         if (plainText) {
             const el = document.createElement('div');
             el.className = 'chat-msg bot';
             el.textContent = plainText.replace(/\*\*([^*]+)\*\*/g, '$1');
             msgs.appendChild(el);
         }

         if (items.length > 0) {
             const wrapper = document.createElement('div');
             wrapper.className = 'chat-msg bot-html';
             items.forEach(item => wrapper.appendChild(makeCard(item)));
             msgs.appendChild(wrapper);
         }

         msgs.scrollTop = msgs.scrollHeight;
     }

     function addChatMsg(role, text, isTyping = false) {
         const el = document.createElement('div');
         el.className = 'chat-msg ' + role + (isTyping ? ' typing' : '');
         el.textContent = text;
         const msgs = document.getElementById('chat-messages');
         msgs.appendChild(el);
         msgs.scrollTop = msgs.scrollHeight;
         return el;
     }

     document.addEventListener('DOMContentLoaded', () => {
         document.getElementById('chat-input').addEventListener('keydown', e => {
             if (e.key === 'Enter') chatSend();
         });
     });
 </script>
 </body>

 </html>
