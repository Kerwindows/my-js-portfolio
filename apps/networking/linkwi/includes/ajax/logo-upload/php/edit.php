<?php
require ('../../../../../includes/linkwi.php');

$id 		= clean(sanitize($_POST['file_id']));
$cl_name		= clean(sanitize($_POST["filename"]));



   
   	
   
    $db 		= new dbase; 
     $db->query("UPDATE `User_Files` SET `name` =  :name WHERE id = :id");
    $db->bind(':name', $cl_name, PDO::PARAM_STR);
    $db->bind(':id', $id , PDO::PARAM_STR);
    
    $run 		= $db->execute();
    if($run){
    echo json_encode(["error" => ""]); 
    
    }else{
    echo json_encode(["error" => "Error editing name"]); 
    exit();
    }