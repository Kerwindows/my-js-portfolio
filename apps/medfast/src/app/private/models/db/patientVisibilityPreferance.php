<?php
if (!defined('PROJECT_PATH')) {
return redirect(base_url().'/404');
}
function patientVisibilityPreferance($uid){
$conn = new dbase;
        $conn->query("SELECT * FROM user_visibility_preferences WHERE uid = :uid");
        $conn->bind(':uid', $uid, PDO::PARAM_STR);
        $preference = $conn->fetchSingle();
        if(!empty($preference)){
        return $preference;
        }else{
        return [];
        }
        }