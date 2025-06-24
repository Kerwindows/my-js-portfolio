<?php
// Required files
require_once(PRIVATE_CLASSES_PATH . '/UserVerificationUtility.php');
include(PRIVATE_MODELS_PATH . '/db/loggedInUser.php');
include(PRIVATE_MODELS_PATH . '/db/patientProfileById.php');

// Check user existence by email
$email = $_SESSION['Userdata']['email'];
$loggedInUserArray = loggedInUserArray($email);
UserVerificationUtility::checkUserByEmail($loggedInUserArray); //end script if not satisfied

// Check if user ID search by ID exists
$patientProfileByIdArray = patientProfileByIdArray($uid);

// Include necessary classes
include(PRIVATE_CLASSES_PATH . '/ComponentRender.php');

// Include necessary database queries
include(PRIVATE_MODELS_PATH . '/db/patientVisibilityPreferance.php');

$patientVisibilityPreferance = patientVisibilityPreferance($uid);

// Instantiate and Render objects
$head = new ComponentRenderer(["site_title"=>"MedFast | Patient Public Profile","styles"=>[
base_url()."/assets/css/style.css"
    ]], 'head', PRIVATE_INCLUDES_PATH . '/head.php');
$head->render();

$forehead = new ComponentRenderer(['current_user_info' => $loggedInUserArray], 'forehead', PRIVATE_INCLUDES_PATH . '/public_forehead.php');
$forehead->render();



$content = new ComponentRenderer([
    'current_user_info' => $patientProfileByIdArray,
    'user_visibility_preferences'=>$patientVisibilityPreferance,
    'directory' => 'patient/patient_public_profile.php'
], 'content', PRIVATE_INCLUDES_PATH . '/content.php');
$content->render();


$footer = new ComponentRenderer(['js_scripts' => [base_url()."/assets/js/public-profile.js"]], 'footer', PRIVATE_INCLUDES_PATH . '/footer.php');
$footer->render();