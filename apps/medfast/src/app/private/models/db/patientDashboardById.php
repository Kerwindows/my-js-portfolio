<?php
if (!defined('PROJECT_PATH')) {
return redirect(base_url().'/404');
}
function patientDashboardByIdArray($uid)
{
    try {
        $db = new dbase; // Assuming `dbase` handles DB connections properly.

        // SQL query to fetch user details and their latest vitals.
        $queryString = "
        SELECT  p.uid,
            p.email, p.title, p.fname, p.lname, p.dob, p.sex, p.image, p.role, p.registered_on,p.blood_type,
            v.cholesterol, v.blood_pressure, v.glucose, v.heart_rate, v.sleep, v.temperature, v.weight, v.height
        FROM 
            users p
        LEFT JOIN 
            (SELECT * FROM vitals v1 WHERE v1.id IN (SELECT MAX(v2.id) FROM vitals v2 GROUP BY v2.uid)) v 
            ON p.uid = v.uid 
        WHERE 
            p.uid = :uid";

        $db->query($queryString);
        $db->bind(':uid', $uid, PDO::PARAM_STR);
        $userData = $db->fetchSingle();


        // Early return if no user data found.
        if (empty($userData)) {
            return [];
        }
        // Fetching allergies.
        $db->query("SELECT allergy, symptom FROM allergies WHERE uid = :uid");
        $db->bind(':uid', $userData['uid'], PDO::PARAM_STR);
        $allergies = $db->fetchMultiple();

        // Fetching medications.
        $db->query("SELECT icon, medicine, dosage, administered_on FROM medications WHERE uid = :uid");
        $db->bind(':uid', $userData['uid'], PDO::PARAM_STR);
        $medications = $db->fetchMultiple();


        $db->query("SELECT 
    a.uid, 
    CONCAT(u.title, ' ', u.fname, ' ', u.lname) AS name, 
    u.image, 
    a.reason, 
    a.start_date
FROM appointments a
JOIN users u ON a.did = u.uid
WHERE a.start_date > :current_date AND a.uid = :uid
ORDER BY a.start_date ASC LIMIT 3");
        $db->bind(':current_date', date_time('Y-m-d H:i:s'), PDO::PARAM_STR);
        $db->bind(':uid', $userData['uid'], PDO::PARAM_STR);
        $last_3_upcoming_appointments = $db->fetchMultiple();


        $db->query("SELECT 
    a.uid, 
    CONCAT(u.title, ' ', u.fname, ' ', u.lname) AS name, 
    u.image, 
    a.reason, 
    a.start_date
FROM appointments a
JOIN users u ON a.did = u.uid
WHERE a.start_date < :current_date AND a.status = 'Missed' AND a.uid = :uid
ORDER BY a.start_date DESC
LIMIT 3");
        $db->bind(':current_date', date_time('Y-m-d H:i:s'), PDO::PARAM_STR);
        $db->bind(':uid', $userData['uid'], PDO::PARAM_STR);
        $last_3_missed_appointments = $db->fetchMultiple();


        $db->query("SELECT 
    a.uid, 
    CONCAT(u.title, ' ', u.fname, ' ', u.lname) AS name, 
    u.image, 
    a.reason, 
    a.start_date
FROM appointments a
JOIN users u ON a.did = u.uid
WHERE a.start_date < :current_date AND a.status <> 'Missed' AND a.uid = :uid
ORDER BY a.start_date DESC
LIMIT 3");


        $db->bind(':current_date', date_time('Y-m-d H:i:s'), PDO::PARAM_STR);
        $db->bind(':uid', $userData['uid'], PDO::PARAM_STR);
        $last_3_passed_appointments = $db->fetchMultiple();

        // Initialize user array with basic details and vitals.
        $loggedInUserArray = [
            'uid' => $userData['uid'],
            'email' => $userData['email'],
            'title' => $userData['title'],
            'fname' => $userData['fname'],
            'lname' => $userData['lname'],
            'dob' => $userData['dob'],
            'sex' => $userData['sex'],
            'blood_type' => $userData['blood_type'],
            'image' => $userData['image'],
            'role' => $userData['role'] ?? 'default_role', // Default role if not defined
            'registered_on' => $userData['registered_on'],
            'vitals' => [
                'cholesterol' => $userData['cholesterol'],
                'blood_pressure' => $userData['blood_pressure'],
                'glucose' => $userData['glucose'],
                'heart_rate' => $userData['heart_rate'],
                'sleep' => $userData['sleep'],
                'temperature' => $userData['temperature'],
                'weight' => $userData['weight'],
                'height' => $userData['height'],
            ],
            'allergies' => [],
            'medications' => [],
            'appointments' => [
                'last_3_upcoming_appointments' => [],
                'last_3_missed_appointments' => [],
                'last_3_passed_appointments' => []
            ]
        ];

        foreach ($allergies as $allergy) {
            $loggedInUserArray['allergies'][] = array_merge(['uid' => $userData['uid']], $allergy);
        }


        foreach ($medications as $medication) {
            $loggedInUserArray['medications'][] = array_merge(['uid' => $userData['uid']], $medication);
        }

        foreach ($last_3_upcoming_appointments  as $upcoming_appointment) {
            $loggedInUserArray['appointments']['last_3_upcoming_appointments'][] = array_merge(['uid' => $userData['uid']], $upcoming_appointment);
        }

        foreach ($last_3_missed_appointments  as $last_3_missed_appointment) {
            $loggedInUserArray['appointments']['last_3_missed_appointments'][] = array_merge(['uid' => $userData['uid']], $last_3_missed_appointment);
        }

        foreach ($last_3_passed_appointments  as $last_3_passed_appointment) {
            $loggedInUserArray['appointments']['last_3_passed_appointments'][] = array_merge(['uid' => $userData['uid']], $last_3_passed_appointment);
        }

        return $loggedInUserArray;
        exit();
    } catch (Exception $e) {
        error_log('Error fetching user details: ' . $e->getMessage());
        return [];
    }
}