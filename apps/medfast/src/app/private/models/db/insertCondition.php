<?php

if (!defined('PROJECT_PATH')) {
return redirect(base_url().'/404');
}

function insertSubstanceAbuse($patientID,$tbl, $data) {
    $db = new dbase();
    $deleteQuery = 'DELETE FROM '.$tbl.' WHERE uid = :uid';
    
    try {
        $db->beginTransaction();
        $db->query($deleteQuery);
        $db->bind(':uid', $patientID, PDO::PARAM_STR);
        $db->execute();

        $insertQuery = 'INSERT INTO '.$tbl.' (uid, did, answer, result, date, input_type, datestamp) 
                        VALUES (:uid, :did, :answer, :result, :date, :input_type, :datestamp)';
        $db->query($insertQuery);

        $rowsInserted = 0;
        foreach ($data as $did => $inputs) {
            // Default values for missing fields
            $answer = $inputs['answer'] ?? 'no answer'; // Default 'no answer' if missing
            $result = $inputs['result'] ?? null;
            $date = $inputs['date'] ?? null;
            $input_type = $inputs['type'] ?? 'text';
            $datestamp = date_time('Y-m-d H:i:s'); // Current timestamp

            // Skip entry if it does not contain meaningful information
            if ($answer == 'no answer' && is_null($result) && is_null($date)) {
                continue;
            }

            $db->bind(':uid', $patientID, PDO::PARAM_STR);
            $db->bind(':did', $did, PDO::PARAM_STR);
            $db->bind(':answer', $answer, PDO::PARAM_STR);
            $db->bind(':result', $result, PDO::PARAM_STR);
            $db->bind(':date', $date, PDO::PARAM_STR);
            $db->bind(':input_type', $input_type, PDO::PARAM_STR);
            $db->bind(':datestamp', $datestamp, PDO::PARAM_STR);
            $db->execute();
            $rowsInserted++;
        }

        $db->commit();
        return ['success' => true, 'rowsInserted' => $rowsInserted];
    } catch (PDOException $e) {
        $db->rollBack();
        error_log('Insertion error: ' . $e->getMessage());
        return ['error' => 'Database error: ' . $e->getMessage()];
    }
}

// Handle POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['patientID'], $_POST['conditions'])) {
    $patientID = $_POST['patientID'];
    $tbl = $_POST['tbl'];
    $data = [];

    foreach ($_POST['conditions'] as $did => $inputs) {
        $entry = [
            'type' => $inputs['type'] ?? 'text',  // Default to 'text' if type is not provided
            'answer' => isset($inputs['answer']) ? (is_array($inputs['answer']) ? implode(',', $inputs['answer']) : $inputs['answer']) : 'no answer',
            'result' => $inputs['text'] ?? null,
            'date' => $inputs['date'] ?? null
        ];
        $data[$did] = $entry;
    }

    $result = insertSubstanceAbuse($patientID,$tbl, $data);
    echo json_encode($result);
    exit();
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid request parameters']);
    exit();
}
?>