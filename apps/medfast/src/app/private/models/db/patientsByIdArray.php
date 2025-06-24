<?php 
if (!defined('PROJECT_PATH')) {
return redirect(base_url().'/404');
}
function patientsByIdArray() {
    try {
        // Initialize database connection (Assuming `dbase` class properly handles the connection)
        $db = new dbase;
        
        // Construct the query string with a safe role
        $queryString = "SELECT uid,fname,lname,image,dob,email,sex,phone,registered_on,status FROM users WHERE role = :role";
        // Prepare and execute the query
        $db->query($queryString);
        $db->bind(':role', 'patient', PDO::PARAM_STR);
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