<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

require ('../../../../../includes/linkwi.php');

$db = new dbase;
$db->query("UPDATE Users SET `Bio` ='".clean(sanitize($_POST['bio']))."' WHERE UniqueID='".custom_decrypt($_POST['userid'],SECRET_KEY,SECRET_IV)."'");
if($db->execute()){
echo json_encode(["error" => ""]);
}
$db->closeConnection();
}