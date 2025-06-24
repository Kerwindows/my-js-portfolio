<!DOCTYPE html>
<html lang="en">

<head>
    <title>Shop | LinkWi Digital Business Card ®</title>
    <meta name="description" content="">
    <meta charset="utf-8">
    <meta name="author" content="-----">
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Favicons -->
    <link rel="shortcut icon" href="../../../../images/favicon.ico">

    <!-- CSS -->
    <link rel="stylesheet" href="../../../../css/fontawesome.com_releases_v6.4.2_css_all.css">
	<link rel="stylesheet" href="../../../../css/fontawesome.com_releases_v6.4.2_css_sharp-light.css">
	<link rel="stylesheet" href="../../../../css/fontawesome.com_releases_v6.4.2_css_sharp-regular.css">
	<link rel="stylesheet" href="../../../../css/fontawesome.com_releases_v6.4.2_css_sharp-solid.css">
    <link rel="stylesheet" href="../../../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../../css/style.css">
    <link rel="stylesheet" href="../../../../css/style-responsive.css">
    <link rel="stylesheet" href="../../../../css/vertical-rhythm.min.css">
    <link rel="stylesheet" href="../../../../css/magnific-popup.css">
    <link rel="stylesheet" href="../../../../css/owl.carousel.css">
    <link rel="stylesheet" href="../../../../css/animate.min.css">
    <link rel="stylesheet" href="../../../../css/splitting.css">
    <style>
    input#billingcheckbox {
        height: 28px;
        width: 26px;
    }

    i.fa.fa-star.fa-sm {
        color: gold;
    }
    .cart-image{
      position: absolute; top: -24px; left: 32px; width: 30px
    }
    @media screen and (max-width: 660px) {
     .cart-image{
    top: -79%;
    left: 28%;
    width: 42%;
    }
    }
    @media screen and (max-width: 596px) {
     .cart-image{
    top: -51%;
    left: 28%;
    width: 42%;
    }
    }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
</head>

<body class="appear-animate">


    <!-- Page Loader -->
    <div class="page-loader">
        <div class="loader">Loading...</div>
    </div>
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
                        <img src="http://linkwi.co/images/linkwi-og.webp" alt="LinkWi Logo" /><!--<h3 class="nav__logo-text mt-20">LinkWi</h3>-->
                        <!-- <img src="images/logo-dark.png" alt="Company logo" width="188" height="37" /> --!>
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
                                <li class="active"><a href="https://linkwi.co">Home</a></li>
                                <li><a href="https://linkwi.co/#about">About</a></li>
                                <li><a href="https://linkwi.co/#services">Services</a></li>
                                <li><a href="https://linkwi.co/#contact">Contact</a></li>
                                <li><a href="/linkwi/login.php">Login</a></li>
                                <!-- Item With Sub -->
                                <li>
                                    <a href="javascript:void(0)" class="mn-has-sub active">Shop <i
                                            class="mn-has-sub-icon"></i></a>

                                    <!-- Sub -->
                                    <ul class="mn-sub to-left">

                                        <li>
                                            <a href="/product/linkwi-business">Linkwi Pro Card</a>
                                        </li>
                                        <!-- <li>
                                        <a href="shop-columns-3col.html">Delux</a>
                                    </li> -->

                                    </ul>
                                    <!-- End Sub -->

                                </li>
                                <!-- End Item With Sub -->
                                <!-- Cart -->
                                <li class="d-sm-none d-md-none d-lg-block">
                                    <a href="../cart" class="active"><i class="main-nav-icon-cart"></i> Cart <span
                                            class="rounded-circle"
                                            style="position: relative;top: -0.8rem;left: -0.5rem;line-height: 21.2px;background: #ff3b6c;width: 23px;height: 23px;color: #fff;display: inline-block;"><?php echo $noItemsInCart = items(); ?></span></a>
                                </li>
                                <!-- End Cart -->

                            </ul>
                        </div>
                        <!-- End Main Menu -->

                </div>
        </nav>
        <!-- End Navigation panel -->