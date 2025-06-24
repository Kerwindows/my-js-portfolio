<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

require ('../../../../includes/linkwi.php');

$db = new dbase;
$db->query("UPDATE Users SET `color` ='".$_POST['text']."' WHERE UniqueID='".custom_decrypt($_POST['id'],SECRET_KEY,SECRET_IV)."'");
$db->execute();
echo json_encode(["error" => ""]); 
}