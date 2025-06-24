<?php 
if (!defined('PROJECT_PATH')) {
return redirect(base_url().'/404');
}

function getStaticHealthData($uid) {
$db = new dbase;
        // SQL query to select all vitals data
        $sql = "SELECT uid, date_time_stamp, cholesterol, blood_pressure, glucose, heart_rate, sleep, temperature, weight, height 
                FROM vitals WHERE uid = :uid
                ORDER BY uid, date_time_stamp ASC";
        
        $db->query($sql);   // Prepare SQL statement
        $db->bind(':uid',$uid,PDO::PARAM_STR);
        $result = $db->fetchMultiple();  // Execute query and fetch data
        
        $formattedData = [];
        foreach ($result as $row) {
            // Create nested array structure
            $formattedData[$row['date_time_stamp']] = [
                'vitals' => [
                    'cholesterol'    => $row['cholesterol'],
                    'blood_pressure' => $row['blood_pressure'],
                    'glucose'        => $row['glucose'],
                    'heart_rate'     => $row['heart_rate'],
                    'sleep'          => $row['sleep'],
                    'temperature'    => $row['temperature'],
                    'weight'         => $row['weight'],
                    'height'         => $row['height']
                ]
            ];
        }
        
        return $formattedData;
}