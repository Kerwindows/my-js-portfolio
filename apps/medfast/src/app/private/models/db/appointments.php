<?php 
if (!defined('PROJECT_PATH')) {
    redirect(base_url().'/404');
}
function appointmentsArray() {
    try {
        // Initialize database connection (Assuming `dbase` class properly handles the connection)
        $db = new dbase;
        $queryString = "SELECT a.id,
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
	    d.uid AS doctor_uid,
	    d.title AS doctor_title,
	    d.image AS doctor_image,
	    d.fname AS doctor_fname, 
	    d.lname AS doctor_lname, 
	    d.phone AS doctor_phone, 
	    d.email AS doctor_email
	FROM appointments a
	JOIN users p ON a.uid = p.uid -- Join for patient info
	JOIN users d ON a.did = d.uid -- Join for doctor info
	WHERE a.start_date > :current_date
	ORDER BY a.start_date ASC";
        
       
        // Prepare and execute the query
        $db->query($queryString);
        $db->bind(':current_date', date_time('Y-m-d H:i:s'), PDO::PARAM_STR);
        $result = $db->fetchMultiple();
        if(!empty($result)){
        return $result;
        } else {
            return [];
        }
    } catch (Exception $e) {
        // Handle any exceptions (e.g., log them and return an error message or empty array)
        error_log($e->getMessage());
        return [];
    }
}