<?php

// Required files
require_once(PRIVATE_CLASSES_PATH . '/UserVerificationUtility.php');
include(PRIVATE_MODELS_PATH . '/db/loggedInUser.php');
include(PRIVATE_MODELS_PATH . '/db/getDoctors.php');
include(PRIVATE_MODELS_PATH . '/db/getPatientAppointmentById.php');

$email = $_SESSION['Userdata']['email']; //doctor or patient
$loggedInUserArray = loggedInUserArray($email);

// Check if user exists in the database by email
UserVerificationUtility::checkUserByEmail($loggedInUserArray); //end script if not satisfied

$getPatientAppointmentById = getPatientAppointmentById($id);

// Check if user ID search by ID exists
UserVerificationUtility::checkUserById($getPatientAppointmentById);

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
base_url()."/assets/css/bootstrap-datetimepicker.min.css",
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
    ['title' => 'Dashboard','url'=>base_url().'/dashboard'],
    ['title' => 'Patients List','url'=>base_url().'/patients'],
    ['title' => 'New Visit'],
], 'breadcrumbs', PRIVATE_COMPONENTS_PATH . '/infoboxes/breadcrumbs.php');
$breadcrumbs->render();

$dynamicActiveBox = new DynamicActiveBox([
    'current_user_info' => $getPatientAppointmentById,
    'role' => $getPatientAppointmentById['role']
]);
$dynamicActiveBox->render();


$content = new ComponentRenderer([
    'current_user_info' => $getPatientAppointmentById,
    'doctors_array'=>getDoctors(),
    'directory' => 'patient/patient_visit_new.php'
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
base_url()."/assets/js/app.js",
base_url()."/assets/plugins/jquery-validation/jquery.validate.min.js",
base_url()."/assets/plugins/jquery-validation/additional-methods.min.js",
base_url()."/assets/js/fetch/insertForm.js"
]], 'footer', PRIVATE_INCLUDES_PATH . '/footer.php');
$footer->render();