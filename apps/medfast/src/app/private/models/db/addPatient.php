<?php
if (!defined('PROJECT_PATH')) {
    redirect(base_url().'/404');
}
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once(PRIVATE_CLASSES_PATH . "/DBUtil.php");

    $validationRules = [
    'uid' => [
            'type' => 'string',
            'optional' => true,
        ],
        'fname' => [
            'type' => 'string',
            'regex' => '/^[a-zA-Z ]{2,50}$/',
            'optional' => false,
            'errorMessage' => 'First name must be 2-50 characters long and only contain letters and spaces.'
        ],
        'mname' => [
            'type' => 'string',
            'regex' => '/^[a-zA-Z ]*$/',
            'optional' => true,
            'errorMessage' => 'Middle name must only contain letters and spaces.'
        ],
        'lname' => [
            'type' => 'string',
            'regex' => '/^[a-zA-Z ]{2,50}$/',
            'optional' => false,
            'errorMessage' => 'Last name must be 2-50 characters long and only contain letters and spaces.'
        ],
        'alias' => [
            'type' => 'string',
            'regex' => '/^[\w ]*$/',
            'optional' => true,
            'errorMessage' => 'Alias must only contain letters, numbers, underscores, and spaces.'
        ],
        'dob' => [
            'type' => 'date',
            'regex' => '/^\d{4}-\d{2}-\d{2}$/',
            'optional' => false,
            'errorMessage' => 'Date of birth must be in YYYY-MM-DD format.'
        ],
        'sex' => [
            'type' => 'string',
            'regex' => '/^(Male|Female)$/',
            'optional' => false,
            'errorMessage' => 'Gender must be either "Male" or "Female".'
        ],
        'blood_type' => [
            'type' => 'string',
            'regex' => '/^(A|B|AB|O)[+-]$/',
            'optional' => false,
            'errorMessage' => 'Blood type is invalid'
        ],
        'ethnicity' => [
            'type' => 'string',
            'regex' => '/^[a-zA-Z ]{2,50}$/',
            'optional' => false,
            'errorMessage' => 'Ethnicity name must be 2-50 characters long and only contain letters and spaces.'
        ],
        'address' => [
            'type' => 'string',
            'regex' => '/^[a-zA-Z0-9\s,.-]{2,100}$/',
            'optional' => false,
            'errorMessage' => 'Address must be 2-100 characters long and may contain letters, numbers, spaces, commas, periods, and dashes.'
        ],
        'town' => [
            'type' => 'string',
            'regex' => '/^[a-zA-Z0-9\s,.-]{2,50}$/',
            'optional' => false,
            'errorMessage' => 'Town name must be 2-50 characters long and only contain numbers, letters and spaces.'
        ],
        'city' => [
            'type' => 'string',
            'regex' => '/^[a-zA-Z0-9\s,.-]{2,50}$/',
            'optional' => false,
            'errorMessage' => 'City name must be 2-50 characters long and only contain letters and spaces.'
        ],
        'country' => [
            'type' => 'string',
            'regex' => '/^[a-zA-Z0-9\s,.-]{2,50}$/',
            'optional' => false,
            'errorMessage' => 'Country name must be 2-50 characters long and only contain letters and spaces.'
        ],
        'phone' => [
            'type' => 'string',
            'regex' => '/^(\+?\d{1,3})?[\s.-]?\(?\d{2,3}\)?[\s.-]?\d{3,4}[\s.-]?\d{4}$/',
            'optional' => false,
            'errorMessage' => 'Phone number format is invalid.'
        ],
        'email' => [
            'type' => 'string',
            'regex' => '/^\S+@\S+\.\S+$/',
            'optional' => false,
            'errorMessage' => 'Email must be a valid email address.'
        ],
        'postal_code' => [
            'type' => 'string',
            'regex' => '/^[a-zA-Z0-9]{2,9}$/',
            'optional' => false,
            'errorMessage' => 'Postal code format is invalid.'
        ],
        'religion' => [
            'type' => 'string',
            'regex' => '/^[a-zA-Z ]{2,50}$/',
            'optional' => true,
            'errorMessage' => 'Religion must be 2-50 characters long and only contain letters and spaces.'
        ],
        'union_status' => [
            'type' => 'string',
            'regex' => '/^[a-zA-Z ]{2,50}$/',
            'optional' => false,
            'errorMessage' => 'Union status must be 2-50 characters long and only contain letters and spaces.'
        ],
        'occupation' => [
            'type' => 'string',
            'regex' => '/^[a-zA-Z ]{2,50}$/',
            'optional' => true,
            'errorMessage' => 'Occupation must be 2-50 characters long and only contain letters and spaces.'
        ],
        'about' => [
            'type' => 'string',
            'regex' => '/^[a-zA-Z ]{2,255}$/',
            'optional' => true,
            'errorMessage' => 'About must be 2-255 characters long and only contain letters and spaces.'
        ],
        'status' => [
            'type' => 'string',
            'regex' => '/^(active|inactive)$/',
            'optional' => true,
            'errorMessage' => 'Status must be either "active" or "inactive".'
        ]
    ];

    $nokValidationRules = [
    'uid' => [
            'type' => 'string',
            'optional' => true,
        ],
        'next_of_kin_fname' => [
            'type' => 'string',
            'regex' => '/^[a-zA-Z ]{2,50}$/',
            'optional' => true,
            'errorMessage' => 'Next of kin first name must be 2-50 characters long and only contain letters and spaces.'
        ],
        'next_of_kin_lname' => [
            'type' => 'string',
            'regex' => '/^[a-zA-Z ]{2,50}$/',
            'optional' => true,
            'errorMessage' => 'Next of kin last name must be 2-50 characters long and only contain letters and spaces.'
        ],
        'next_of_kin_relationship' => [
            'type' => 'string',
            'regex' => '/^[a-zA-Z ]{2,50}$/',
            'optional' => true,
            'errorMessage' => 'Relationship must be 2-50 characters long and only contain letters and spaces.'
        ],
        'next_of_kin_phone' => [
            'type' => 'string',
            'regex' => '/^(\+?\d{1,3})?[\s.-]?\(?\d{2,3}\)?[\s.-]?\d{3,4}[\s.-]?\d{4}$/',
            'optional' => true,
            'errorMessage' => 'Phone number format is invalid.'
        ]
    ];

    $emValidationRules = [
    'uid' => [
            'type' => 'string',
            'optional' => true,
        ],
        'emergency_contact_fname' => [
            'type' => 'string',
            'regex' => '/^[a-zA-Z ]{2,50}$/',
            'optional' => true,
            'errorMessage' => 'Emergency contact first name must be 2-50 characters long and only contain letters and spaces.'
        ],
        'emergency_contact_lname' => [
            'type' => 'string',
            'regex' => '/^[a-zA-Z ]{2,50}$/',
            'optional' => true,
            'errorMessage' => 'Emergency contact last name must be 2-50 characters long and only contain letters and spaces.'
        ],
        'emergency_contact_relationship' => [
            'type' => 'string',
            'regex' => '/^[a-zA-Z ]{2,50}$/',
            'optional' => true,
            'errorMessage' => 'Emergency contact relationship must be 2-50 characters long and only contain letters and spaces.'
        ],
        'emergency_contact_phone' => [
            'type' => 'string',
            'regex' => '/^(\+?\d{1,3})?[\s.-]?\(?\d{2,3}\)?[\s.-]?\d{3,4}[\s.-]?\d{4}$/',
            'optional' => true,
            'errorMessage' => 'Phone number format is invalid.'
        ]
    ];

    $userVisibilityRules = [
    'uid' => [
            'type' => 'string',
            'optional' => true,
        ],
        'show_age'  => [
            'type' => 'string',
            'optional' => true,
        ],
        'show_sex' => [
            'type' => 'string',
            'optional' => true,
        ],
        'show_email' => [
            'type' => 'string',
            'optional' => true,
        ],
        'show_dob' => [
            'type' => 'string',
            'optional' => true,
        ],
        'show_about' => [
            'type' => 'string',
            'optional' => true,
        ],
        'show_next_of_kin' => [
            'type' => 'string',
            'optional' => true,
        ],
        'show_phone' => [
            'type' => 'string',
            'optional' => true,
        ],
        'show_ethnicity' => [
            'type' => 'string',
            'optional' => true,
        ],
        'show_city' => [
            'type' => 'string',
            'optional' => true,
        ],
        'show_country' => [
            'type' => 'string',
            'optional' => true,
        ],
        'show_allergies' => [
            'type' => 'string',
            'optional' => true,
        ],
        'show_medications' => [
            'type' => 'string',
            'optional' => true,
        ],
        'show_emergency_contact' => [
            'type' => 'string',
            'optional' => true,
        ],
        'show_blood_type' => [
            'type' => 'string',
            'optional' => true,
        ],
    ];

    $uid = generateUniqueID(32);

    $userData = [
        'uid' => $uid, // Presuming $uid is generated and sanitized appropriately
        'fname' => filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_STRING),
        'mname' => filter_input(INPUT_POST, 'mname', FILTER_SANITIZE_STRING),
        'lname' => filter_input(INPUT_POST, 'lname', FILTER_SANITIZE_STRING),
        'alias' => filter_input(INPUT_POST, 'alias', FILTER_SANITIZE_STRING),
        'dob' => date('Y-m-d', strtotime($_POST['dob'])), // Custom sanitization for DOB
        'sex' => filter_input(INPUT_POST, 'sex', FILTER_SANITIZE_STRING),
        'blood_type' => filter_input(INPUT_POST, 'blood_type', FILTER_SANITIZE_STRING),
        'ethnicity' => filter_input(INPUT_POST, 'ethnicity', FILTER_SANITIZE_STRING),
        'phone' => filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING),
        'email' => filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL),
        'address' => filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING),
        'town' => filter_input(INPUT_POST, 'town', FILTER_SANITIZE_STRING),
        'city' => filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING),
        'country' => filter_input(INPUT_POST, 'country', FILTER_SANITIZE_STRING),
        'postal_code' => filter_input(INPUT_POST, 'postal_code', FILTER_SANITIZE_STRING),
        'religion' => filter_input(INPUT_POST, 'religion', FILTER_SANITIZE_STRING),
        'union_status' => filter_input(INPUT_POST, 'union_status', FILTER_SANITIZE_STRING),
        'occupation' => filter_input(INPUT_POST, 'occupation', FILTER_SANITIZE_STRING),
        'about' => filter_input(INPUT_POST, 'about', FILTER_SANITIZE_STRING),
        'status' => filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING),
        // Assuming additional fields if needed
    ];

    $nextOfKinData = [
        'uid' => $uid, // Shared UID for relational integrity
        'fname' => filter_input(INPUT_POST, 'next_of_kin_fname', FILTER_SANITIZE_STRING),
        'lname' => filter_input(INPUT_POST, 'next_of_kin_lname', FILTER_SANITIZE_STRING),
        'relationship' => filter_input(INPUT_POST, 'next_of_kin_relationship', FILTER_SANITIZE_STRING),
        'phone' => filter_input(INPUT_POST, 'next_of_kin_phone', FILTER_SANITIZE_STRING),
    ];


    $emergencyContactData = [
        'uid' => $uid, // Shared UID for relational integrity
        'fname' => filter_input(INPUT_POST, 'emergency_contact_fname', FILTER_SANITIZE_STRING),
        'lname' => filter_input(INPUT_POST, 'emergency_contact_lname', FILTER_SANITIZE_STRING),
        'relationship' => filter_input(INPUT_POST, 'emergency_contact_relationship', FILTER_SANITIZE_STRING),
        'phone' => filter_input(INPUT_POST, 'emergency_contact_phone', FILTER_SANITIZE_STRING),
    ];

    $userVisibilityData = [
        'uid' => $uid,
        'show_age' => 1,
        'show_sex' => 1,
        'show_email' => 1,
        'show_dob' => 1,
        'show_about' => 1,
        'show_next_of_kin' => 1,
        'show_phone' => 1,
        'show_ethnicity' => 1,
        'show_city' => 1,
        'show_country' => 1,
        'show_allergies' => 1,
        'show_medications' => 1,
        'show_emergency_contact' => 1,
        'show_blood_type' => 1
    ];


    // Initialize an empty variable for the image path
    // Initialize an empty variable for the image path
    $imagePath = null;

    // Handle image upload if a file is provided
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageParams = [
            'fileInput' => $_FILES['image'],
            'targetDir' => base_url()."/assets/img/patients/",
            'maxFileSize' => 5 * 1024 * 1024, // 5 MB
            'targetWidth' => 200,
            'targetHeight' => 200,
        ];

        $imageAddResult = uploadAndResizeImage($imageParams);

        // Adjust here: Use 'status' instead of 'success', and 'message' instead of 'error'
        if (!$imageAddResult['status']) {
            // Handle image upload error
            // Use 'message' key for the error message
            //throw new Exception("Image upload failed: " . $imageAddResult['message']);
            echo json_encode(['success' => false, 'message' => "Image upload failed: ", 'errors' => $imageAddResult['message']], JSON_PRETTY_PRINT);
            exit; // Or handle the error as per your application's requirements
        }

        $imagePath = $imageAddResult['filePath'];
    }


    try {
        $db = new dbase;
        $db->beginTransaction();

        // If an image was uploaded, add its path to the userData array
        if ($imagePath !== null) {
            $userData['image'] = $imagePath; // Adjust 'image' to your actual database column name for the image path
        }

        // Insert user data
        $result = DBUtil::validateAndInsert($db, 'users', $userData, $validationRules);
        if (!$result['success']) {
            echo json_encode(['success' => false, 'message' => "User insertion failed: ", 'errors' => $result['errors']], JSON_PRETTY_PRINT);
            $db->rollback(); // Rollback the transaction if user data insertion fails
            exit;
        }

        // Insert next of kin data
        $nextOfKinResult = DBUtil::validateAndInsert($db, 'next_of_kins', $nextOfKinData, $nokValidationRules); // Ensure nokValidationRules are defined correctly
        if (!$nextOfKinResult['success']) {
            echo json_encode(['success' => false, 'message' => "Next of kin insertion failed:", 'errors' => $nextOfKinResult['errors']], JSON_PRETTY_PRINT);
            $db->rollback(); // Rollback the transaction if next of kin insertion fails
            exit;
        }

        // Insert emergency contact data
        $emergencyContactResult = DBUtil::validateAndInsert($db, 'emergency_contacts', $emergencyContactData, $emValidationRules); // Ensure emValidationRules are defined correctly
        if (!$emergencyContactResult['success']) {
            echo json_encode(['success' => false, 'message' => "Emergency contact insertion failed: ", 'errors' => $emergencyContactResult['errors']], JSON_PRETTY_PRINT);
            $db->rollback(); // Rollback the transaction if emergency contact insertion fails
            exit;
        }

        // Insert user visibility preferences data
        $emergencyContactResult = DBUtil::validateAndInsert($db, 'user_visibility_preferences', $userVisibilityData, $userVisibilityRules); // Ensure emValidationRules are defined correctly
        if (!$emergencyContactResult['success']) {
            echo json_encode(['success' => false, 'message' => "User Visibility Preferences failed: ", 'errors' => $emergencyContactResult['errors']], JSON_PRETTY_PRINT);
            $db->rollback(); // Rollback the transaction if emergency contact insertion fails
            exit;
        }

        $db->commit();
        echo json_encode(['success' => true, 'message' => 'All data inserted successfully.']);
        exit;
    } catch (PDOException $e) {
        $db->rollback(); // Rollback the transaction on any PDOException
        error_log($e->getMessage());
        echo json_encode(['success' => false, 'message' => "Database operation failed:", 'errors' => $e->getMessage()], JSON_PRETTY_PRINT);
        exit;
    }
}