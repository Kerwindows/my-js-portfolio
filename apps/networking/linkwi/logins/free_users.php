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
    include(LINKWI_VIEW_PATH . '/dashboard_f.php');
    getTitle('Admin Dashboard', 'Admin Dashboard');
    break;
  case 'myprofile':
    include(LINKWI_VIEW_PATH . '/linkwi-user-iframe.php');
    getTitle('My Profile', 'My Profile');
    break;
  case 'password':
    include(LINKWI_EDIT_PATH . '/password.php');
    getTitle('Change Password', 'Change Password');
    break;
  case 'edit-info':
    include(LINKWI_EDIT_PATH . '/edit-info.php');
    getTitle('My Information', 'My Information');
    break;      
  case '404':
    include(LINKWI_VIEW_PATH . '/404.php');
    getTitle('404', '404');
    break;
  default:
    include(LINKWI_VIEW_PATH . '/dashboard_f.php');
    getTitle('Admin Dashboard', 'Admin Dashboard');
}
?>
</div>
<!--close content-wrapper -->
<?php
include(LINKWI_INCLUDES_PATH . '/asides/linkwi_free.php');
include(LINKWI_INCLUDES_PATH . '/footer.tables.php');