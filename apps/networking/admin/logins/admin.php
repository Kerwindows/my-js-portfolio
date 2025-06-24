<?php
if (!defined('PROJECT_PATH')) {
  header("Location: ../../../we-see-you.php");
  exit();
}


include(ADMIN_INCLUDES_PATH . '/head.tables.php');
include(ADMIN_INCLUDES_PATH . '/header.php');
echo "<div class='content-wrapper'>";


switch (getSlug()) {
  case 'dashboard':
    include(ADMIN_VIEW_PATH . '/dashboard.php');
    getTitle('Admin Dashboard', 'Admin Dashboard');
    break;

  case 'orders':
    include(ADMIN_VIEW_PATH . '/orders.php');
    getTitle('Orders', 'Orders');
    break;
  case 'pending-orders':
    include(ADMIN_VIEW_PATH . '/pending-orders.php');
    getTitle('Pending Orders', 'Pending Orders');
    break;

  case 'remove-images':
    include(ADMIN_VIEW_PATH . '/remove-images.php');
    getTitle('Remove Images', 'Remove Images');
    break;

  case 'confirm-order':
    include(ADMIN_VIEW_PATH . '/confirm-order.php');

    getTitle('Confirm Order', 'Confirm Order');
    break;

  case 'client-order':
    include(ADMIN_VIEW_PATH . '/client-order.php');
    getTitle('Client Order', 'Client Order');
    break;

  default:
    include(ADMIN_VIEW_PATH . '/dashboard.php');
    getTitle('Admin Dashboard', 'Admin Dashboard');
}


?>
</div>
<!--close content-wrapper -->

<?php
include(ADMIN_INCLUDES_PATH . '/asides/admin_user.php');
include(ADMIN_INCLUDES_PATH . '/footer.tables.php');