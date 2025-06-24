<?php
function getConditionValues($uid,$condition_log) {
    $pdo = new dbase;

    try {
        $pdo->query("SELECT * FROM $condition_log WHERE uid = :uid");
        $pdo->bind(':uid',$uid,PDO::PARAM_STR);
        $rows = $pdo->fetchMultiple();

        if (empty($rows)) {
            return [];
        }

        $diseaseMap = [];

        foreach ($rows as $row) {
            $diseaseKey = $row['did'];  // Use 'did' as the key instead of 'id' for mapping by DID
            if (!array_key_exists($diseaseKey, $diseaseMap)) {
                $diseaseMap[$diseaseKey] = [
                    'id' => $row['id'],
                    'uid' => $row['uid'],
                    'did' => $row['did'],
                    'answer' => $row['answer'],
                    'date' => $row['date'],
                    'result' => $row['result'],
                    'input_type' => $row['input_type'],  // Assuming this is correct to include here
                    'datestamp' => $row['datestamp'],
                ];
            }
        }

        return $diseaseMap;  // Directly return the associative array keyed by 'did'
        exit();
    } catch (PDOException $e) {
        error_log("Database query error: " . $e->getMessage());  // Proper error logging
        return ['disease' => null];
    }
}