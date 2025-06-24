<?php
// include(LINKWI_FUNCTIONS_PATH . '/custom.toasts.php');
require LINKWI_FUNCTIONS_PATH . '/setMsg.php';
function clients()
{
    $db = new dbase;
    $db->query("SELECT FirstName,LastName,Username,Job,ProfileImage FROM Users WHERE ProfileImage != 'default.png' AND UniqueID <> '11226' AND UniqueID <> '11226' ORDER BY rand() LIMIT 20");
    $get_clients = $db->fetchMultiple();
    $db->closeConnection();
    foreach ($get_clients as $clients) {
        print "<li class='work-item mix photography'>
                                <a target='_blank' href='".base_url_dir()."/card/{$clients["Username"]}'>
                                    <div class='work-img'>
                                        <div class='work-img-bg wow-p scalexIn'></div>
                                        <img src='".base_url_dir()."/linkwi/images/profile-images/{$clients["ProfileImage"]}' alt='Work Description' class='wow-p fadeIn' data-wow-delay='1s' />
                                    </div>
                                    <div class='work-intro'>
                                        <h3 class='work-title'>{$clients["FirstName"]} {$clients["LastName"]}</h3>
                                        <div class='work-descr'>
                                            {$clients["Job"]}
                                        </div>
                                    </div>
                                </a>
                            </li> ";
    } // end of for each
} // end of function
// contact form submit
if (!empty($_POST["submit"])) {
    // code for check server side validation
    if (empty($_SESSION['captcha_code']) || strcasecmp($_SESSION['captcha_code'], $_POST['captcha_code']) != 0) {
        set_error_msg("Captcha Does Not Match"); // Captcha verification is incorrect.		
    } else {                                                                         // Captcha verification is Correct. Final Code Execute here!		
        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];
        $db = new dbase;
        $db->query("INSERT INTO `contact_us` (`id`, `name`, `email`, `message`) VALUES ('', '$name', '$email', '$message')");
        if ($db->execute()) {
            set_msg("Awesome, You will receive and email from us soon");
            header("Refresh:0; url=#cntact_us");
            exit();
        }
    }
} //end of submit
?><!-- Change the value of lang="en" attribute if your website's language is not English.
You can find the code of your language here - https://www.w3schools.com/tags/ref_language_codes.asp -->
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Linkwi Digital Business Card ®</title>
    <meta
      name="description"
      content="Linkwi is an online business card solution that allows you to easily create and share your professional online presence. With Linkwi, you can create a customizable, interactive business card that includes your contact information, work history, and social media profiles. You can also add multimedia elements, such as photos, videos, and documents, to enhance your digital business card and showcase your skills and achievements. Whether you are a freelancer, small business owner, or corporate professional, Linkwi helps you connect with potential clients and partners in a modern and efficient way using NFC technology, QR Code scanning or Vcard download."
    />
    <meta charset="utf-8" />
    <meta name="Linkwi Digital Business Card ®" content="https://linkwi.co/" />
    <!--[if IE
      ]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"
    /><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta property="og:url" content="https://linkwi.co" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Linkwi Digital Business Card ®" />
    <meta
      property="og:description"
      content="Linkwi is an online business card solution that allows you to easily create and share your professional online presence. With Linkwi, you can create a customizable, interactive business card that includes your contact information, work history, and social media profiles. You can also add multimedia elements, such as photos, videos, and documents, to enhance your digital business card and showcase your skills and achievements. Whether you are a freelancer, small business owner, or corporate professional, Linkwi helps you connect with potential clients and partners in a modern and efficient way using NFC technology, QR Code scanning or Vcard download."
    />
    <meta
      property="og:image"
      content="https://linkwi.co/linkwi/images/frontpage-pics/frontpageimg.jpg"
    />
    <meta
      property="og:image:url"
      content="https://linkwi.co/linkwi/images/frontpage-pics/frontpageimg.jpg"
    />
    <meta property="og:image:width" content="715px" />
    <meta property="og:image:width" content="899px" />
    <meta
      property="twitter:image"
      content="https://linkwi.co/linkwi/images/frontpage-pics/frontpageimg.jpg"
    />
    <!-- Favicons -->
    <link rel="shortcut icon" href="images/favicon.ico" />
    <!-- CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/style-responsive.css" />
    <link rel="stylesheet" href="css/vertical-rhythm.min.css" />
    <link rel="stylesheet" href="css/magnific-popup.css" />
    <link rel="stylesheet" href="css/owl.carousel.css" />
    <link rel="stylesheet" href="css/animate.min.css" />
    <link rel="stylesheet" href="css/splitting.css" />
    <link rel="stylesheet" href="css/style.linkwi.frontpage.css" />
    <script type="text/javascript">
      function refreshCaptcha() {
        var img = document.images["captchaimg"];
        img.src =
          img.src.substring(0, img.src.lastIndexOf("?")) +
          "?rand=" +
          Math.random() * 1000;
      }
    </script>
    <style>
      .row {
        align-items: center;
      }

      .position-absolute {
        position: absolute !important;
      }

      .bottom-0 {
        bottom: 0 !important;
      }

      .mb-n4 {
        margin-bottom: -1.5rem !important;
      }

      .bg-dots {
        background-image: radial-gradient(currentColor 1px, transparent 1px);
        background-size: calc(10 * 1px) calc(10 * 1px);
      }

      .start-0 {
        left: 0 !important;
        right: auto !important;
      }

      .text-gray-400 {
        color: #c6d3e6 !important;
      }

      .card {
        min-height: 218px;
        z-index: 1;
        background: #fff;
        padding: 15px;
        box-shadow: 0 0 25px rgba(87, 79, 236, 0.1);
        border-radius: 1rem;
      }

      .services-icon,
      .services-icon svg {
        width: 0.6em;
        height: 0.6em;
      }

      .services-icon {
        margin: 0 0 18px 0;
      }

      .card-title {
        display: flex;
        gap: 20px;
        align-items: center;
      }

      .page-section {
        background: rgb(245, 244, 244);
      }

      .section#about {
        background: #fff;
      }

      .work-img {
        border-radius: 0.65rem;
      }
       .work-process-icon {
          margin-left: 0;
        }
        .work-process-title {
          text-align: left;
        }
        input#w_email{
            width: 98%;
    margin-right: 2%;
        }
         .section-title,.services-title {
          text-align: left;
        }
        .faq-image{
        border-radius:8px;
        }
      @media screen and (max-width: 991px) {
        .pricing-row.row {
          /* flex-wrap: nowrap; */
          /* overflow-x: auto; */
          padding-bottom: 60px;
        }
        .flex-directiobn-reverse.row {
          flex-direction: column-reverse;
        }       
       
        .work-item:last-child {
    display: none;
}
.faq-image {
    width: 100%;
}
      }
      .form input[type="text"].input-lg, .form input[type="email"].input-lg, .form input[type="number"].input-lg, .form input[type="url"].input-lg, .form input[type="search"].input-lg, .form input[type="tel"].input-lg, .form input[type="password"].input-lg, .form input[type="date"].input-lg, .form input[type="color"].input-lg, .form select.input-lg,.form input[type="text"].input-lg, .form input[type="email"].input-lg, .form input[type="number"].input-lg, .form input[type="url"].input-lg, .form input[type="search"].input-lg, .form input[type="tel"].input-lg, .form input[type="password"].input-lg, .form input[type="date"].input-lg, .form input[type="color"].input-lg, .form select.input-lg{
      border: 1px solid rgb(0 0 0 / 10%);
      border-radius:6px;
      }
      .btn-mod.btn-large{
      border-radius:6px;
      }
      /*countdown timer*/
    #countdown {
    font-family: Arial, sans-serif;
      text-align: center;
      color: #fdfdfd;
      font-size: 1.5rem;
      font-weight: bold;
      padding: 1rem 2rem;
      border-radius: 5px;
      display: inline-block;
    }
    .early-bird{
    border:1px dashed grey;
    padding:20px;
    border-radius:15px;
    }
    .gradient-text{
    background-image: linear-gradient(to left, #e0314f, #eb256f);
      -webkit-background-clip: text;
      color: transparent;
      display: inline;
      font-weight:600;
      }
      
      /* Center the video */
.video-frame {
    display: flex;
    justify-content: center;
    align-items: center;
    padding-top:15px;
    padding-bottom:15px;
    background-color: #f1f1f1; /* Change this to the desired background color for the frame */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Add a subtle shadow effect */
}

/* Add a border-radius for a rounded frame effect */
.video-frame video {
    border-radius: 10px;
}
.footer a:hover {
    color: #fdfdfd;
    text-decoration: none;
}
    </style>
  </head>

  <body class="appear-animate">
    <!-- Page Loader -->
    <!--<div class="page-loader">
        <div class="loader">Loading...</div>
    </div>-->
    <!-- End Page Loader -->
    <!-- Skip to Content -->
    <a href="#main" class="btn skip-to-content">Skip to Content</a>
    <!-- End Skip to Content -->
    <!-- Page Wrap -->
    <div class="page" id="top">
      <!-- Navigation panel -->
      <nav class="main-nav transparent stick-fixed wow-menubar">
        <div class="full-wrapper relative clearfix">
          <!-- Logo ( * your text or image into link tag *) -->
          <div class="nav-logo-wrap local-scroll">
            <a href="index.html" class="logo">              
              <img id='site-logo' style="display:none" src="linkwi/images/frontpage-pics/linkwi-og.webp" alt="Company logo" width="auto" height="37" />
              <h3 id='site-name' class="nav__logo-text mt-20">LinkWi</h3>
            </a>
          </div>
          <!-- Mobile Menu Button -->
          <div class="mobile-nav" role="button" tabindex="0">
            <i class="fa fa-bars"></i>
            <span class="sr-only">Menu</span>
          </div>
          <!-- Main Menu -->
          <div class="inner-nav desktop-nav">
            <ul class="clearlist scroll-nav local-scroll">
              <li class="active"><a href="#home">Home</a></li>
              <li><a href="#about">About</a></li>
              <li><a href="#service">Services</a></li>
              <li><a href="#contact">Contact Developer</a></li>
            </ul>
          </div>
          <!-- End Main Menu -->
        </div>
      </nav>
      <!-- End Navigation panel -->
      <main id="main">
        <!-- Home Section -->
        <section
          class="home-section bg-dark-alfa-70 parallax-5"
          data-background="https://linkwi.co/linkwi/images/frontpage-pics/frontpageimg.webp"
          id="home"
        >
          <div
            class="container min-height-100vh d-flex align-items-center pt-100 pb-100"
          >
            <!-- Hero Content -->
            <div class="home-content">
              <h1
                class="hs-line-3 mb-40 mb-xs-20 wow fadeInUpShort"
                data-wow-delay=".1s"
              >
                Making A Memorable Moment
              </h1>
              <h2
                class="hs-line-2 mb-70 mb-xs-40 wow fadeInUpShort"
                data-wow-delay=".2s"
              >
                Just A Tap Away
              </h2>
            </div>
            <!-- End Hero Content -->
            <!-- Scroll Down -->
            <div
              class="local-scroll scroll-down-wrap wow fadeInUpShort"
              data-wow-offset="0"
            >
              <a href="#question" class="scroll-down"
                ><i class="scroll-down-icon"></i
                ><span class="sr-only">Scroll to the next section</span></a
              >
            </div>
            <!-- End Scroll Down -->
          </div>
        </section>
        <!-- End Home Section -->
        <!-- Call Action Section -->

        


        <!-- Call Action Section -->
        <section id="question" style="background-image: linear-gradient(#ffffff, #f5f4f4);" class="page-section">
          <div class="container relative">
            <div class="flex-directiobn-reverse row">
              <!-- Images -->
              <div class="col-lg-7 mb-md-60 mb-xs-30">
                <div class="call-action-2-images">
                  <div class="call-action-2-image-2">
                    <img
                      src="./linkwi/images/frontpage-pics/my-awesome-business-card.webp"
                      alt=""
                      class="wow scaleOutIn"
                      data-wow-duration="1.2s"
                      data-wow-offset="134"
                    />
                  </div>
                </div>
              </div>
              <!-- End Images -->
              <!-- Text -->
              <div
                class="col-lg-5 wow fadeInUpShort"
                data-wow-duration="1.2s"
                data-wow-offset="255"
              >
                <h2 class="banner-heading gradient-text">Still Printing Paper Cards?</h2>
                <div class="banner-decription">
                  How many do you walk with in your wallet? Recent studies
                  reveal that a staggering 88% of paper cards are discarded
                  within just a week of being handed out! This not only reflects
                  the inefficiency of traditional business cards in making a
                  lasting impression but also results in a significant waste of
                  valuable resources. Imagine the time, effort, and money you
                  invest in designing and printing these cards, only to have
                  them end up in the trash.
                </div>
              </div>
              <!-- End Text -->
            </div>
          </div>
        </section>
        <!-- End Call Action Section -->

        <!-- Promo Section -->
        <section id="about" class="page-section">
          <div class="container relative">
            <div class="row promo__section">
              <!-- Text -->
              <div
                class="col-lg-6"
                data-wow-duration="1.2s"
                data-wow-offset="205"
              >
                <h3 class="banner-heading gradient-text">Introducing LinkWi</h3>
                <div class="banner-decription">
                  An All-In-One Social Networking Business Card Solution.
                  <ul>
                    <li>Modern and efficient networking tool.</li>
                    <li>Customizable, reusable and interactive.</li>
                    <li>Easily create & share your professional online presence.</li>
                    <li>
                      Ideal for freelancers, small business owners and corporate
                      professionals.
                    </li>
                    <li>
                      Connect with potential clients and partners using:
                      <ul>
                        <li>NFC technology</li>
                        <li>QR Code scanning</li>
                        <li>Vcard download</li>
                      </ul>
                    </li>
                    <li>Have all your relavant business information in one replace</li>
                  </ul>
                </div>
              </div>
              <!-- End Text -->
              <!-- Images -->
              <div class="col-lg-6 wow fadeInUpShort">
                <div
                  class="call-action-3-images mt-xs-0 text-end wow scaleOutIn"
                >
                  <div class="call-action-3-image-1">
                    <img
                      src=" ./linkwi/images/frontpage-pics/your-linkwi-card-front-back.webp"
                      alt="profile image"
                      data-wow-duration="1.2s"
                      data-wow-offset="205"
                    />
                  </div>
                  <div
                    class="call-action-3-image-2-wrap d-flex align-items-center"
                  >
                    <div class="call-action-3-image-2">
                      <img
                        src=""
                        alt=""
                        class="wow scaleOutIn"
                        data-wow-duration="1.2s"
                      />
                    </div>
                  </div>
                </div>
              </div>
              <!-- End Images -->
            </div>
          </div>
        </section>
        <!-- End Promo Section -->
        <section id="about" class="page-section">
          <div class="container relative">
            <div class="row promo__section">
            <div class="video-frame">
	        <video autoplay muted controls controlsList="nodownload">
	        <source src="https://linkwi.co/videos/video-demo.mp4" type="video/mp4">
	        <!-- Add additional <source> elements for different video formats (e.g., WebM, Ogg) -->
	        Your browser does not support the video tag.
	    </video>
	    </div>
        </div>
          </div>
        </section>
        

        <!-- Process Section -->
        <section style="background-image: linear-gradient(#f5f4f4,#ffffff);" class="page-section">
          <div class="container relative">
            <!-- Grid -->
            <div class="flex-directiobn-reverse row">
              <!-- Text Item -->
              <div class="col-lg-6 wow fadeInUpShort">
                <div
                  class="call-action-3-images mt-xs-0 text-end wow scaleOutIn"
                >
                  <div class="call-action-3-image-1">
                    <img
                      src="./linkwi/images/frontpage-pics/phone-screen.webp"
                      alt="profile image"
                      data-wow-duration="1.2s"
                      data-wow-offset="205"
                    />
                  </div>
                  <div
                    class="call-action-3-image-2-wrap d-flex align-items-center"
                  >
                    <div class="call-action-3-image-2">
                      <img
                        src=""
                        alt=""
                        class="wow scaleOutIn"
                        data-wow-duration="1.2s"
                      />
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-6">
                <!-- Item -->
                <div class="row">
                  <div class="col-12">
                    <h2 class="section-title gradient-text mb-50 mb-sm-20 ">
                      3 Simple Ways To Network
                    </h2>
                    <p class="section-title-descr">
                      With a tap, scan, or click, you may instantly share all your relavent information to connect with others. 
                    </p>
                  </div>
                  <div class="col-4">
                    <div class="work-process-item text-center pt-20">
                      <div class="work-process-icon">
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          class="icon icon-tabler icon-tabler-hand-click"
                          width="24"
                          height="24"
                          viewBox="0 0 24 24"
                          stroke-width="2"
                          stroke="currentColor"
                          fill="none"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                        >
                          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                          <path d="M8 13v-8.5a1.5 1.5 0 0 1 3 0v7.5" />
                          <path d="M11 11.5v-2a1.5 1.5 0 0 1 3 0v2.5" />
                          <path d="M14 10.5a1.5 1.5 0 0 1 3 0v1.5" />
                          <path
                            d="M17 11.5a1.5 1.5 0 0 1 3 0v4.5a6 6 0 0 1 -6 6h-2h.208a6 6 0 0 1 -5.012 -2.7l-.196 -.3c-.312 -.479 -1.407 -2.388 -3.286 -5.728a1.5 1.5 0 0 1 .536 -2.022a1.867 1.867 0 0 1 2.28 .28l1.47 1.47"
                          />
                          <path d="M5 3l-1 -1" />
                          <path d="M4 7h-1" />
                          <path d="M14 3l1 -1" />
                          <path d="M15 6h1" />
                        </svg>
                      </div>
                      <h3 class="work-process-title">1. Tap</h3>
                    </div>
                  </div>
                  <!-- End Item -->
                  <!-- Item -->
                  <div class="col-4">
                    <div class="work-process-item text-center pt-20">
                      <div class="work-process-icon">
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          width="16"
                          height="16"
                          fill="currentColor"
                          class="bi bi-qr-code-scan"
                          viewBox="0 0 16 16"
                        >
                          <path
                            d="M0 .5A.5.5 0 0 1 .5 0h3a.5.5 0 0 1 0 1H1v2.5a.5.5 0 0 1-1 0v-3Zm12 0a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0V1h-2.5a.5.5 0 0 1-.5-.5ZM.5 12a.5.5 0 0 1 .5.5V15h2.5a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5v-3a.5.5 0 0 1 .5-.5Zm15 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1 0-1H15v-2.5a.5.5 0 0 1 .5-.5ZM4 4h1v1H4V4Z"
                          />
                          <path d="M7 2H2v5h5V2ZM3 3h3v3H3V3Zm2 8H4v1h1v-1Z" />
                          <path
                            d="M7 9H2v5h5V9Zm-4 1h3v3H3v-3Zm8-6h1v1h-1V4Z"
                          />
                          <path
                            d="M9 2h5v5H9V2Zm1 1v3h3V3h-3ZM8 8v2h1v1H8v1h2v-2h1v2h1v-1h2v-1h-3V8H8Zm2 2H9V9h1v1Zm4 2h-1v1h-2v1h3v-2Zm-4 2v-1H8v1h2Z"
                          />
                          <path d="M12 9h2V8h-2v1Z" />
                        </svg>
                      </div>
                      <h3 class="work-process-title">2. Scan</h3>
                    </div>
                  </div>
                  <!-- End Item -->
                  <!-- Item -->
                  <div class="col-4">
                    <div class="work-process-item text-center pt-20">
                      <div class="work-process-icon">
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          width="16"
                          height="16"
                          fill="currentColor"
                          class="bi bi-share-fill"
                          viewBox="0 0 16 16"
                        >
                          <path
                            d="M11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.499 2.499 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5z"
                          />
                        </svg>
                      </div>
                      <h3 class="work-process-title">3. Share</h3>
                    </div>
                  </div>
                  <!-- End Item -->
                </div>
              </div>
            </div>
            <!-- End Grid -->
          </div>
        </section>
        <!-- End Process Section -->
        <!-- Promo Section -->
        <section style="background:#fff" class="page-section">
          <div class="container relative">
            <div class="row promo__section">
              <!-- Text -->
              <div
                class="col-lg-6 wow fadeInUpShort"
                data-wow-duration="1.2s"
                data-wow-offset="205"
              >
                <div class="row">
                  <div class="col-lg-10">
                    <h2 class="section-title gradient-text mb-60 mb-sm-30">
                      Customizable Profile
                    </h2>
                  </div>
                </div>
                <!-- Features Grid -->
                <div class="row alt-features-grid">
                  <!-- Features Item -->
                  <div class="col-6">
                    <div class="alt-features-item">
                      <div class="alt-features-icon">
                        <svg
                          width="24"
                          height="24"
                          viewBox="0 0 24 24"
                          fill="currentColor"
                          aria-hidden="true"
                          focusable="false"
                          xmlns="http://www.w3.org/2000/svg"
                          fill-rule="evenodd"
                          clip-rule="evenodd"
                        >
                          <path
                            d="M21.62 20.196c1.055-.922 1.737-2.262 1.737-3.772 0-1.321-.521-2.515-1.357-3.412v-6.946l-11.001-6.066-11 6v12.131l11 5.869 5.468-2.917c.578.231 1.205.367 1.865.367.903 0 1.739-.258 2.471-.676l2.394 3.226.803-.596-2.38-3.208zm-11.121 2.404l-9.5-5.069v-10.447l9.5 4.946v10.57zm1-.001v-10.567l5.067-2.608.029.015.021-.04 4.384-2.256v5.039c-.774-.488-1.686-.782-2.668-.782-2.773 0-5.024 2.252-5.024 5.024 0 1.686.838 3.171 2.113 4.083l-3.922 2.092zm6.833-2.149c-2.219 0-4.024-1.808-4.024-4.026s1.805-4.025 4.024-4.025c2.22 0 4.025 1.807 4.025 4.025 0 2.218-1.805 4.026-4.025 4.026zm-.364-3.333l-1.306-1.147-.66.751 2.029 1.782 2.966-3.12-.725-.689-2.304 2.423zm-16.371-10.85l4.349-2.372 9.534 4.964-4.479 2.305-9.404-4.897zm9.4-5.127l9.404 5.186-3.832 1.972-9.565-4.98 3.993-2.178z"
                          />
                        </svg>
                      </div>
                      <h3 class="alt-features-title">Unique Design</h3>
                      <div class="alt-features-descr"></div>
                    </div>
                  </div>
                  <!-- End Features Item -->
                  <!-- Features Item -->
                  <div class="col-6">
                    <div class="alt-features-item">
                      <div class="alt-features-icon">
                        <svg
                          width="24"
                          height="24"
                          viewBox="0 0 24 24"
                          fill="currentColor"
                          aria-hidden="true"
                          focusable="false"
                          xmlns="http://www.w3.org/2000/svg"
                          fill-rule="evenodd"
                          clip-rule="evenodd"
                        >
                          <path
                            d="M12 0c-3.371 2.866-5.484 3-9 3v11.535c0 4.603 3.203 5.804 9 9.465 5.797-3.661 9-4.862 9-9.465v-11.535c-3.516 0-5.629-.134-9-3zm0 1.292c2.942 2.31 5.12 2.655 8 2.701v10.542c0 3.891-2.638 4.943-8 8.284-5.375-3.35-8-4.414-8-8.284v-10.542c2.88-.046 5.058-.391 8-2.701zm5 7.739l-5.992 6.623-3.672-3.931.701-.683 3.008 3.184 5.227-5.878.728.685z"
                          />
                        </svg>
                      </div>
                      <h3 class="alt-features-title">NFC ready</h3>
                      <div class="alt-features-descr"></div>
                    </div>
                  </div>
                  <!-- End Features Item -->
                  <!-- Features Item -->
                  <div class="col-6">
                    <div class="alt-features-item">
                      <div class="alt-features-icon">
                        <svg
                          width="24"
                          height="24"
                          viewBox="0 0 24 24"
                          fill="currentColor"
                          aria-hidden="true"
                          focusable="false"
                          xmlns="http://www.w3.org/2000/svg"
                          fill-rule="evenodd"
                          clip-rule="evenodd"
                        >
                          <path
                            d="M6.514 24.015h-3v-3.39c-2.08-.638-3.5-2.652-3.5-5.04 0-1.19.202-1.693 1.774-5.603.521-1.294 1.195-2.97 2.068-5.179.204-.518.67-.806 1.17-.802.482.004.941.284 1.146.802.718 1.817 1.302 3.274 1.777 4.454.26-.596.567-1.288.928-2.103.694-1.565 1.591-3.592 2.754-6.265.258-.592.881-.906 1.397-.888.572.015 1.126.329 1.369.888 1.163 2.673 2.06 4.7 2.754 6.265 2.094 4.727 2.363 5.334 2.363 6.764 0 2.927-2.078 5.422-5 6.082v4.015h-3v-4.015c-.943-.213-1.797-.617-2.523-1.165-.612.845-1.466 1.48-2.477 1.79v3.39zm14.493-6c1.652 0 2.993 1.341 2.993 2.993s-1.341 2.993-2.993 2.993-2.993-1.341-2.993-2.993 1.341-2.993 2.993-2.993zm.007.993c1.104 0 2 .896 2 2s-.896 2-2 2-2-.896-2-2 .896-2 2-2zm-7.5 3.993v-3.839c4.906-.786 5-4.751 5-5.244 0-1.218-.216-1.705-2.277-6.359-2.134-4.82-2.721-6.198-2.755-6.261-.079-.145-.193-.292-.455-.297-.238 0-.37.092-.481.297-.034.063-.621 1.441-2.755 6.261-2.061 4.654-2.277 5.141-2.277 6.359 0 .493.094 4.458 5 5.244v3.839h1zm-6.123-12.448l-.08-.198c-1.589-3.957-2.04-5.116-2.067-5.171-.072-.151-.15-.226-.226-.228-.109 0-.188.13-.235.228-.028.05-.316.818-2.066 5.171-1.542 3.833-1.703 4.233-1.703 5.23 0 1.988 1.076 3.728 3.5 4.25v3.166h1v-3.166c1.266-.273 2.159-.876 2.725-1.666-1.078-1.12-1.725-2.619-1.725-4.251 0-.979.126-1.572.877-3.365z"
                          />
                        </svg>
                      </div>
                      <h3 class="alt-features-title">Clean and Minimal</h3>
                      <div class="alt-features-descr"></div>
                    </div>
                  </div>
                  <!-- End Features Item -->
                  <!-- Features Item -->
                  <div class="col-6">
                    <div class="alt-features-item">
                      <div class="alt-features-icon">
                        <svg
                          width="24"
                          height="24"
                          viewBox="0 0 24 24"
                          fill="currentColor"
                          aria-hidden="true"
                          focusable="false"
                          xmlns="http://www.w3.org/2000/svg"
                          fill-rule="evenodd"
                          clip-rule="evenodd"
                        >
                          <path
                            d="M16 3.383l-.924-.383-7.297 17.617.924.383 7.297-17.617zm.287 3.617l6.153 4.825-6.173 5.175.678.737 7.055-5.912-7.048-5.578-.665.753zm-8.478 0l-6.249 4.825 6.003 5.175-.679.737-6.884-5.912 7.144-5.578.665.753z"
                          />
                        </svg>
                      </div>
                      <h3 class="alt-features-title">Easy Customization</h3>
                      <div class="alt-features-descr"></div>
                    </div>
                  </div>
                  <!-- End Features Item -->
                </div>
                <!-- End Features Grid -->
              </div>
              <!-- End Text -->
              <!-- Images -->
              <div class="col-lg-6">
                <div
                  class="call-action-3-images mt-xs-0 text-end wow scaleOutIn"
                >
                  <div class="call-action-3-image-1">
                    <img
                      src="images/linkwi/image3.png"
                      alt="profile image"
                      data-wow-duration="1.2s"
                      data-wow-offset="205"
                    />
                  </div>
                  <div
                    class="call-action-3-image-2-wrap d-flex align-items-center"
                  >
                    <div class="call-action-3-image-2">
                      <img
                        src="images/linkwi/"
                        alt=""
                        class="wow scaleOutIn"
                        data-wow-duration="1.2s"
                      />
                    </div>
                  </div>
                </div>
              </div>
              <!-- End Images -->
            </div>
          </div>
        </section>
        <!-- End Promo Section -->

        <!-- Call Action Section -->
        <section style="background-image: linear-gradient(#ffffff,#f5f4f4);" class="page-section">
          <div class="container relative">
            <div class="flex-directiobn-reverse row">
              <!-- Images -->
              <div class="col-lg-7 mb-md-60 mb-xs-30">
                <div class="call-action-2-images">
                  <div class="call-action-2-image-2">
                    <img
                      src="images/linkwi/image5.png"
                      alt=""
                      class="wow scaleOutIn"
                      data-wow-duration="1.2s"
                      data-wow-offset="134"
                    />
                  </div>
                </div>
              </div>
              <!-- End Images -->
              <!-- Text -->
              <div
                class="col-lg-5 wow fadeInUpShort"
                data-wow-duration="1.2s"
                data-wow-offset="255"
              >
                <h2 class="section-title gradient-text mb-50 mb-sm-20">
                  Analyze Your Engagment
                </h2>
                <!-- Features Item -->
                <!-- Grid -->
                <div class="row">
                  <div class="col-6">
                    <div class="alt-features-item">
                      <div class="alt-features-icon">
                        <svg
                          fill="#000000"
                          width="800px"
                          height="800px"
                          viewBox="0 -0.08 20 20"
                          data-name="Capa 1"
                          id="Capa_1"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            d="M10.28,10.89l.88-1.36a.33.33,0,0,0,0-.33.29.29,0,0,0-.29-.14c-1.75.14-3.1.27-3.1.27a.3.3,0,0,0-.23.13.32.32,0,0,0,0,.27l1,2.95a.29.29,0,0,0,.25.21h0a.29.29,0,0,0,.25-.14l.88-1.35L12,12.77a.37.37,0,0,0,.17.05.31.31,0,0,0,.26-.14.31.31,0,0,0-.09-.42Zm-1.38,1-.68-2,2.09-.18Z"
                          />
                          <path
                            d="M15.69,4.31H4.31A1.61,1.61,0,0,0,2.7,5.92v8a1.61,1.61,0,0,0,1.61,1.61H15.69a1.61,1.61,0,0,0,1.61-1.61v-8A1.61,1.61,0,0,0,15.69,4.31ZM4.31,4.92H15.69a1,1,0,0,1,1,1v.72H3.31V5.92A1,1,0,0,1,4.31,4.92Zm11.38,10H4.31a1,1,0,0,1-1-1V7.25H16.69v6.67A1,1,0,0,1,15.69,14.92Z"
                          />
                          <path
                            d="M4.31,6.18A.34.34,0,1,0,4,5.85.34.34,0,0,0,4.31,6.18Z"
                          />
                          <path
                            d="M5.16,6.18a.34.34,0,0,0,0-.67.34.34,0,0,0,0,.67Z"
                          />
                          <path
                            d="M6,6.18a.34.34,0,1,0-.33-.33A.34.34,0,0,0,6,6.18Z"
                          />
                        </svg>
                      </div>
                      <h3 class="alt-features-title">
                        User-Friendly Dashboard
                      </h3>
                    </div>
                  </div>
                  <!-- End Features Item -->
                  <!-- Features Item -->
                  <div class="col-6">
                    <div class="alt-features-item">
                      <div class="alt-features-icon">
                        <svg
                          fill="#000000"
                          version="1.0"
                          id="Layer_1"
                          xmlns="http://www.w3.org/2000/svg"
                          xmlns:xlink="http://www.w3.org/1999/xlink"
                          width="800px"
                          height="800px"
                          viewBox="0 0 64 64"
                          enable-background="new 0 0 64 64"
                          xml:space="preserve"
                        >
                          <g>
                            <path
                              d="M34,31h29c0.553,0,1-0.447,1-1C64,13.432,50.568,0,34,0c-0.553,0-1,0.447-1,1v29C33,30.553,33.447,31,34,31z M35,2.025 C49.667,2.541,61.459,14.332,61.975,29H35V2.025z"
                            />
                            <path
                              d="M63,33H36c-0.044,0-0.082,0.019-0.125,0.024c-0.084,0.011-0.168,0.019-0.248,0.05c-0.078,0.031-0.143,0.084-0.209,0.133 c-0.036,0.027-0.079,0.041-0.112,0.072c-0.002,0.002-0.003,0.006-0.005,0.008c-0.086,0.084-0.152,0.185-0.203,0.295 c-0.004,0.009-0.014,0.016-0.018,0.025c-0.016,0.038-0.015,0.084-0.026,0.125c-0.023,0.084-0.051,0.169-0.052,0.256L35,34 c0,0.053,0.022,0.1,0.031,0.152c0.012,0.074,0.016,0.148,0.044,0.219c0.035,0.088,0.092,0.16,0.149,0.233 c0.021,0.028,0.031,0.063,0.057,0.089l0.01,0.01c0.001,0.002,0.002,0.003,0.004,0.004l18.742,19.409 c0.074,0.077,0.164,0.126,0.254,0.175l0.922,0.922C60.643,49.784,64,42.284,64,34l0,0C64,33.447,63.553,33,63,33z M55.126,52.365 L38.356,35h23.618C61.741,41.637,59.2,47.683,55.126,52.365z"
                            />
                            <path
                              d="M49.827,53.795c0,0-17.231-18.523-18.212-19.504C31.012,33.688,31,32.605,31,32.605V5c0-0.553-0.447-1-1-1 C13.432,4,0,17.432,0,34s13.432,30,30,30c8.284,0,15.784-3.357,21.213-8.787l-1.335-1.335 C49.858,53.852,49.851,53.82,49.827,53.795z M30,62C14.536,62,2,49.464,2,34C2,18.871,14,6.553,29,6.025c0,0,0,26.068,0,26.975 s0.343,1.81,1.016,2.482s18.332,19.658,18.332,19.658C43.434,59.41,37.021,62,30,62z"
                            />
                          </g>
                        </svg>
                      </div>
                      <h3 class="alt-features-title">Statistical Charts</h3>
                      <div class="alt-features-descr"></div>
                    </div>
                  </div>
                  <!-- End Features Item -->
                  <!-- Features Item -->
                  <div class="col-6">
                    <div class="alt-features-item">
                      <div class="alt-features-icon">
                        <svg
                          version="1.0"
                          id="Layer_1"
                          xmlns="http://www.w3.org/2000/svg"
                          xmlns:xlink="http://www.w3.org/1999/xlink"
                          width="800px"
                          height="800px"
                          viewBox="0 0 64 64"
                          enable-background="new 0 0 64 64"
                          xml:space="preserve"
                        >
                          <g>
                            <path
                              fill="#231F20"
                              d="M32,0C14.355,0,0,14.355,0,32s14.355,32,32,32s32-14.355,32-32S49.645,0,32,0z M32,62 C15.458,62,2,48.542,2,32S15.458,2,32,2s30,13.458,30,30S48.542,62,32,62z"
                            />
                            <path
                              fill="#231F20"
                              d="M34.996,28.021L35,28.008V17c0-1.654-1.346-3-3-3s-3,1.346-3,3v11l0.004,0.021 C27.795,28.936,27,30.371,27,32c0,2.757,2.243,5,5,5s5-2.243,5-5C37,30.371,36.205,28.936,34.996,28.021z M31,17 c0-0.552,0.448-1,1-1s1,0.448,1,1v10.102C32.677,27.035,32.343,27,32,27s-0.677,0.035-1,0.102V17z M32,35c-1.654,0-3-1.346-3-3 s1.346-3,3-3s3,1.346,3,3S33.654,35,32,35z"
                            />
                            <path
                              fill="#231F20"
                              d="M32.03,31H32.02c-0.552,0-0.994,0.447-0.994,1s0.452,1,1.005,1c0.552,0,1-0.447,1-1S32.582,31,32.03,31z"
                            />
                            <path
                              fill="#231F20"
                              d="M32,4C16.561,4,4,16.561,4,32c0,4.738,1.19,9.201,3.277,13.116c0.314,0.59,0.646,1.169,1.001,1.733 l6.035-3.485c0.479-0.275,0.642-0.886,0.366-1.364c-0.276-0.479-0.887-0.644-1.367-0.366l-4.301,2.483v-0.001 c-0.744-1.405-1.36-2.887-1.841-4.429l1.904-0.51c0.535-0.145,0.852-0.688,0.707-1.225c-0.143-0.533-0.691-0.85-1.225-0.707 l-1.9,0.509c-0.351-1.538-0.563-3.127-0.626-4.756H11c0.554,0,0.999-0.447,1-0.999c0-0.554-0.446-1.001-1.001-1.001H6.025 c0.062-1.628,0.275-3.218,0.625-4.756l1.907,0.511c0.535,0.143,1.082-0.17,1.225-0.707c0.144-0.532-0.174-1.081-0.707-1.225 L7.161,24.31c0.479-1.544,1.103-3.023,1.847-4.431l4.307,2.486c0.479,0.276,1.088,0.112,1.365-0.365 c0.276-0.479,0.113-1.09-0.367-1.367l-4.301-2.482c0.857-1.357,1.835-2.63,2.921-3.803l1.389,1.389 c0.393,0.391,1.022,0.393,1.414,0c0.391-0.39,0.391-1.023,0-1.414l-1.389-1.389c1.173-1.087,2.447-2.064,3.805-2.923l2.483,4.303 c0.276,0.479,0.887,0.641,1.365,0.366c0.479-0.277,0.643-0.888,0.365-1.368L19.88,9.008c1.406-0.744,2.886-1.367,4.429-1.846 l0.513,1.914c0.145,0.534,0.689,0.852,1.225,0.707c0.533-0.143,0.851-0.69,0.707-1.225L26.242,6.65 c1.539-0.35,3.13-0.563,4.759-0.625L31,11.001c0,0.552,0.448,0.998,1,0.999c0.553-0.001,1-0.447,1-1.002V6.025 c1.628,0.062,3.218,0.275,4.757,0.625l-0.512,1.908c-0.143,0.534,0.172,1.082,0.707,1.225c0.533,0.144,1.082-0.173,1.225-0.707 l0.513-1.915c1.544,0.479,3.024,1.103,4.432,1.847l-2.488,4.307c-0.275,0.478-0.11,1.089,0.367,1.364 c0.479,0.276,1.09,0.113,1.367-0.367l2.482-4.3c1.357,0.857,2.631,1.835,3.803,2.922l-1.39,1.389c-0.391,0.391-0.392,1.023,0,1.414 c0.391,0.391,1.023,0.391,1.414,0l1.39-1.389c1.087,1.173,2.064,2.445,2.922,3.803l-4.304,2.483 c-0.478,0.276-0.64,0.889-0.364,1.365c0.276,0.479,0.888,0.643,1.368,0.365l4.304-2.484c0.744,1.406,1.367,2.886,1.847,4.43 l-1.916,0.513c-0.533,0.144-0.851,0.69-0.707,1.225c0.143,0.533,0.691,0.851,1.225,0.707l1.909-0.512 c0.35,1.54,0.563,3.129,0.625,4.758H53c-0.553,0-1,0.447-1,1s0.447,1,1,1h4.969c-0.062,1.629-0.275,3.218-0.626,4.756l-1.902-0.51 c-0.535-0.141-1.079,0.171-1.225,0.707c-0.143,0.534,0.178,1.082,0.707,1.225l1.906,0.511c-0.48,1.541-1.097,3.023-1.842,4.429 l-4.301-2.483c-0.479-0.276-1.09-0.112-1.366,0.366s-0.113,1.089,0.366,1.366l6.035,3.484c0.354-0.563,0.686-1.143,1-1.732 C58.81,41.202,60,36.739,60,32C60,16.561,47.439,4,32,4z"
                            />
                          </g>
                        </svg>
                      </div>
                      <h3 class="alt-features-title">Perfomance Monitor</h3>
                      <div class="alt-features-descr"></div>
                    </div>
                  </div>
                  <!-- End Features Item -->
                  <div class="col-6">
                    <div class="alt-features-item">
                      <div class="alt-features-icon">
                        <svg
                          fill="#000000"
                          height="800px"
                          width="800px"
                          version="1.1"
                          id="Layer_1"
                          xmlns="http://www.w3.org/2000/svg"
                          xmlns:xlink="http://www.w3.org/1999/xlink"
                          viewBox="0 0 512 512"
                          xml:space="preserve"
                        >
                          <g>
                            <g>
                              <path
                                d="M502.217,455L377.524,330.308l98.334-32.78c6.815-2.272,11.413-8.652,11.413-15.838c0-7.186-4.598-13.566-11.413-15.837
			l-283.326-94.446c-5.989-2.011-12.609-0.456-17.087,4.033c-4.478,4.473-6.033,11.087-4.033,17.082l94.446,283.337
			c2.272,6.821,8.652,11.419,15.838,11.419c7.186,0,13.566-4.598,15.837-11.419l32.775-98.334l124.693,124.693
			c6.52,6.521,15.064,9.783,23.608,9.783s17.087-3.261,23.609-9.783C515.261,489.179,515.261,468.038,502.217,455z"
                              />
                            </g>
                          </g>
                          <g>
                            <g>
                              <path
                                d="M66.783,66.783v100.174h74.748c2.462-5.52,5.855-10.685,10.318-15.142c9.424-9.44,22-14.663,35.391-14.663
			c5.424,0,10.783,0.875,15.924,2.603l81.602,27.202h160.452V66.783H66.783z"
                              />
                            </g>
                          </g>
                          <g>
                            <g>
                              <path
                                d="M461.913,0H50.087C22.468,0,0,22.468,0,50.087v133.565c0,27.619,22.468,50.087,50.087,50.087h99.871l-10.219-30.658
			c-0.302-0.904-0.456-1.823-0.707-2.734H50.087c-9.206,0-16.696-7.49-16.696-16.696V50.087c0-9.206,7.49-16.696,16.696-16.696
			h411.826c9.206,0,16.696,7.49,16.696,16.696v133.565c0,9.206-7.49,16.696-16.696,16.696h-76.976l92.259,30.755
			c20.117-6.506,34.804-25.194,34.804-47.45V50.087C512,22.468,489.532,0,461.913,0z"
                              />
                            </g>
                          </g>
                        </svg>
                      </div>
                      <h3 class="alt-features-title">Geolocation Tracking</h3>
                      <div class="alt-features-descr"></div>
                    </div>
                  </div>
                  <!-- End Features Item -->
                  <div class="col-6">
                    <div class="alt-features-item">
                      <div class="alt-features-icon">
                        <svg
                          width="800px"
                          height="800px"
                          viewBox="-0.5 0 25 25"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            d="M7.05005 15.81L10.6201 12.11C10.8201 11.9 11.1501 11.91 11.3401 12.12L12.14 12.98C12.34 13.19 12.6701 13.19 12.8701 12.98L14.94 10.81"
                            stroke="#0F0F0F"
                            stroke-miterlimit="10"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                          />
                          <path
                            d="M16.88 12.86L16.95 9.41C16.95 9.1 16.7001 8.84 16.4001 8.84L12.9301 8.86"
                            stroke="#0F0F0F"
                            stroke-miterlimit="10"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                          />
                          <path
                            d="M12 22C17.2467 22 21.5 17.7467 21.5 12.5C21.5 7.25329 17.2467 3 12 3C6.75329 3 2.5 7.25329 2.5 12.5C2.5 17.7467 6.75329 22 12 22Z"
                            stroke="#0F0F0F"
                            stroke-miterlimit="10"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                          />
                        </svg>
                      </div>
                      <h3 class="alt-features-title">Lead Tracking</h3>
                      <div class="alt-features-descr"></div>
                    </div>
                  </div>
                  <!-- End Features Item -->
                  <div class="col-6">
                    <div class="alt-features-item">
                      <div class="alt-features-icon">
                        <svg
                          width="800px"
                          height="800px"
                          viewBox="0 0 512 512"
                          version="1.1"
                          xmlns="http://www.w3.org/2000/svg"
                          xmlns:xlink="http://www.w3.org/1999/xlink"
                        >
                          <title>filter-outline</title>
                          <g
                            id="Page-1"
                            stroke="none"
                            stroke-width="1"
                            fill="none"
                            fill-rule="evenodd"
                          >
                            <g
                              id="filter"
                              fill="#000000"
                              transform="translate(42.666667, 85.333333)"
                            >
                              <path
                                d="M3.55271368e-14,1.42108547e-14 L191.565013,234.666667 L192,234.666667 L192,384 L234.666667,384 L234.666667,234.666667 L426.666667,1.42108547e-14 L3.55271368e-14,1.42108547e-14 Z M214.448,192 L211.81248,192 L89.9076267,42.6666667 L336.630187,42.6666667 L214.448,192 Z"
                                id="Shape"
                              ></path>
                            </g>
                          </g>
                        </svg>
                      </div>
                      <h3 class="alt-features-title">Durational Filtering</h3>
                      <div class="alt-features-descr"></div>
                    </div>
                  </div>
                  <!-- End Features Item -->
                </div>
                <!--<div class="mb-sm-50 mb-xs-30 wow linesAnimIn" data-splitting="lines">
<p>With our comprehensive dashboard, you'll have access to , all displayed on beautifully designed charts. Our platform enables you to monitor your performance over time with monthly and yearly stats. </p> <p>No more sifting through spreadsheets or trying to make sense of confusing data. Our intuitive and user-friendly dashboard presents your social media statistics in a clear and concise way, making it easier than ever to track your progress and make informed decisions about your marketing strategy.</p><p>Take your business to the next level with Linkwi Business Dashboard. Sign up now and start tracking your way to success today.</p>
                            </div>-->
              </div>
              <!-- End Text -->
            </div>
          </div>
        </section>
        <!-- End Call Action Section -->
        <!-- Services Section -->
        <section class="page-section" id="service">
          <div class="container relative">
            <div class="text-center mb-80 mb-sm-50">
              <h2 class="section-title gradient-text">Discover the Joy of Networking with Ease</h2>
            </div>
            <!-- Services Grid -->
            <div class="row services-grid">
              <!-- Services Item -->
              <div class="col-sm-12 col-md-6 col-lg-4 relative">
                <div
                  class="card services-item text-center wow fadeIn"
                  data-wow-delay="0"
                  data-wow-duration="1.5s"
                >
                  <div class="card-title">
                    <div class="services-icon">
                      <svg
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="currentColor"
                        aria-hidden="true"
                        focusable="false"
                        xmlns="http://www.w3.org/2000/svg"
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                      >
                        <path
                          d="M13.5 20c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm-10.551 4c-.598 0-2.429-1.754-2.747-4.304-.424-3.414 2.124-5.593 4.413-5.87.587-1.895 2.475-4.684 6.434-4.77.758-1.982 3.409-4.507 6.84-3.186 1.647.634 3.101 2.101 3.705 3.737.231.624-.71.965-.937.347-.51-1.378-1.737-2.615-3.127-3.151-2.577-.99-4.695.731-5.422 2.298 1.107.12 2.092.455 2.755.889.909.594 1.473 1.558 1.508 2.577.031.889-.33 1.687-.991 2.187-.654.496-1.492.643-2.298.404-.966-.286-1.748-1.076-2.143-2.169-.287-.793-.384-1.847-.178-2.921-3.064.185-4.537 2.306-5.075 3.742 1.18.102 2.211.574 2.831 1.012.959.676 1.497 1.6 1.513 2.599.015.859-.363 1.664-1.011 2.155-.608.46-1.535.599-2.363.348-.961-.289-1.7-1.041-2.079-2.118-.255-.723-.375-1.776-.204-2.919-1.631.361-3.512 1.995-3.178 4.685.18 1.448 1.008 2.888 2.015 3.502.43.261.242.926-.261.926zm10.551-1c-.552 0-1-.448-1-1s.448-1 1-1 1 .448 1 1-.448 1-1 1zm8.011-6.801l2.489.459-1.744 1.833.333 2.509-2.283-1.092-2.283 1.092.333-2.509-1.744-1.833 2.489-.459 1.205-2.225 1.205 2.225zm-1.759.897l-1.143.21.801.843-.153 1.152 1.049-.501 1.049.501-.153-1.152.801-.843-1.143-.21-.554-1.022-.554 1.022zm-14.345-2.3c-.202 1.024-.128 1.993.113 2.678.347.984.966 1.355 1.424 1.492.604.183 1.175.036 1.472-.187.388-.294.624-.808.614-1.34-.011-.673-.398-1.313-1.09-1.801-.545-.385-1.479-.803-2.533-.842zm6.373-4.716c-.226 1.018-.11 1.99.099 2.569.287.79.828 1.356 1.486 1.55.501.148 1.014.06 1.411-.242.398-.301.615-.795.596-1.355-.025-.705-.409-1.353-1.056-1.775-.511-.334-1.448-.657-2.536-.747zm-5.812-7.369l3.032.558-2.124 2.234.405 3.057-2.781-1.331-2.781 1.331.405-3.057-2.124-2.234 3.032-.558 1.468-2.711 1.468 2.711zm-2.285.897l-1.686.31 1.182 1.243-.226 1.7 1.547-.74 1.547.74-.226-1.7 1.182-1.243-1.686-.31-.817-1.508-.817 1.508zm17.817-3.608c-1.38 0-2.5 1.12-2.5 2.5s1.12 2.5 2.5 2.5 2.5-1.12 2.5-2.5-1.12-2.5-2.5-2.5zm0 4c-.828 0-1.5-.672-1.5-1.5s.672-1.5 1.5-1.5 1.5.672 1.5 1.5-.672 1.5-1.5 1.5z"
                        />
                      </svg>
                    </div>
                    <h3 class="services-title">Embrace Flexibility</h3>
                  </div>
                  <div class="services-descr align-left">
                    Instantly share your contact details through NFC, QR codes, or Vcard downloads, paving the way for seamless real-time information exchange.
                  </div>
                  <div class="services-more"></div>
                </div>
                <div
                  class="bg-dots text-gray-400 position-absolute bottom-0 start-0 mb-n4 z-index-0"
                  style="width: 150px; height: 150px"
                ></div>
              </div>
              <!-- End Services Item -->
              <!-- Services Item -->
              <div class="col-sm-12 col-md-6 col-lg-4 relative">
                <div
                  class="card services-item text-center wow fadeIn"
                  data-wow-delay=".1s"
                  data-wow-duration="1.5s"
                >
                  <div class="card-title">
                    <div class="services-icon">
                      <svg
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="currentColor"
                        aria-hidden="true"
                        focusable="false"
                        xmlns="http://www.w3.org/2000/svg"
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                      >
                        <path
                          d="M5 22h4v-3h-9v-18h24v18h-10v3h4v1h-13v-1zm5-3v3h3v-3h-3zm13-17h-22v16h22v-16z"
                        />
                      </svg>
                    </div>
                    <h3 class="services-title">Cost-Effective Networking</h3>
                  </div>
                  <div class="services-descr align-left">
                    Say goodbye to repetitive business card purchases. Effortlessly update your information in a matter of seconds, saving both time and money.
                  </div>
                  <div class="services-more"></div>
                </div>
                <div
                  class="bg-dots text-gray-400 position-absolute bottom-0 start-0 mb-n4 z-index-0"
                  style="width: 150px; height: 150px"
                ></div>
              </div>
              <!-- End Services Item -->
              <!-- Services Item -->
              <div class="col-sm-12 col-md-6 col-lg-4 relative">
                <div
                  class="card services-item text-center wow fadeIn"
                  data-wow-delay=".2s"
                  data-wow-duration="1.5s"
                >
                  <div class="card-title">
                    <div class="services-icon">
                      <svg
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="currentColor"
                        aria-hidden="true"
                        focusable="false"
                        xmlns="http://www.w3.org/2000/svg"
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                      >
                        <path
                          d="M10,6.978c-1.666,0-3.022,1.356-3.022,3.022S8.334,13.022,10,13.022s3.022-1.356,3.022-3.022S11.666,6.978,10,6.978M10,12.267c-1.25,0-2.267-1.017-2.267-2.267c0-1.25,1.016-2.267,2.267-2.267c1.251,0,2.267,1.016,2.267,2.267C12.267,11.25,11.251,12.267,10,12.267 M18.391,9.733l-1.624-1.639C14.966,6.279,12.563,5.278,10,5.278S5.034,6.279,3.234,8.094L1.609,9.733c-0.146,0.147-0.146,0.386,0,0.533l1.625,1.639c1.8,1.815,4.203,2.816,6.766,2.816s4.966-1.001,6.767-2.816l1.624-1.639C18.536,10.119,18.536,9.881,18.391,9.733 M16.229,11.373c-1.656,1.672-3.868,2.594-6.229,2.594s-4.573-0.922-6.23-2.594L2.41,10l1.36-1.374C5.427,6.955,7.639,6.033,10,6.033s4.573,0.922,6.229,2.593L17.59,10L16.229,11.373z"
                        ></path>
                      </svg>
                    </div>
                    <h3 class="services-title">Dare to Be Different</h3>
                  </div>
                  <div class="services-descr align-left">
                    Don't just blend in; aim to make a striking first impression that sets you apart from the crowd.
                  </div>
                  <div class="services-more"></div>
                </div>
                <div
                  class="bg-dots text-gray-400 position-absolute bottom-0 start-0 mb-n4 z-index-0"
                  style="width: 150px; height: 150px"
                ></div>
              </div>
              <!-- End Services Item -->
              <!-- Services Item -->
              <div class="col-sm-12 col-md-6 col-lg-4 relative">
                <div
                  class="card services-item text-center wow fadeIn"
                  data-wow-delay=".0s"
                  data-wow-duration="1.5s"
                >
                  <div class="card-title">
                    <div class="services-icon">
                      <svg
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="currentColor"
                        aria-hidden="true"
                        focusable="false"
                        xmlns="http://www.w3.org/2000/svg"
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                      >
                        <path
                          d="M12.075,10.812c1.358-0.853,2.242-2.507,2.242-4.037c0-2.181-1.795-4.618-4.198-4.618S5.921,4.594,5.921,6.775c0,1.53,0.884,3.185,2.242,4.037c-3.222,0.865-5.6,3.807-5.6,7.298c0,0.23,0.189,0.42,0.42,0.42h14.273c0.23,0,0.42-0.189,0.42-0.42C17.676,14.619,15.297,11.677,12.075,10.812 M6.761,6.775c0-2.162,1.773-3.778,3.358-3.778s3.359,1.616,3.359,3.778c0,2.162-1.774,3.778-3.359,3.778S6.761,8.937,6.761,6.775 M3.415,17.69c0.218-3.51,3.142-6.297,6.704-6.297c3.562,0,6.486,2.787,6.705,6.297H3.415z"
                        ></path>
                      </svg>
                    </div>
                    <h3 class="services-title">Unleash Your Unique Identity</h3>
                  </div>
                  <div class="services-descr align-left">
                    Utilize the LinkWi Card to showcase more than just your job title. Engage on a deeper level by highlighting your distinct personality and strengths.
                  </div>
                </div>
                <div
                  class="bg-dots text-gray-400 position-absolute bottom-0 start-0 mb-n4 z-index-0"
                  style="width: 150px; height: 150px"
                ></div>
              </div>
              <!-- End Services Item -->
              <!-- Services Item -->
              <div class="col-sm-12 col-md-6 col-lg-4 relative">
                <div
                  class="card services-item text-center wow fadeIn"
                  data-wow-delay=".1s"
                  data-wow-duration="1.5s"
                >
                  <div class="card-title">
                    <div class="services-icon">
                      <svg
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="currentColor"
                        aria-hidden="true"
                        focusable="false"
                        xmlns="http://www.w3.org/2000/svg"
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                      >
                        <path
                          d="M11.709,7.438H8.292c-0.234,0-0.427,0.192-0.427,0.427v8.542c0,0.234,0.192,0.427,0.427,0.427h3.417c0.233,0,0.426-0.192,0.426-0.427V7.865C12.135,7.63,11.942,7.438,11.709,7.438 M11.282,15.979H8.719V8.292h2.563V15.979zM6.156,11.709H2.74c-0.235,0-0.427,0.191-0.427,0.426v4.271c0,0.234,0.192,0.427,0.427,0.427h3.417c0.235,0,0.427-0.192,0.427-0.427v-4.271C6.583,11.9,6.391,11.709,6.156,11.709 M5.729,15.979H3.167v-3.416h2.562V15.979zM17.261,3.167h-3.417c-0.235,0-0.427,0.192-0.427,0.427v12.812c0,0.234,0.191,0.427,0.427,0.427h3.417c0.234,0,0.427-0.192,0.427-0.427V3.594C17.688,3.359,17.495,3.167,17.261,3.167 M16.833,15.979h-2.562V4.021h2.562V15.979z"
                        ></path>
                      </svg>
                    </div>
                    <h3 class="services-title">Empowerment through Analytics</h3>
                  </div>
                  <div class="services-descr align-left">
                    Harness the power of data-driven insights to enhance your reach and focus on key aspects that truly matter.
                  </div>
                </div>
                <div
                  class="bg-dots text-gray-400 position-absolute bottom-0 start-0 mb-n4 z-index-0"
                  style="width: 150px; height: 150px"
                ></div>
              </div>
              <!-- End Services Item -->
              <!-- Services Item -->
              <div class="col-sm-12 col-md-6 col-lg-4 relative">
                <div
                  class="card services-item text-center wow fadeIn"
                  data-wow-delay=".2s"
                  data-wow-duration="1.5s"
                >
                  <div class="card-title">
                    <div class="services-icon">
                      <svg
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="currentColor"
                        aria-hidden="true"
                        focusable="false"
                        xmlns="http://www.w3.org/2000/svg"
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                      >
                        <path
                          d="M14.889 23.652c-.923.227-1.888.348-2.881.348-6.627 0-12.008-5.377-12.008-12s5.381-12 12.008-12c6.628 0 12.009 5.377 12.009 12 0 1.027-.13 2.023-.373 2.975l-.965-.34c.21-.847.321-1.732.321-2.643 0-6.066-4.929-10.992-11-10.992s-11 4.926-11 10.992c0 6.067 4.929 10.993 11 10.993.887 0 1.751-.106 2.577-.304l.312.971zm-2.889-13.652c-1.104 0-2 .896-2 2s.896 2 2 2c.28 0 .546-.057.788-.162l3.06 9.525 2.174-3.622 4.116 4.259 1.879-1.828-4.087-4.216 3.671-1.926-9.694-3.426c.06-.19.093-.393.093-.604 0-1.104-.896-2-2-2zm1.768 3.615l7.333 2.597-2.823 1.481 4.324 4.461-.445.431-4.324-4.473-1.716 2.86-2.349-7.357zm.049 6.692c-.583.126-1.188.193-1.809.193-4.691 0-8.5-3.809-8.5-8.5s3.809-8.5 8.5-8.5c4.692 0 8.5 3.809 8.5 8.5 0 .619-.066 1.222-.192 1.803l-.959-.337c.094-.474.143-.964.143-1.466 0-4.139-3.361-7.5-7.5-7.5-4.139 0-7.5 3.361-7.5 7.5 0 4.139 3.361 7.5 7.5 7.5.517 0 1.022-.052 1.51-.152l.307.959zm-1.076-3.36c-.239.035-.484.053-.733.053-2.759 0-5-2.24-5-5s2.241-5 5-5c2.76 0 5 2.24 5 5 0 .212-.013.421-.039.626l-.979-.345.01-.281c0-2.208-1.792-4-4-4s-4 1.792-4 4 1.792 4 4 4l.43-.023.311.97zm-.741-5.947c.552 0 1 .448 1 1s-.448 1-1 1-1-.448-1-1 .448-1 1-1z"
                        />
                      </svg>
                    </div>
                    <h3 class="services-title">Jumpstart Your Productivity</h3>
                  </div>
                  <div class="services-descr align-left">
                    Get up and running in under five minutes! Register and start sharing your link with the world, reaping the benefits of a streamlined networking experience.
                  </div>
                </div>
                <div
                  class="bg-dots text-gray-400 position-absolute bottom-0 start-0 mb-n4 z-index-0"
                  style="width: 150px; height: 150px"
                ></div>
              </div>
              <!-- End Services Item -->
            </div>
            <!-- End Services Grid -->
          </div>
        </section>
        <!-- End Services Section -->
        <!-- Portfolio Section -->
        <section class="page-section" id="portfolio">
          <div class="container relative">
            <div class="text-center mb-80 mb-sm-50">
              <h2 class="section-title gradient-text">View Actual Customer Profiles</h2>
              <p class="section-title-descr">View some of our clients</p>
            </div>
            <!-- Works Filter -->
            <h2 class="section-title gradient-text">Our Clients</h2>
            <!-- End Works Filter -->
            <div class="row services-grid">
              <div class="col-sm-12 relative">
                <!-- Works Grid -->
                <ul
                  class="works-grid work-grid-5 work-grid-gut clearfix hover-white hide-titles"
                  id="work-grid"
                >
                  <?php clients(); ?>
                </ul>
                <!-- End Works Grid -->
              </div>
            </div>
          </div>
        </section>
        <!-- End Portfolio Section -->
        
        <section id="question" style="background-image: linear-gradient(#ffffff, #f5f4f4);" class="page-section">
          <div class="container relative">
           
              <div
                class="col-lg-12 wow fadeInUpShort"
                data-wow-duration="1.2s"
                data-wow-offset="255"
              >
                <h2 class="banner-heading gradient-text">Thank you for visiting</h2>
                <div class="banner-decription">
                 This site is a demo of the actual website https://linkwi.co. <br/>
                 Contact form and pricing table have been removed.
                 Please feel free to explore. 
                  <br/>
                  <a
                    href="https://fs.kerwindows.com/apps/networking/card/lampstackuser"
                    class="btn btn-mod btn-large btn-round mt-3"
                    >Edit Test Profile</a
                  >
                </div>
                </div>
              </div>
            
          </div>
        </section>
        <!-- End Call Action Section -->

      
        <!-- Call Action Section -->
        <section class="page-section pb-0">
          <div class="container relative">
            <div class="row">
              <!-- Images -->
              <div class="col-lg-5 mb-md-60 mb-xs-30">
                  <div class="call-action-2-image-2">
                    <img
                      src="images/linkwi/image9.jpg"
                      alt=""
                      class="wow scaleOutIn faq-image"
                      data-wow-duration="1.2s"
                      data-wow-offset="134"
                    />
                  </div>
              </div>
              <!-- End Images -->
              <!-- Text -->
              <div
                class="col-lg-7 wow fadeInUpShort"
                data-wow-duration="1.2s"
                data-wow-offset="255"
              >
                <h2 class="section-title gradient-text mb-50 mb-sm-20">FAQ</h2>
                <dl class="call-action-2-text mb-60 mb-sm-30">
                  <dt>01. What Phones Are Compatable?</dt>
                  <dd>
                    All modern cellphones are capable of using LinkWi's tap or
                    scan features. The tap function is available on the
                    NFC-enabled smartphones. iPhones from 2018 and later, as
                    well as the vast majority of Android phones, should function
                    flawlessly. For all other phone models that do not support
                    NFC, please have your customer scan the QR code on the back
                    of your card.
                  </dd>
                  <dt>02. How Do I Get My Card?</dt>
                  <dd>
                    Once you've registered, your profile will be activated with
                    limited features. Those who pay the yearly subscription fee
                    will receive one card. Any additional cards will be charged
                    separately.
                  </dd>
                  <dt>03. Privacy Policy ?</dt>
                  <dd>
                    Profiles on LinkWi are public landing pages where you can
                    save and share information with people you meet. We never
                    ask our customers for sensitive information or social media
                    logins. You can publish as much or as little information as
                    you want on your LinkWi profile.
                  </dd>
                </dl>
                
              </div>
              <!-- End Text -->
            </div>
          </div>
        </section>
        <!-- End Call Action Section -->
 
      
      </main>
      <!-- Footer -->
      <footer id="contact" class="page-section bg-gray-lighter footer pb-100 pb-sm-50">
        <div class="container">
          <!-- Footer Text -->
          <div class="footer-text">
            
            <!-- Copyright -->
            <div class="footer-copy">
              <a href="https://fs.kerwindows.com"
                >Developed by Kerwin Thompson
                <?php echo date('Y') ?> </a
              >.
            </div>
            <div class="local-scroll"></div>
              <a
                href="https://fs.kerwindows.com"
                class="btn btn-mod btn-large btn-round mt-3"
                >Go to Kerwin's Profile</a
              >
            </div>
            <!-- End Copyright -->
          </div>
          <!-- End Footer Text -->
        </div>
        <!-- Top Link -->
        <div class="local-scroll">
          <a href="#top" class="link-to-top"
            ><i class="link-to-top-icon"></i
          ></a>
        </div>
        <!-- End Top Link -->
      </footer>
      <!-- End Footer -->
    </div>
    <!-- End Page Wrap -->
    <!-- JS -->
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/SmoothScroll.js"></script>
    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/jquery.localScroll.min.js"></script>
    <script src="js/jquery.viewport.mini.js"></script>
    <script src="js/jquery.countTo.js"></script>
    <script src="js/jquery.appear.js"></script>
    <script src="js/jquery.parallax-1.1.3.js"></script>
    <script src="js/jquery.fitvids.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/isotope.pkgd.min.js"></script>
    <script src="js/imagesloaded.pkgd.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/masonry.pkgd.min.js"></script>
    <script src="js/jquery.lazyload.min.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/morphext.js"></script>
    <script src="js/typed.min.js"></script>
    <script src="js/all.js"></script>
    <script src="js/contact-form.js"></script>
    <script src="js/jquery.ajaxchimp.min.js"></script>
    <script src="js/objectFitPolyfill.min.js"></script>
    <script src="js/splitting.min.js"></script>
    <script src="js/gsap.min.js"></script>
 
     
  </body>
</html>