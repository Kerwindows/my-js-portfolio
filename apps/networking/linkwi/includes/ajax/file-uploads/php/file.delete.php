<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
require ('../../../../../includes/linkwi.php');
$db                  = new dbase;

$file   =  clean($_POST["filePath"]);
$id 	=  clean($_POST["id"]);

$db 		= new dbase; 
$db->query('DELETE FROM `User_Files`  WHERE id = :id');
$db->bind(':id', $id, PDO::PARAM_STR);
$run 		= $db->execute();
 $db->closeConnection();
if($run){
    $file_path = LINKWI_FILES_PATH."/$file";
	unlink($file_path);    
	 echo json_encode(["error" => ""]); 
    }else{
    echo json_encode(["error" => "Error deleting file"]); 
}
}