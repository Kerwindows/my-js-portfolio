<?php
if (!defined('PROJECT_PATH')) {
    redirect('/404');
}
function getUserVisibilityPreferencesArray($uid) {
    try {
        $db = new dbase; // Assuming `dbase` handles DB connections properly.

        
        // Optimized SQL query with JOINs to fetch user details, vitals, allergies, medications, next of kins, and emergency contacts
        $queryString = "SELECT * FROM user_visibility_preferences WHERE  uid = :uid";

        $db->query($queryString);
        $db->bind(':uid', $uid, PDO::PARAM_STR);
        $results = $db->fetchSingle();

        if (empty($results)) {
            return [];
        }else{
           return $results;
        }
    } catch (Exception $e) {
        error_log('Error fetching patient profile: ' . $e->getMessage());
        return [];
    }
}