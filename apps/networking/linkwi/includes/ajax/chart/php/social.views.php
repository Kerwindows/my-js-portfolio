<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Set the Content-Type to JSON
header('Content-Type: application/json');

// Check if 'userid' is set in the POST request
if (isset($_POST['userid'])) {
    // Include necessary files
    require('../../../../../includes/linkwi.php');
    require(LINKWI_CLASSES_PATH . "/social.views.ext.php");
    require(LINKWI_CLASSES_PATH . "/social.counts.ext.php");

    // Initialize necessary classes
    $G = new SocialCountExt();
    $P = new SocialViewsExt($_POST['userid'], $_POST['month'], $_POST['year']);

    // Prepare the response data
    $response = [
        "label" => $G->getSocialMediaArray($_POST['userid'], $_POST['month'], $_POST['year']),
        "result" => $G->getSocialMediaCount($_POST['userid'], $_POST['month'], $_POST['year'])
    ];

    // Return the JSON response
    echo json_encode($response);
} else {
    // If 'userid' is not set, return an error response
    echo json_encode([
        "error" => "User ID not provided"
    ]);
}

exit;