<?php
//required file to run authentication
require_once(PRIVATE_CLASSES_PATH .'/UserVerificationUtility.php');
include(PRIVATE_MODELS_PATH . '/db/loggedInUser.php');
include(PRIVATE_MODELS_PATH . '/db/patientsByIdArray.php');

// Check if user exists in the database by email
$email = $_SESSION['Userdata']['email']; //doctor or patient
$loggedInUserArray = loggedInUserArray($email);

UserVerificationUtility::checkUserByEmail($loggedInUserArray); //end script if not satisfied

/************continue script***************/
// Include necessary classes
include(PRIVATE_CLASSES_PATH . '/ComponentRender.php');

//Database queries
include(PRIVATE_MODELS_PATH . '/arrays/sidebars.php');
include(PRIVATE_MODELS_PATH . '/arrays/dashboard_scripts.php');
include(PRIVATE_MODELS_PATH . '/arrays/hero.php');

// Define variables 
$currentPage = 'patients';
$userRole = $loggedInUserArray['role']; //this will be dynamic from a query

// Instantiate and Render objects
$head = new ComponentRenderer(["site_title"=>"MedFast | Patients","styles"=>[
base_url()."/assets/css/select2.min.css",
base_url()."/assets/plugins/simple-calendar/simple-calendar.css",
base_url()."/assets/plugins/datatables/datatables.min.css",
base_url()."/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css",
base_url()."/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css",
base_url()."/assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css",
base_url()."/assets/plugins/slick/slick.css",
base_url()."/assets/plugins/slick/slick-theme.css",
base_url()."/assets/css/feather.css",
base_url()."/assets/css/style.css"
    ]], 'head', PRIVATE_INCLUDES_PATH . '/head.php');
$head->render();

$forehead = new ComponentRenderer(['current_user_info' => $loggedInUserArray], 'forehead', PRIVATE_INCLUDES_PATH . '/forehead.php');
$forehead->render();

$sidebar = new ComponentRenderer([
    'current_user_sidebar_menu' => $sidebarArray[$userRole],
    'current_page' => $currentPage
], 'sidebar', PRIVATE_INCLUDES_PATH . '/sidebar.php');
$sidebar->render();

$breadcrumbs = new ComponentRenderer([
    ['title' => 'Dashboard', 'url' => base_url().'/dashboard'],
    ['title' => 'View Patients']
], 'breadcrumbs', PRIVATE_COMPONENTS_PATH . '/infoboxes/breadcrumbs.php');
$breadcrumbs->render();

$dynamicActiveBox = new DynamicActiveBox([
    'current_user_info' => $loggedInUserArray,
    'role' => $loggedInUserArray['role']
]);
$dynamicActiveBox->render();

$content = new ComponentRenderer([
    'current_users_info' => patientsByIdArray(),
    'directory' => 'patient/patients_list.php'
], 'content', PRIVATE_INCLUDES_PATH . '/content.php');
$content->render();

$notificationBox = new ComponentRenderer([], 'notificationBox', PRIVATE_INCLUDES_PATH . '/notificationBox.php');
$notificationBox->render();

$footer = new ComponentRenderer(['js_scripts' => [
base_url()."/assets/js/feather.min.js",
base_url()."/assets/js/jquery.slimscroll.js",
base_url()."/assets/plugins/datatables/jquery.dataTables.min.js",
base_url()."/assets/plugins/datatables/datatables.min.js",
base_url()."/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js",
base_url()."/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js",
base_url()."/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js",
base_url()."/assets/plugins/datatables-buttons/js/dataTables.buttons.min.js",
base_url()."/assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js",
base_url()."/assets/plugins/jszip/jszip.min.js",
base_url()."/assets/plugins/pdfmake/pdfmake.min.js",
base_url()."/assets/plugins/pdfmake/vfs_fonts.js",
base_url()."/assets/plugins/datatables-buttons/js/buttons.html5.min.js",
base_url()."/assets/plugins/datatables-buttons/js/buttons.print.min.js",
base_url()."/assets/plugins/datatables-buttons/js/buttons.colVis.min.js",
base_url()."/assets/js/app.js"
]], 'footer', PRIVATE_INCLUDES_PATH . '/footer.php');
$footer->render();