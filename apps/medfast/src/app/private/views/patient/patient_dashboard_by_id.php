<?php
// Required files
require_once(PRIVATE_CLASSES_PATH . '/UserVerificationUtility.php');
include(PRIVATE_MODELS_PATH . '/db/loggedInUser.php');
include(PRIVATE_MODELS_PATH . '/db/patientDashboardById.php');

$email = $_SESSION['Userdata']['email']; //doctor or patient
$loggedInUserArray = loggedInUserArray($email);

// Check if user exists in the database by email
UserVerificationUtility::checkUserByEmail($loggedInUserArray); //end script if not satisfied

$patientDashboardByIdArray = patientDashboardByIdArray($uid);

// Check if user ID search by ID exists
UserVerificationUtility::checkUserById($patientDashboardByIdArray);

// Include necessary classes
include(PRIVATE_CLASSES_PATH . '/ComponentRender.php');

// Include necessary database queries
include(PRIVATE_MODELS_PATH . '/arrays/sidebars.php');
include(PRIVATE_MODELS_PATH . '/arrays/dashboard_scripts.php');
include(PRIVATE_MODELS_PATH . '/arrays/hero.php');

// Define variables 
$currentPage = 'dashboard';

// Instantiate and Render objects
$head = new ComponentRenderer(["site_title"=>"MedFast | Patient Dashboard","styles"=>[
base_url()."/assets/css/select2.min.css",
base_url()."/assets/plugins/simple-calendar/simple-calendar.css",
base_url()."/assets/plugins/datatables/datatables.min.css",
base_url()."/assets/plugins/slick/slick.css",
base_url()."/assets/plugins/slick/slick-theme.css",
base_url()."/assets/css/feather.css",
base_url()."/assets/css/style.css"
    ]], 'head', PRIVATE_INCLUDES_PATH . '/head.php');
$head->render();

$forehead = new ComponentRenderer(['current_user_info' => $loggedInUserArray], 'forehead', PRIVATE_INCLUDES_PATH . '/forehead.php');
$forehead->render();

$sidebar = new ComponentRenderer([
    'current_user_sidebar_menu' => $sidebarArray[$loggedInUserArray['role']],
    'current_page' => $currentPage
], 'sidebar', PRIVATE_INCLUDES_PATH . '/sidebar.php');
$sidebar->render();

$breadcrumbs = new ComponentRenderer([
    ['title' => 'Dashboard'],
    ['title' => 'View Profile', 'url' => base_url().'/patient/profile/'.$uid]
], 'breadcrumbs', PRIVATE_COMPONENTS_PATH . '/infoboxes/breadcrumbs.php');
$breadcrumbs->render();

$dynamicActiveBox = new DynamicActiveBox([
    'current_user_info' => $patientDashboardByIdArray,
    'role' => $patientDashboardByIdArray['role']
]);
$dynamicActiveBox->render();

$hero = new ComponentRenderer([
    'salutation' => $heroArray[$loggedInUserArray['role']],
    'current_user_info' => $patientDashboardByIdArray
], 'hero', PRIVATE_COMPONENTS_PATH . '/infoboxes/hero.php');
$hero->render();

$content = new ComponentRenderer([
    'current_user_info' => $patientDashboardByIdArray,
    'directory' => 'dashboards/' . $patientDashboardByIdArray['role'] . '_dashboard.php'
], 'content', PRIVATE_INCLUDES_PATH . '/content.php');
$content->render();


$notificationBox = new ComponentRenderer([], 'notificationBox', PRIVATE_INCLUDES_PATH . '/notificationBox.php');
$notificationBox->render();

$footer = new ComponentRenderer(['js_scripts' => $scriptsArray[$patientDashboardByIdArray['role']]], 'footer', PRIVATE_INCLUDES_PATH . '/footer.php');
$footer->render();