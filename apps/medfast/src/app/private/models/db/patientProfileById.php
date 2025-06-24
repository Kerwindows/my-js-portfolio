<?php
if (!defined('PROJECT_PATH')) {
return redirect(base_url().'/404');
}
function patientProfileByIdArray($uid) {
    try {
        $db = new dbase; // Assuming `dbase` handles DB connections properly.

        
        // Optimized SQL query with JOINs to fetch user details, vitals, allergies, medications, next of kins, and emergency contacts
        $queryString = "
        SELECT  
            p.*,
            v.cholesterol, v.blood_pressure, v.glucose, v.heart_rate, v.sleep, v.temperature, v.weight, v.height,
            a.allergy, a.symptom,
            m.icon, m.medicine, m.dosage, m.administered_on,
            nok.fname AS nok_fname, nok.lname AS nok_lname, nok.relationship AS nok_relationship, nok.phone AS nok_phone,
            ec.fname AS ec_fname, ec.lname AS ec_lname, ec.relationship AS ec_relationship, ec.phone AS ec_phone
        FROM 
            users p
        LEFT JOIN 
            (SELECT * FROM vitals WHERE id IN (SELECT MAX(id) FROM vitals GROUP BY uid)) v ON p.uid = v.uid
        LEFT JOIN allergies a ON p.uid = a.uid
        LEFT JOIN medications m ON p.uid = m.uid
        LEFT JOIN next_of_kins nok ON p.uid = nok.uid
        LEFT JOIN emergency_contacts ec ON p.uid = ec.uid
        WHERE 
            p.uid = :uid
        ";

        $db->query($queryString);
        $db->bind(':uid', $uid, PDO::PARAM_STR);
        $results = $db->fetchMultiple();

        if (empty($results)) {
            return [];
        }

        // Initialize arrays to hold the distinct data entries
        $profile = [];
        $allergies = [];
        $medications = [];

        // Iterate through the results and populate the respective arrays
        foreach ($results as $row) {
            if (empty($profile)) {
                $profile = [
                    // Extract only the first instance of user data and vitals
                    'uid' => $row['uid'],
                    'email' => $row['email'],
                    'title' => $row['title'],
            'fname' => $row['fname'],
            'mname' => $row['mname'],
            'alias' => $row['alias'],
            'lname' => $row['lname'],
            'phone' => $row['phone'],
            'address' => $row['address'],
            'dob' => $row['dob'],
            'blood_type' => $row['blood_type'],
            'sex' => $row['sex'],
            'image' => $row['image'],
            'role' => $row['role'] ?? 'default_role', // Default role if not defined
            'postal_code' => $row['postal_code'],
            'religion' => $row['religion'],
            'union_status' => $row['union_status'],
            'city' => $row['city'],
            'town' => $row['town'],
            'country' => $row['country'],
            'ethnicity' => $row['ethnicity'],
            'mother_maiden_name' => $row['mother_maiden_name'],
            'about' => $row['about'],
            'occupation' => $row['occupation'],
            'registered_on' => $row['registered_on'],
                    'status' => 'active', // Assuming 'status' should be extracted similarly
                    'vitals' => [
                        'cholesterol' => $row['cholesterol'],
	                'blood_pressure' => $row['blood_pressure'],
	                'glucose' => $row['glucose'],
	                'heart_rate' => $row['heart_rate'],
	                'sleep' => $row['sleep'],
	                'temperature' => $row['temperature'],
	                'weight' => $row['weight'],
	                'height' => $row['height'],
                    ],
                    'allergies' => [],
                    'medications' => [],
                    'next_of_kin' => [
                    	'fname' => $row['nok_fname'], 
                    	'lname' => $row['nok_lname'], 
                    	'relationship' => $row['nok_relationship'], 
                    	'phone' => $row['nok_phone']
                    ],
                    'emergency_contact' => [
                    	'fname' => $row['ec_fname'], 
                    	'lname' => $row['ec_lname'], 
                    	'relationship' => $row['ec_relationship'], 
                    	'phone' => $row['ec_phone']
                    ]
                ];
            }
            // Append to allergies, medications, next_of_kin, and emergency_contact as necessary
            if ($row['allergy'] && !array_key_exists($row['allergy'], $allergies)) {
                $allergies[$row['allergy']] = ['allergy' => $row['allergy'], 'symptom' => $row['symptom']];
            }
            if ($row['medicine'] && !array_key_exists($row['medicine'], $medications)) {
                $medications[$row['medicine']] = ['icon' => $row['icon'], 'medicine' => $row['medicine'], 'dosage' => $row['dosage'], 'administered_on' => $row['administered_on']];
            }
        }

        // Attach the aggregated data to the profile
        $profile['allergies'] = array_values($allergies);
        $profile['medications'] = array_values($medications);

        return $profile;
    } catch (Exception $e) {
        error_log('Error fetching patient profile: ' . $e->getMessage());
        return [];
    }
}