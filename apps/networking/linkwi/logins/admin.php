<?php
if (!defined('PROJECT_PATH')) {
  header("Location: ../../../we-see-you.php");
  exit();
}

include(LINKWI_INCLUDES_PATH . '/head.tables.php');
include(LINKWI_INCLUDES_PATH . '/header.php');
echo "<div class='content-wrapper'>";

switch (getSlug()) {
  case 'dashboard':
    include(LINKWI_VIEW_PATH . '/dashboard.php');
    getTitle('Admin Dashboard', 'Admin Dashboard');
    break;
  case 'views-chart':
    include(LINKWI_VIEW_PATH . '/views-chart.php');
    getTitle('Views Chart', 'Views Chart');
    break;
  case 'leads':
    include(LINKWI_VIEW_PATH . '/leads.php');
    getTitle('My Leads', 'My Leads');
    break;
  case 'myprofile':
    include(LINKWI_VIEW_PATH . '/linkwi-user-iframe.php');
    getTitle('My Profile', 'My Profile');
    break;
  case 'archivelinks':
    include(LINKWI_VIEW_PATH . '/linkstable/select.php');
    getTitle('My Links', 'My Links');
    break;
  case 'password':
    include(LINKWI_EDIT_PATH . '/password.php');
    getTitle('Change Password', 'Change Password');
    break;
  case 'QRCode':
    include(LINKWI_VIEW_PATH . '/qrcode.php');
    getTitle('My QR', 'My QR');
    break;
  case '404':
    include(LINKWI_VIEW_PATH . '/404.php');
    getTitle('404', '404');
    break;
  default:
    include(LINKWI_VIEW_PATH . '/dashboard.php');
    getTitle('Admin Dashboard', 'Admin Dashboard');
}
?>
</div>
<!--close content-wrapper -->
<?php
include(LINKWI_INCLUDES_PATH . '/asides/linkwi_user.php');
include(LINKWI_INCLUDES_PATH . '/footer.tables.php');