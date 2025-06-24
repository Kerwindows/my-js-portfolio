<?php
require ('../../../../../includes/linkwi.php');

if($_POST){ 
$db = new dbase;
$db->query("INSERT INTO `waiting_list` (`email`,`datestamp`) VALUES ('".clean(sanitize($_POST['w_email']))."','{$_POST['postDate']}' )");
$db->execute();
$db->closeConnection();
echo json_encode(["error" => '']);
exit();
}else{
echo json_encode(["error" => "Something went wrong, please try again later"]);
}


?>