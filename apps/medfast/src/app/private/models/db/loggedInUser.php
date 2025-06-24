<?php
if (!defined('PROJECT_PATH')) {
return redirect(base_url().'/404');
}
function loggedInUserArray($email) {
    try {
         $db = new dbase; // Assuming `dbase` handles DB connections properly.

        // SQL query to fetch user details and their latest vitals.
        $queryString = "
        SELECT  p.uid,
            p.email, p.title, p.fname, p.lname, p.dob, p.sex, p.image, p.role, p.registered_on,
            v.cholesterol, v.blood_pressure, v.glucose, v.heart_rate, v.sleep, v.temperature, v.weight, v.height
        FROM 
            users p
        LEFT JOIN 
            (SELECT * FROM vitals v1 WHERE v1.id IN (SELECT MAX(v2.id) FROM vitals v2 GROUP BY v2.uid)) v 
            ON p.uid = v.uid 
        WHERE 
            p.email = :email";

        $db->query($queryString);
        $db->bind(':email', $email, PDO::PARAM_STR);
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
        
         // Initialize user array with basic details and vitals.
        $loggedInUserArray = [
            'uid' => $userData['uid'],
            'email' => $userData['email'],
            'title' => $userData['title'],
            'fname' => $userData['fname'],
            'lname' => $userData['lname'],
            'dob' => $userData['dob'],
            'sex' => $userData['sex'],
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
                'last_3_onschedule_appointments'=>[],
		'last_3_missed_appointments'=>[],
		'last_3_passed_appointments'=>[]
            ]
        ];
        
        foreach ($allergies as $allergy) {
            $loggedInUserArray['allergies'][] = array_merge(['uid' => $userData['uid']], $allergy);
        }


        foreach ($medications as $medication) {
             $loggedInUserArray['medications'][] = array_merge(['uid' => $userData['uid']], $medication);
        }

        return $loggedInUserArray;
    } catch (Exception $e) {
        error_log('Error fetching user details: ' . $e->getMessage());
        return [];
    }
}