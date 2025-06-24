<?php
if (!defined('PROJECT_PATH')) {
return redirect(base_url().'/404');
}
function getDoctors(){
	try {
	    $pdo = new dbase;
	    $pdo->query("SELECT uid,title,fname,lname FROM users WHERE role = 'doctor'");
	    return $results = $pdo->fetchMultiple();
	    exit();
	
	} catch (PDOException $e) {
	    die("Could not connect to the database $dbname :" . $e->getMessage());
	}
}