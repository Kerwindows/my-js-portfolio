<?php 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
require "includes/linkwi.php";
    // Captcha verification is Correct. Final Code Execute here!		
	$name = clean(sanitize($_POST["name"]));
    	$email = clean(sanitize($_POST["email"]));
    	$message= clean(sanitize($_POST["message"])); 
   	$db = new dbase;
        $db->query("INSERT INTO `contact_us` (`name`, `email`, `message`) VALUES (:name,:email,:message)");
        $db->bind(':name',$name,PDO::PARAM_STR);	
        $db->bind(':email',$email,PDO::PARAM_STR);
        $db->bind(':message',$message,PDO::PARAM_STR);
	if($db->execute()){		
	echo json_encode(["error"=>""]);
	}
}