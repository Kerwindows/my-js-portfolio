<?php
//required file to run authentication
require_once(PRIVATE_CLASSES_PATH . '/UserVerificationUtility.php');
include(PRIVATE_MODELS_PATH . '/db/loggedInUser.php');
include(PRIVATE_MODELS_PATH . '/db/editPatientById.php');

// Check user existence by email
$email = $_SESSION['Userdata']['email'];
$loggedInUserArray = loggedInUserArray($email);
UserVerificationUtility::checkUserByEmail($loggedInUserArray);

// Check if user ID search by ID exists
$editPatientByIdArray = editPatientByIdArray($uid);
UserVerificationUtility::checkUserById($editPatientByIdArray);

/************continue script***************/
// Include necessary classes
include(PRIVATE_CLASSES_PATH . '/ComponentRender.php');

//Database queries
// Include necessary database queries
include(PRIVATE_MODELS_PATH . '/arrays/sidebars.php');

// Define variables 
$currentPage = 'patients';
$loggedInUserRole = $loggedInUserArray['role'];

// Instantiate and Render objects
$head = new ComponentRenderer(["site_title"=>"MedFast | Edit Patient ","styles"=>[
base_url()."/assets/css/select2.min.css",
base_url()."/assets/css/bootstrap-datetimepicker.min.css",
base_url()."/assets/css/feather.css",
base_url()."/assets/css/style.css"
    ]], 'head', PRIVATE_INCLUDES_PATH . '/head.php');
$head->render();

$forehead = new ComponentRenderer(['current_user_info' => $loggedInUserArray], 'forehead', PRIVATE_INCLUDES_PATH . '/forehead.php');
$forehead->render();

$sidebar = new ComponentRenderer([
    'current_user_sidebar_menu' => $sidebarArray[$loggedInUserRole],
    'current_page' => $currentPage
], 'sidebar', PRIVATE_INCLUDES_PATH . '/sidebar.php');
$sidebar->render();

$breadcrumbs = new ComponentRenderer([
    ['title' => 'Dashboard', 'url' => base_url().'/dashboard'],
    ['title' => 'Edit Patient']
], 'breadcrumbs', PRIVATE_COMPONENTS_PATH . '/infoboxes/breadcrumbs.php');
$breadcrumbs->render();

$dynamicActiveBox = new DynamicActiveBox([
    'current_user_info' => $editPatientByIdArray,
    'role' => $editPatientByIdArray['role']
]);
$dynamicActiveBox->render();

$content = new ComponentRenderer([
    'current_user_info' => $editPatientByIdArray,
    'directory' => 'patient/patient_public_profile_edit.php'
], 'content', PRIVATE_INCLUDES_PATH . '/content.php');
$content->render();

$notificationBox = new ComponentRenderer([], 'notificationBox', PRIVATE_INCLUDES_PATH . '/notificationBox.php');
$notificationBox->render();


$footer = new ComponentRenderer(['js_scripts' => [
base_url()."/assets/js/feather.min.js",
base_url()."/assets/js/jquery.slimscroll.js",
base_url()."/assets/js/select2.min.js",
base_url()."/assets/plugins/moment/moment.min.js",
"//cdn.jsdelivr.net/npm/sweetalert2@11",
base_url()."/assets/js/bootstrap-datetimepicker.min.js",	
base_url()."/assets/plugins/jquery-validation/jquery.validate.min.js",
base_url()."/assets/plugins/jquery-validation/additional-methods.min.js",
base_url()."/assets/js/app.js"
]], 'footer', PRIVATE_INCLUDES_PATH . '/footer.php');
$footer->render();