<?php
if (!defined('PROJECT_PATH')) {
    redirect(base_url().'/404');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once(PRIVATE_CLASSES_PATH . "/DBUtil.php");

    $validationRules = [
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
            'regex' => '/^[a-zA-Z0-9\s,.-]{2,100}$/',
            'optional' => false,
            'errorMessage' => 'Summary must be 2-100 characters long.'
        ],
        'summary' => [
            'type' => 'string',
            'regex' => '/^[a-zA-Z0-9\s,.-]{2,100}$/',
            'optional' => false,
            'errorMessage' => 'Summary must be 2-100 characters long.'
        ],
        'date_time_stamp' => [
            'type' => 'string',
            'optional' => false,
        ],
    ];
    
    $vitalsRules = [
    'aid' =>  [
        'type' => 'string',
        'optional' => true,
    ],
   
    'uid' =>  [
        'type' => 'string',
        'optional' => true,
    ],
    'vid' =>  [
        'type' => 'string',
        'optional' => true,
    ],
    'height' => [
        'type' => 'string',
        'optional' => true,
    ],
    'weight' => [
        'type' => 'string',
        'optional' => true,
    ],
    'temperature' => [
        'type' => 'string',
        'optional' => true,
    ],
    'sleep' => [
        'type' => 'string',
        'optional' => true,
    ],
    'blood_pressure' => [
        'type' => 'string',
        'optional' => true,
    ],
    'heart_rate' => [
        'type' => 'string',
        'optional' => true,
    ],
    'glucose' => [
        'type' => 'string',
        'optional' => true,
    ],
    'cholesterol' => [
        'type' => 'string',
        'optional' => true,
    ]
];

$visitRules = [
    'aid' =>  [
        'type' => 'string',
        'optional' => true,
    ],
    'uid' =>  [
        'type' => 'string',
        'optional' => true,
    ],
    'vid' =>  [
        'type' => 'string',
        'optional' => true,
    ],
    'aid' => [
       'type' => 'string',
       'optional' => true,
    ],
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

$vid = generateUniqueID(12);//vitals id

    $userData = [
        'uid' => filter_input(INPUT_GET, 'uid', FILTER_SANITIZE_STRING),
        'did' => filter_input(INPUT_POST, 'did', FILTER_SANITIZE_STRING),
        'start_date' => filter_input(INPUT_POST, 'start_date', FILTER_SANITIZE_STRING),
        'end_date' => filter_input(INPUT_POST, 'end_date', FILTER_SANITIZE_STRING),
        'reason' => filter_input(INPUT_POST, 'reason', FILTER_SANITIZE_STRING),
        'summary' => filter_input(INPUT_POST, 'summary', FILTER_SANITIZE_STRING),
        'date_time_stamp'=> date_time('Y-m-d H:i:s')
    ];
    
     $vitalsData = [
        'uid' => filter_input(INPUT_GET, 'uid', FILTER_SANITIZE_STRING),
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
    
    $visitData = [
        
        'uid' => filter_input(INPUT_GET, 'uid', FILTER_SANITIZE_STRING),
        'vid' => $vid,
        'notes' => filter_input(INPUT_POST, 'notes', FILTER_SANITIZE_STRING),  
        'inventory_request' => filter_input(INPUT_POST, 'inventory_request', FILTER_SANITIZE_STRING),  
    	'inventory_result' => filter_input(INPUT_POST, 'inventory_result', FILTER_SANITIZE_STRING),  
    	'diagnosis' => filter_input(INPUT_POST, 'diagnosis', FILTER_SANITIZE_STRING),
    	'treatment' => filter_input(INPUT_POST, 'treatment', FILTER_SANITIZE_STRING),
    	'did' => filter_input(INPUT_POST, 'did', FILTER_SANITIZE_STRING),
    	'seenby'=> filter_input(INPUT_POST, 'did', FILTER_SANITIZE_STRING),
    	'datetime' => date_time('Y-m-d h:i:s')
    ];


    try {
        $db = new dbase;
        $db->beginTransaction();

        // Insert appointment data
        $result = DBUtil::validateAndInsert($db, 'appointments', $userData, $validationRules);
        if (!$result['success']) {
            $db->rollback(); // Roll back the transaction if insertion fails
            echo json_encode(['success' => false, 'message' => "Appointment creation failed: ", 'errors' => $result['errors']], JSON_PRETTY_PRINT);
            exit;
        }
        
         // Retrieve the last inserted ID for the appointment
        $appointmentId = $db->lastInsertId();
       

        // Proceed with inserting vitals using the last inserted appointment ID if needed
        $vitalsData['aid'] = $visitData['aid'] =  $appointmentId; 
        
        $result = DBUtil::validateAndInsert($db, 'vitals', $vitalsData, $vitalsRules);
        if (!$result['success']) {
            $db->rollback(); // Roll back the transaction if insertion fails
            echo json_encode(['success' => false, 'message' => "Vital submission failed: ", 'errors' => $result['errors']], JSON_PRETTY_PRINT);
            exit;
        }
        
        
        $result = DBUtil::validateAndInsert($db, 'visits', $visitData, $visitRules);
        if (!$result['success']) {
            $db->rollback(); // Roll back the transaction if insertion fails
            echo json_encode(['success' => false, 'message' => "Visit submission failed: ", 'errors' => $result['errors']], JSON_PRETTY_PRINT);
            exit;
        }

        $db->commit(); // Commit the transaction if everything is successful
        echo json_encode(['success' => true, 'message' => 'Appointment created successfully.']);
        exit;
    } catch (PDOException $e) {
        $db->rollback(); // Roll back the transaction on any PDOException
        error_log($e->getMessage());
        echo json_encode(['success' => false, 'message' => "Database operation failed:", 'errors' => $e->getMessage()], JSON_PRETTY_PRINT);
        exit;
    }


}