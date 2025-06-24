<?php
if (!defined('PROJECT_PATH')) {
return redirect(base_url().'/404');
}

function getPatientAppointmentById($id)
{
    try {
        $db = new dbase; // Assuming `dbase` handles DB connections properly.

        // SQL query to fetch appointment details, associated vitals, and visit records.
        $queryString = "
        SELECT 
            p.id AS patient_id, 
            p.uid AS patient_uid, 
            p.fname, 
            p.lname, 
            p.image, 
            p.registered_on,
            p.role,
            a.id AS appointment_id, 
            a.did AS doctor_id, 
            a.start_date, 
            a.end_date, 
            a.summary, 
            a.reason, 
            a.schedule, 
            a.status, 
            a.date_time_stamp AS appointment_time_stamp,
            v.id AS visit_id, 
            v.type_of_visit, 
            v.chief_complaint, 
            v.notes AS visit_notes, 
            v.inventory_request, 
            v.inventory_result, 
            v.diagnosis, 
            v.treatment, 
            v.seenby, 
            v.followup_datetime, 
            v.total_cost, 
            v.amt_paid, 
            v.balance, 
            v.datetime AS visit_datetime,
            vt.id AS vital_id, 
            vt.cholesterol, 
            vt.blood_pressure, 
            vt.glucose, 
            vt.heart_rate, 
            vt.sleep, 
            vt.temperature, 
            vt.weight, 
            vt.height,
            vt.date_time_stamp AS vital_time_stamp
        FROM 
            users p
        LEFT JOIN 
            appointments a ON p.uid = a.uid
        LEFT JOIN 
            visits v ON a.id = v.aid
        LEFT JOIN 
            vitals vt ON a.id = vt.aid
        WHERE 
            a.id = :id";

        $db->query($queryString);
        $db->bind(':id', $id, PDO::PARAM_STR);
        $userData = $db->fetchSingle();

        // Early return if no data found.
        if (empty($userData)) {
            return [];
        }
        
        return $userData;
    } catch (Exception $e) {
        error_log('Error fetching patient appointment details: ' . $e->getMessage());
        return [];
    }
}
?>