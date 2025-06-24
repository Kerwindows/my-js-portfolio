<?php
if (!defined('PROJECT_PATH')) {
  header("Location: /");
  exit();
}

include(LINKWI_INCLUDES_PATH . '/head.tables.php');
include(LINKWI_INCLUDES_PATH . '/header.php');
echo "<div class='content-wrapper'>";


switch (getSlug()) {
  case 'dashboard':
    include(LINKWI_VIEW_PATH . '/dashboard.php');
    getTitle('User Dashboard', 'User Dashboard');
    break;
  case 'dashboard2':
      include(LINKWI_VIEW_PATH . '/dashboard2.php');
      getTitle('User Dashboard', 'User Dashboard');
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
  case 'user-profiles':
    include(LINKWI_VIEW_PATH . '/linkwi-corporate-users-iframe.php');
    getTitle('User Profiles', 'User Profiles');
    break;
  case 'add-users':
    include(LINKWI_VIEW_PATH . '/add-users.php');
    getTitle('Add Users', 'Add Users');
    break;
  case 'archivelinks':
    include(LINKWI_VIEW_PATH . '/linkstable/select.php');
    getTitle('My Links', 'My Links');
    break;
  case 'my-orders':
    include(LINKWI_VIEW_PATH . '/myorders.php');
    getTitle('My Orders', 'My Orders');
    break;
  case 'my-subscriptions':
    include(LINKWI_VIEW_PATH . '/subscription.php');
    getTitle('Subscriptions', 'Subscriptions');
    break;
   case 'edit-info':
    include(LINKWI_EDIT_PATH . '/edit-info.php');
    getTitle('My Information', 'My Infomation');
    break;
   case 'edit-canvas':
    include(LINKWI_EDIT_PATH . '/edit-canvas.php');
    getTitle('Edit Profile Canvas', 'Edit Profile Canvas');
    break;
  case 'password':
    include(LINKWI_EDIT_PATH . '/password.php');
    getTitle('Change Password', 'Change Password');
    break;
    case 'my-card':
    include(LINKWI_EDIT_PATH . '/mycard.php');
    getTitle('Edit My Card', 'Edit My Card');
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
    getTitle('User Dashboard', 'User Dashboard');
}
?>
</div>
<!--close content-wrapper -->
<?php
include(LINKWI_INCLUDES_PATH . '/asides/linkwi_user.php');
include(LINKWI_INCLUDES_PATH . '/footer.tables.php');