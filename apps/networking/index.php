<?php
ob_start();

require 'includes/linkwi.php';
require_once "includes/router.php";


//from https://www.youtube.com/watch?v=gVPAboBbGRE



route('/terms-of-use', function () {
    include(PROJECT_PATH . '/terms-of-use.php');
    exit();
});

//hide original contact page
// route('/contact', function () {
//     include (c . '/contact.php');
//     exit();
// });

route('/search', function () {
    include(LINKWI_VIEW_PATH . '/search-results.php');
    exit();
});
route('/cart', function () {
    include(LINKWI_VIEW_PATH . '/cart.php');
    exit();
});
route('/checkout', function () {
    include(LINKWI_VIEW_PATH . '/checkout.php');
    exit();
});
route('/search/{Username}/?', function ($Username) {
    include(LINKWI_VIEW_PATH . '/search-results.php');
    exit();
});
route('/card/{Username}/?', function ($Username) {
return include(LINKWI_VIEW_PATH . '/linkwi-user-new.php');
});

route('/nnect/{Username}/?', function ($Username) {
return include(LINKWI_VIEW_PATH . '/linkwi-user-new.php');
});
route('/nnect/{Corporation}/{Username}?', function ($Corporation, $Username = '') {
    include(LINKWI_VIEW_PATH . '/linkwi-user-corporate.php');
    exit();
});

route('/card/{Corporation}/{Username}?', function ($Corporation, $Username = '') {
    include(LINKWI_VIEW_PATH . '/linkwi-user-corporate.php');
    exit();
});
route('/card-download/{Username}?', function ($Username) {
return include(LINKWI_VIEW_PATH . '/linkwi-user-vcard.download.php');
});
route('/card-download/{Corporation}/{Username}?', function ($Corporation,$Username = '') {
    include(LINKWI_VIEW_PATH . '/linkwi-user-corporate-vcard.download.php');
    exit();
});
route('/in/login', function () {
    include(LINKWI_PATH . '/login.r.php');
    exit();
});
route('/in/logout', function () {
    include(LINKWI_PATH . '/logout.php');
    exit();
});
route('/in/corporate-userlogin', function () {
    include(LINKWI_PATH . '/corporate-userlogin.r.php');
    exit();
});
route('/product/{Product}/?', function ($pro_id) {
    include(LINKWI_VIEW_PATH . '/product-details.php');
    exit();
});

/*route('/order/{c_id}/?', function ($c_id) {
 include (LINKWI_VIEW_PATH . '/order.php');
 exit(); 
});*/

route('/order/{c_id}/{invoice}/{order_id}', function ($c_id, $invoice, $order_id) {
    include(LINKWI_VIEW_PATH . '/order.php');
    exit();
});
route('/wipay/{c_id}/{invoice}', function ($c_id, $invoice) {
    include(LINKWI_VIEW_PATH . '/wipay-order.php');
    exit();
});
route('/wipay-renew/{c_id}/{invoice}', function ($c_id, $invoice) {
    include(LINKWI_VIEW_PATH . '/wipay-order-renew.php');
    exit();
});
route('/renew-subscription/{UniqueID}', function ($UniqueID) {
    include(LINKWI_VIEW_PATH . '/renew.php');
    exit();
});
route('/wipay/{w_id}/?', function ($w_id) {
    include(LINKWI_VIEW_PATH . '/wipay.php');
    exit();
});
route('/profile/{variable1}/go/{variable2}', function ($variable1, $variable2) {
});

route('/', function () {
include(PROJECT_PATH . '/homepage-new.php');
    exit();
});

$action = urldecode($_SERVER['REQUEST_URI']);
dispatch($action);