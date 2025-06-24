<?php
if (!defined('PROJECT_PATH')) {
return redirect(base_url().'/404');
}
header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once(PRIVATE_CLASSES_PATH . "/DBUtil.php");

    $validationRules = [
    
       
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
        'status' => [
            'type' => 'string',
            'regex' =>'/^(Missed|Due)$/',
            'optional' => true,
            'errorMessage' => 'Invalid status'
        ],
        'date_time_stamp' => [
            'type' => 'string',
            'optional' => false,
        ],
    ];

    $userData = [
        'did' => filter_input(INPUT_POST, 'did', FILTER_SANITIZE_STRING),
        'start_date' => filter_input(INPUT_POST, 'start_date', FILTER_SANITIZE_STRING),
        'end_date' => filter_input(INPUT_POST, 'end_date', FILTER_SANITIZE_STRING),
        'reason' => filter_input(INPUT_POST, 'reason', FILTER_SANITIZE_STRING),
        'summary' => filter_input(INPUT_POST, 'summary', FILTER_SANITIZE_STRING),
        'status' => filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING),
        'date_time_stamp'=> date_time('Y-m-d H:i:s')
    ];
    
    $whereClause = ['id' => filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT)];

    try {
    $db = new dbase;
    $db->beginTransaction();

    // Insert or update user data
    $result = DBUtil::validateAndUpdate($db, 'appointments', $userData, $validationRules, $whereClause);
    if (!$result['success']) {
        echo json_encode(['success' => false, 'message' => "Appointment update failed: ", 'errors' => $result['errors']], JSON_PRETTY_PRINT);
        $db->rollback(); // Roll back the transaction if update fails
        exit;
    }

    $db->commit();
    echo json_encode(['success' => true, 'message' => 'Appointment updated successfully.','isUpdate' => $isUpdate = true]);
    exit;
} catch (PDOException $e) {
    $db->rollback(); // Roll back the transaction on PDOException
    error_log($e->getMessage());
    echo json_encode(['success' => false, 'message' => "Database operation failed: ", 'errors' => $e->getMessage()], JSON_PRETTY_PRINT);
    exit;
} catch (Exception $e) {
    // Optional: Handle non-PDO exceptions if other parts of your code throw them
    $db->rollback(); // Roll back the transaction on general exception
    error_log($e->getMessage());
    echo json_encode(['success' => false, 'message' => "An error occurred: ", 'errors' => $e->getMessage()], JSON_PRETTY_PRINT);
    exit;
}



}