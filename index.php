<!DOCTYPE html>
<html lang="en">
<head>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-8TJ385L568"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-8TJ385L568');
  //https://analytics.google.com/analytics/web/?authuser=1#/p465822342/reports/reportinghub?params=_u..nav%3Dmaui
</script>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Kerwin Thompson - Web Developer Portfolio" />
  <meta http-equiv="Content-Security-Policy" content="default-src 'self'; 
    font-src 'self' fonts.googleapis.com fonts.gstatic.com; 
    script-src 'self' 'unsafe-inline' www.googletagmanager.com www.google-analytics.com; 
    style-src 'self' 'unsafe-inline' fonts.googleapis.com cdnjs.cloudflare.com; 
    img-src 'self' https://fs.kerwindows.com https://www.google-analytics.com https://raw.githubusercontent.com https://github.com https://camo.githubusercontent.com https://cdn-icons-png.flaticon.com; 
    connect-src 'self' www.google-analytics.com;">
  <title>Kerwin Thompson | Web Developer</title>

  <!-- Stylesheets -->
  <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css" />-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" />
  <link rel="stylesheet" href="css/style.css" />

  <!-- Favicon -->
  <link rel="icon" href="./favicon.ico" type="image/x-icon" />

  <!-- Open Graph Meta Tags -->
  <meta property="og:title" content="Kerwin Thompson | Web Developer" />
  <meta property="og:description" content="Explore Kerwin Thompson's web development portfolio, showcasing skills in frontend and backend development." />
  <meta property="og:image" content="src='https://fs.kerwindows.com/img/kerwin-toy-og.png'" />
  <meta property="og:url" content="https://fs.kerwindows.com" />
  <meta property="og:type" content="website" />

  <!-- Twitter Card Meta Tags (Optional) -->
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:title" content="Kerwin Thompson | Web Developer" />
  <meta name="twitter:description" content="Explore Kerwin Thompson's web development portfolio, showcasing skills in frontend and backend development." />
  <meta name="twitter:image" content="src='https://fs.kerwindows.com/img/kerwin-toy-og.png'" />
  <style>
.skills__scroller {
  overflow: hidden;
  display: flex;
  flex-direction: column;
  gap: 20px;
  padding: 20px 0;
}

.skills__row {
  display: flex;
  flex-wrap: nowrap;
  width: max-content; /* Important for animation */
  animation: scroll-left 30s linear infinite;
}

.skills__row:nth-child(2) {
  animation-direction: reverse;
  animation-duration: 35s; /* Slight variation */
}

.skills__item {
  flex: 0 0 auto;
  display: flex;
  flex-direction: column;
  align-items: center;
  margin-right: 40px;
  min-width: 80px;
}

.skills__icon {
  width: 48px;
  height: auto;
}

.skills__name {
  margin-top: 8px;
  font-size: 0.9rem;
  text-align: center;
}
.skills__row:hover {
  animation-play-state: paused;
}

.skills__item {
    border-top: unset;
    border-radius: unset;
    -webkit-box-shadow: unset; 
    box-shadow: unset;
}



/* Infinite scroll keyframe */
@keyframes scroll-left {
  0% {
    transform: translateX(0);
  }
  100% {
    transform: translateX(-50%);
  }
}

</style>
</head>


<body>
  <main class="page">
    <section class="page__top-section">
      <!-- Navigation Bar -->
      <nav class="navbar">
        <div class="navbar__brand">
          <div class="navbar__logo">KT</div>
          <span class="navbar__name">Kerwin Thompson</span>
        </div>
        <ul class="navbar__links">
          <li class="navbar__item"><a href="#home" class="navbar__link">Home</a></li>
          <li class="navbar__item"><a href="#skills" class="navbar__link">Skills</a></li>
          <li class="navbar__item"><a href="#about" class="navbar__link">About Me</a></li>
          <li class="navbar__item"><a href="#portfolio" class="navbar__link">Portfolio</a></li>
          <li class="navbar__item"><a href="#contact" class="navbar__link">Contact</a></li>
        </ul>
        <div class="hamburger" onclick="toggleMenu()">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </nav>
      <div class="fullscreen-menu">
        <span class="fullscreen-menu__close" onclick="toggleMenu()">&#10005;</span>
        <ul class="fullscreen-menu__links">
          <li><a href="#home" class="fullscreen-menu__link">Home</a></li>
          <li><a href="#skills" class="fullscreen-menu__link">Skills</a></li>
          <li><a href="#about" class="fullscreen-menu__link">About Me</a></li>
          <li><a href="#portfolio" class="fullscreen-menu__link">Portfolio</a></li>
          <li><a href="#contact" class="fullscreen-menu__link">Contact</a></li>
        </ul>
      </div>
      <!-- Hero Section -->
      <header id="home" class="hero">
        <div class="hero__content">
          <h1 class="hero__title">
            Full Stack <span class="text__highlight-secondary">Web</span> Developer
          </h1>
          <p id="ctrl__typed-text" class="hero__description">
            <span id="typed-text"></span><span class="hero__cursor"> |</span>
          </p>
          <div class="cta__buttons">
            <a href="#portfolio" class="btn cta__btn--primary">Explore My Work</a>
            <a href="#about" class="btn cta__btn--secondary">About Me</a>
          </div>
        </div>
        <!--<div class="hero__image">-->
        <div class="hero__image-toy">
          <!--<img src="./img/kerwinThompson.webp" alt="Kerwin Thompson, Web Developer" loading="lazy" />-->
          <img src="./img/kerwin-toy.png" alt="Kerwin Thompson, Web Developer" loading="lazy" />
        </div>
      </header>
    </section>
    <section class="skills">
      <div id="skills" class="skills__section">
        <div class="skills__container">
          <div class="skills__header">
            <h2 class="skills__title">Crafting Solutions with <span class="text__highlight-secondary">Code</span> and <span class="text__highlight-secondary">Creativity</span></h2>
            <p class="skills__description">
              My passion lies in blending creativity with technical skill to deliver solutions that not only meet client goals but also provide users with a smooth and enjoyable experience. Whether it's coding a dynamic web app or managing content, I’m all about building solutions that work. Every project is a chance to learn something new, and my passion for self-development keeps me pushing boundaries.
            </p>
          </div>
          <div class="skills__cta">
            <a href="#portfolio" class="btn cta__btn--primary">My Portfolio</a>
          </div>
        </div>
        <article>
  <!--<div class="skills__grid" id="skillsGrid"></div>-->
  
  
  <div class="skills__scroller">
  <div class="skills__row" id="skillsRow1"></div>
  <div class="skills__row" id="skillsRow2"></div>
</div>
  
</article>
      </div>
    </section>
    <section id="about" class="about">
      <div class="about__container">
        <div class="about__content">
          <h2 class="about__title">Professional <span class="text__highlight-primary">Journey</span></h2>
          <p class="about__text">
            I began my career as a teacher, where I learned the importance of clear communication and adaptability—
            s that have significantly shaped my approach to web development. I focus on responsive design, user experience, and performance optimization, striving to deliver smooth, user-friendly interactions.</p>
          <p class="about__text">
            When I’m not working with code, I look forward to spending time with my family and doing silly things. These experiences keep me balanced and recharged, helping me stay grounded and ready for the next challenge.
          </p>
          <a href="#portfolio" class="btn cta__btn--primary">My Portfolio</a>
        </div>
        <div class="about__images">
          <div class="about__image-wrapper">
            <img src="./img/kerwin+family.jpeg"
              alt="Outdoor Adventure" class="about__image" />
          </div>
          <div class="about__image-wrapper">
            <img src="./img/kerwin+computer.jpeg"
              alt="Working on a Project" class="about__image" />
          </div>
        </div>
      </div>
    </section>
    <section id="portfolio" class="portfolio">
      <div class="portfolio__header">
        <h2 class="portfolio__title">Websites <span class="text__highlight-secondary">Recently</span> Built</h2>
        <p class="portfolio__description">
          Explore a selection of my projects that showcase some of my 
          s spanning web design and development.
        </p>
      </div>
      <!-- Portfolio Grid (Where the template content will be injected) -->
      <div class="portfolio__grid"></div>
    </section>
    <section id="contact" class="contact">
      <div class="contact__container">
        <h2 class="contact__title">Contact <span class="text__highlight-secondary">Me</span></h2>
        <p class="contact__subtitle">
          Your Best Candidate for Web Development Projects
        </p>
        <!--<div class="contact__buttons">
          <a href="mailto:kerwindows@gmail.com" class="btn cta__btn--primary">
            <span>Email Me</span>
            <svg class="contact__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
              <path
                d="M12 12.713L.023 5.25C.01 5.167 0 5.083 0 5c0-.826.673-1.5 1.5-1.5h21c.827 0 1.5.674 1.5 1.5 0 .083-.01.167-.023.25L12 12.713zM24 6.348V19.5c0 .826-.673 1.5-1.5 1.5H1.5C.673 21 0 20.326 0 19.5V6.348l11.211 7.387c.452.298 1.126.297 1.576 0L24 6.348z" />
            </svg>
          </a>
          <a href="https://www.linkedin.com/in/kerwindows" class="btn cta__btn--secondary"
            target="_blank">
            <span>LinkedIn</span>
            <svg class="contact__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
              <path
                d="M22.23 0H1.77C.79 0 0 .79 0 1.77v20.46C0 23.21.79 24 1.77 24h20.46c.98 0 1.77-.79 1.77-1.77V1.77C24 .79 23.21 0 22.23 0zM7.08 20.45H3.56V9h3.52v11.45zm-1.76-12.9c-1.12 0-2.04-.91-2.04-2.03s.91-2.03 2.04-2.03c1.12 0 2.04.91 2.04 2.03s-.91 2.03-2.04 2.03zm15.19 12.9h-3.53v-5.56c0-1.33-.02-3.04-1.85-3.04-1.85 0-2.13 1.44-2.13 2.94v5.66H9.94V9h3.38v1.56h.05c.47-.88 1.6-1.8 3.28-1.8 3.51 0 4.16 2.31 4.16 5.31v6.37z" />
            </svg>
          </a>
        </div>-->
         <!-- Social Media Links -->
    <div class="contact__social-links">
      <a href="https://www.linkedin.com/in/kerwindows" target="_blank" aria-label="LinkedIn">
        <svg class="contact__linkedin-icon" width="24" height="24" fill="white" xmlns="http://www.w3.org/2000/svg">
          <path d="M4.98 3.5C4.98 5 4 6 3 6S1 5 1 3.5 2 1 3 1s1.98 1 1.98 2.5zM2 8h3v12H2V8zm6 0h2.88V9.8c.42-.6 1.2-1.38 2.88-1.38C16.76 8.42 18 10 18 13v7h-3V13c0-1-.58-2-2-2-1.4 0-2 .6-2 1.8V20H8V8z"></path>
        </svg>
      </a>
    </div>

    <!-- Quick Links -->
    <div class="contact__quick-links">
      <a href="#about">About Me</a>
      <a href="#portfolio">Projects</a>
      <a id="open-popup-2" href="#contact">Contact</a>
    </div>

    <!-- Copyright -->
    <p class="footer__copyright">
      © <?php echo date('Y') ?> Kerwin Marcus Thompson. All rights reserved.
    </p>
        <!-- Button to trigger the popup -->
        <button class="float__button" id="open-popup">
        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
  <path d="M4 4h16c1.1 0 2 .9 2 2v10c0 1.1-.9 2-2 2h-4l-4 4-4-4H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" 
        stroke="white" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
  <circle cx="8" cy="10" r="1" fill="white"/>
  <circle cx="12" cy="10" r="1" fill="white"/>
  <circle cx="16" cy="10" r="1" fill="white"/>
</svg>


        </button>
      </div>
    </section>
  </main>


  <!-- Modal Template (HTML) -->
  <div class="modal" id="portfolioModal">
    <div class="modal__overlay" onclick="closeModal()"></div>
    <div class="modal__content">
      <span class="modal__close" onclick="closeModal()">&times;</span>
      <div class="modal__details">
        <img src="" alt="" class="modal__image" />
        <h2 class="modal__title"></h2>
        <p class="modal__description"></p>
        <p class="modal__detail collapsed"></p>

        <!-- Down arrow icon for "show more" functionality -->
        <span class="modal__toggle" onclick="toggleDetails()">SHOW MORE <br /> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down" viewBox="0 0 24 24">
            <polyline points="6 9 12 15 18 9"></polyline>
          </svg></span>

        <a href="" class="btn cta__btn--primary modal__link" target="_blank">Visit Project</a>
      </div>
    </div>
  </div>


<div id="background-overlay"></div>
  <!-- Popup Container -->
<div class="float__popup-container" id="popup-container">
  <div class="float__popup-content">
    <span class="float__popup-close" id="close-popup">&times;</span>
    
    <form id="email-form" class="float__form">
    <h2 class="">Send a Message</h2>
      <div class="float__form-container">
        <input class="float__form-input" type="text" id="name" name="name" placeholder="Your Name" data-char-limit="50"  required>  
        <input class="float__form-input" type="email" id="email" name="email" placeholder="Your Contact Email" required>     
        <textarea class="float__form-textarea" id="message" name="message" placeholder="Your Message" data-char-limit="300" required></textarea>
      </div>
      <button id="submit-btn" class="float__form-button" type="submit">Send</button>
    <div id="status-message"></div>
    </form>
    
    <!-- Loading Animation and Success Message Container -->
    <div id="loading-animation" style="display: none;">
      <video id="success-video" autoplay loop muted playsinline style="width: 200px; height: 200px;">
        <source src="video/send-animation.mp4" type="video/mp4">
      </video>
      <p>Sending your message...</p>
    </div>    
    <div id="success-message" style="display: none;">
      <video id="success-video" autoplay  muted playsinline style="width: 200px; height: 200px;">
        <source src="video/successfully-send-animated-icon.mp4" type="video/mp4">
      </video>
      <p class="float__confirmation">Message sent successfully! </p>
      <p class="float__notice">You may close this window.</p>
    </div>
  </div>
</div>




  <!-- Template for Portfolio Item -->
  <template id="portfolio-item-template">
    <a class="portfolio__item" target="_blank">
      <img src="" alt="" class="portfolio__img" />
      <h4 class="portfolio__project-title"></h4>
      <div class="portfilio__icons"></div>
    </a>
  </template>
  <!--<script src="js/skills.js"></script>-->
  <script src="js/skills-scroll.js"></script>
  <script src="js/portfolio.js"></script>
  <script src="js/script.js"></script>
  <script src="js/email-form.js"></script>
</body>
</html>