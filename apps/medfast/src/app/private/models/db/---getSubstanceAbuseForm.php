<?php
function getSubstanceAbuseForm() {
    $pdo = new dbase; 

    try {
        $pdo->query("SELECT * FROM substance_abuse");
        $rows = $pdo->fetchMultiple();

        if (empty($rows)) {
            return ['disease' => null];
        }

        $diseaseMap = [];

        foreach ($rows as $row) {
            $diseaseKey = $row['id'];
            if (!array_key_exists($diseaseKey, $diseaseMap)) {
                $diseaseMap[$diseaseKey] = [
                    'id' => $row['id'],
                    'did' => $row['did'],
                    'has_note' => $row['has_note'],
                    'input_type' => $row['input_type'],
                    'note_type' => $row['note_type'],
                    'input_responses' => $row['input_responses'], // You might want to json_decode this if it's a JSON string
                    'disease' => $row['disease'],
                    'level' => $row['level'],
                ];
            }
        }

        return array_values($diseaseMap); // Converts the associative array back into a sequential array
        exit();
    } catch (PDOException $e) {
        // Handle error
        error_log("Database query error: " . $e->getMessage());
        return ['disease' => null];
    }
}