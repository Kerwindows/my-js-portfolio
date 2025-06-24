<?php
if (!defined('PROJECT_PATH')) {
return redirect(base_url().'/404');
}
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once(PRIVATE_CLASSES_PATH . "/DBUtil.php");

    $apptValidationRules = [
         'appointment_id' =>  [
	        'type' => 'number',
	        'optional' => true,
	    	],
         'uid' => [
            'type' => 'string',
            'optional' => false,
        ],
        'did' => [
            'type' => 'string',
            'optional' => false,
        ],
        'start_date' => [
            'type' => 'datetime-local',
            'regex' => '/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}$/', // e.g. 2024-04-07T19:27
            'optional' => false,
            'errorMessage' => 'Start date is not valid'
        ],
        'end_date' => [
            'type' => 'datetime-local',
            'regex' => '/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}$/', // e.g. 2024-04-07T19:27
            'optional' => false,
            'errorMessage' => 'End date is not valid'
        ],
        'reason' => [
            'type' => 'string',
            'regex' => '/^[a-zA-Z0-9\s,.-]{2,200}$/',
            'optional' => false,
            'errorMessage' => 'Summary must be 2-200 characters long.'
        ],
        'summary' => [
            'type' => 'string',
            'regex' => '/^[a-zA-Z0-9\s,.-]{2,200}$/',
            'optional' => false,
            'errorMessage' => 'Summary must be 2-200 characters long.'
        ],
        'date_time_stamp' => [
            'type' => 'string',
            'optional' => false,
        ],
];

$vitalsRules = [
   
     'uid' =>  [
        'type' => 'number',
        'optional' => true,
    ],
    'vid' =>  [
        'type' => 'number',
        'optional' => true,
    ],
    'height' => [
        'type' => 'number',
        'regex'=> '/^(?:[1-9]\d{0,2}|0)$/',
        'optional' => true,
        'errorMessage' => 'Invalid format for height'
        
    ],
    'weight' => [
        'type' => 'number',
       'regex'=> '/^(?:[1-9]\d{0,2}|0)$/',
        'optional' => true,
        'errorMessage' => 'Invalid format for weight'
    ],
    'temperature' => [
        'type' => 'number',
        'regex'=> '/^(?:[1-9]\d{0,2}|0)$/',
        'optional' => true,
        'errorMessage' => 'Invalid format for temperature'
    ],
    'sleep' => [
    'type' => 'string',
    'regex' => '/^(2[0-3]|[01]?[0-9]):([0-5]?[0-9])$/',
    'optional' => true,
    'errorMessage' => 'Time must be in the format HH:MM (00-23:00-59).'
],

    'blood_pressure' => [
    'type' => 'string',
    'regex' => '/^\d{1,3}\/\d{1,3}$/',
    'optional' => false,
    'errorMessage' => 'Blood pressure must be in the format xx/xx '
],


    'heart_rate' => [
        'type' => 'number',
        'regex'=> '/^(?:[1-9]\d{0,2}|0)$/',
        'optional' => true,
        'errorMessage' => 'Invalid format for heart rate'
    ],
    'glucose' => [
        'type' => 'number',
        'regex'=> '/^(?:[1-9]\d{0,2}|0)$/',
        'optional' => true,
        'errorMessage' => 'Invalid format for glucose'
    ],
    'cholesterol' => [
        'type' => 'number',
        'regex'=> '/^(?:[1-9]\d{0,2}|0)$/',
        'optional' => true,
        'errorMessage' => 'Invalid format for cholesterol'
    ]
];

$visitRules = [
    'notes' => [
        'type' => 'string',
            'regex' => '/^[a-zA-Z0-9\s,.-]{2,500}$/',
            'optional' => true,
            'errorMessage' => 'Notes must be 2-100 characters long.'
    ],
    'inventory_request' => [
        'type' => 'string',
            'regex' => '/^[a-zA-Z0-9\s,.-]{2,500}$/',
            'optional' => true,
            'errorMessage' => 'Notes must not be more than 500 characters long.'
    ],
    'inventory_result' => [
       'type' => 'string',
            'regex' => '/^[a-zA-Z0-9\s,.-]{2,500}$/',
            'optional' => true,
            'errorMessage' => 'Inventory must not be more than 500 characters long.'
    ],
    'diagnosis' => [
        'type' => 'string',
            'regex' => '/^[a-zA-Z0-9\s,.-]{2,500}$/',
            'optional' => true,
            'errorMessage' => 'Inventory must not be more than 500 characters long.'
    ],
    'treatment' => [
        'type' => 'string',
            'regex' => '/^[a-zA-Z0-9\s,.-]{2,500}$/',
            'optional' => true,
            'errorMessage' => 'Inventory must not be more than 500 characters long.'
    ],
    'did' => [
        'type' => 'string',
        'optional' => false,
    ]
];


$vid = generateUniqueID(12);

    $apptData = [
        'uid' => filter_input(INPUT_POST, 'uid', FILTER_SANITIZE_STRING),
        'did' => filter_input(INPUT_POST, 'did', FILTER_SANITIZE_STRING),
        'start_date' => filter_input(INPUT_POST, 'start_date', FILTER_SANITIZE_STRING),
        'end_date' => filter_input(INPUT_POST, 'end_date', FILTER_SANITIZE_STRING),
        'reason' => filter_input(INPUT_POST, 'reason', FILTER_SANITIZE_STRING),
        'summary' => filter_input(INPUT_POST, 'summary', FILTER_SANITIZE_STRING),
        'date_time_stamp'=> date_time('Y-m-d H:i:s')
    ];
    
     $visitData = [
        'appointment_id' => filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT),
        'uid' => filter_input(INPUT_POST, 'uid', FILTER_SANITIZE_STRING), // Shared UID for relational integrity
        'vid' => $vid,
        'notes' => filter_input(INPUT_POST, 'notes', FILTER_SANITIZE_STRING),  
        'inventory_request' => filter_input(INPUT_POST, 'inventory_request', FILTER_SANITIZE_STRING),  
    	'inventory_result' => filter_input(INPUT_POST, 'inventory_result', FILTER_SANITIZE_STRING),  
    	'diagnosis' => filter_input(INPUT_POST, 'diagnosis', FILTER_SANITIZE_STRING),
    	'treatment' => filter_input(INPUT_POST, 'treatment', FILTER_SANITIZE_STRING),
    	'did' => filter_input(INPUT_POST, 'did', FILTER_SANITIZE_STRING),
    ];

    $vitalsData = [
        'uid' => filter_input(INPUT_POST, 'uid', FILTER_SANITIZE_STRING),
        'vid' => $vid,
        'height' => filter_input(INPUT_POST, 'height', FILTER_SANITIZE_STRING),        
	'weight' => filter_input(INPUT_POST, 'weight', FILTER_SANITIZE_STRING),
	'temperature' => filter_input(INPUT_POST, 'temperature', FILTER_SANITIZE_STRING),
	'sleep' => filter_input(INPUT_POST, 'sleep', FILTER_SANITIZE_STRING),
	'blood_pressure' => filter_input(INPUT_POST, 'blood_pressure', FILTER_SANITIZE_STRING),
	'heart_rate' => filter_input(INPUT_POST, 'heart_rate', FILTER_SANITIZE_STRING),
	'glucose' => filter_input(INPUT_POST, 'glucose', FILTER_SANITIZE_STRING),
	'cholesterol' => filter_input(INPUT_POST, 'cholesterol', FILTER_SANITIZE_STRING),
	'date_time_stamp' => date_time('Y-m-d h:i:s')
    ];


   
    
$whereClause = ['id' => filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT)];
$whereClauseVitals = ['aid' => filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT)];
$whereClauseVisits = ['aid' => filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT)];

try {
    $db = new dbase;
    $db->beginTransaction();

   

  
     $result = DBUtil::validateAndUpdate($db, 'appointments',  $apptData, $apptValidationRules, $whereClause);
    if (!$result['success']) {
        echo json_encode(['success' => false, 'message' => "Appointment update failed: ", 'errors' => $result['errors']], JSON_PRETTY_PRINT);
        $db->rollback(); // Roll back the transaction if update fails
        exit;
    }

    // Update
    $result = DBUtil::validateAndUpdate($db, 'vitals', $vitalsData, $vitalsRules, $whereClauseVitals); // Ensure nokValidationRules are defined correctly
    if (!$result['success']) {
        echo json_encode(['success' => false, 'message' => "Vitals submission failed:", 'errors' => $result['errors']], JSON_PRETTY_PRINT);
        $db->rollback(); // Rollback the transaction if next of kin insertion fails
        exit;
    }

    // Update
    $result = DBUtil::validateAndUpdate($db, 'visits', $visitData, $visitRules, $whereClauseVisits); // Ensure emValidationRules are defined correctly
    if (!$result['success']) {
        echo json_encode(['success' => false, 'message' => "New visit record failed: ", 'errors' => $result['errors']], JSON_PRETTY_PRINT);
        $db->rollback(); // Rollback the transaction if emergency contact insertion fails
        exit;
    }

    $db->commit();
    echo json_encode(['success' => true, 'message' => 'Saved successfully.','isUpdate' => $isUpdate = true]);
    exit;
} catch (PDOException $e) {
    $db->rollback(); // Rollback the transaction on any PDOException
    error_log($e->getMessage());
    echo json_encode(['success' => false, 'message' => "Database operation failed:", 'errors' => $e->getMessage()], JSON_PRETTY_PRINT);
    exit;
}

}