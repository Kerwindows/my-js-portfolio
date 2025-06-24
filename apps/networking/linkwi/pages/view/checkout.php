<?php
session_start();
ob_start();
if (!defined('PROJECT_PATH')) {

  exit("<script>window.open('https://checkin.cyversify.com/we-see-you.php','_self')</script>");
}


require LINKWI_FUNCTIONS_PATH . '/functions.php';
include LINKWI_INCLUDES_PATH . '/linkwi.shop.head.php';
$ip_add = $_SESSION['ip_add'] = getRealUserIp();


?>
<main id="main">
    <section class="page-section pb-0" id="home">
    <div class="container relative text-center">
      <div class="row">
        <div class="col-lg-10 offset-lg-1">
          <h2 class="hs-line-7 mb-0 wow fadeInUpShort" data-wow-delay=".2s">
            Checkout
          </h2>
        </div>
      </div>
    </div>
  </section>
  <!-- End Home Section -->
    <section class="page-section pt-0" id="home">
        <div class="container">
            <div class="row row-60 justify-content-sm-center">
                <?php
        if (!isset($_SESSION['Userdata']['UniqueID'])) { ?>
		<? header("Location: linkwi/login.php?vewcart=1");
		die; ?>
                <!--<div class="col-lg-4 section-divided__main">
                    <?php //include("customer-login.php"); ?>
                    
                </div>-->
                <?php  } else { ?>
                <div class="col-lg-8 section-divided__main">
                    <?php include("payment-options.php"); ?>
                </div>
                <?php   }

        ?>

            </div>
        </div>
        </div>
    </section>



    <?php include LINKWI_INCLUDES_PATH . '/linkwi.shop.footer.php'; ?>