<?php
if (!defined('PROJECT_PATH')) {
return redirect(base_url().'/404');
}

function getPatientAppointmentsByUid($uid) {
    try {
        $db = new dbase; // Assuming `dbase` handles DB connections properly.

        // SQL query to fetch appointment details along with patient and doctor details.
        $queryString = "SELECT 
            a.id AS appointment_id,
            a.start_date,
            a.end_date,
            a.summary,
            a.reason,
            a.schedule,
            a.status,
            a.date_time_stamp,
            p.uid AS patient_uid,
            p.image AS patient_image,
            p.fname AS patient_fname,
            p.lname AS patient_lname,
            p.phone AS patient_phone,
            p.email AS patient_email,
            p.role AS patient_role,
            p.registered_on AS patient_registered_on,
            d.uid AS doctor_uid,
            d.title AS doctor_title,
            d.image AS doctor_image,
            d.fname AS doctor_fname,
            d.lname AS doctor_lname,
            d.phone AS doctor_phone,
            d.email AS doctor_email
        FROM appointments a
        JOIN users p ON a.uid = p.uid
        JOIN users d ON a.did = d.uid
        WHERE p.uid = :uid
        ORDER BY a.start_date DESC";

        // Prepare and execute the query
        $db->query($queryString);
        $db->bind(':uid', $uid, PDO::PARAM_STR);
        $results = $db->fetchMultiple();

        // Early return if no data found.
        if (empty($results)) {
            return [];
        }

        // Initialize a variable to store the patient details and appointment details.
        $patientData = null;
        $appointments = [];

        foreach ($results as $row) {
            if ($patientData === null) {
                // Initialize patient data once
                $patientData = [
                    'uid' => $row['patient_uid'],
                    'role' => $row['patient_role'],
                    'fname' => $row['patient_fname'],
                    'lname' => $row['patient_lname'],
                    'image' => $row['patient_image'],
                    'phone' => $row['patient_phone'],
                    'email' => $row['patient_email'],
                    'registered_on' => $row['patient_registered_on'],
                    'appointment_details' => []
                ];
            }

            // Append each appointment to the appointment_details array
            $patientData['appointment_details'][] = [
                'appointment_id' => $row['appointment_id'],
                'doctor_uid' => $row['doctor_uid'],
                'doctor_title' => $row['doctor_title'],
                'doctor_fname' => $row['doctor_fname'],
                'doctor_lname' => $row['doctor_lname'],
                'doctor_image' => $row['doctor_image'],
                'doctor_phone' => $row['doctor_phone'],
                'doctor_email' => $row['doctor_email'],
                'start_date' => $row['start_date'],
                'end_date' => $row['end_date'],
                'summary' => $row['summary'],
                'reason' => $row['reason'],
                'schedule' => $row['schedule'],
                'status' => $row['status'],
                'date_time_stamp' => $row['date_time_stamp']
            ];
        }

        return $patientData; // Return the structured patient data
    } catch (Exception $e) {
        error_log('Error fetching appointment data: ' . $e->getMessage());
        return [];
    }
}
?>