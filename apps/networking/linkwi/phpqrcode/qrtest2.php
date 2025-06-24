<?php
ob_start();
session_start();
require 'qrlib.php';

if(!empty($_POST['submit'])){
 $name = $_POST['name'];
 $nooftickets = $_POST['nooftickets'];
 //expiry 1 year
$expiry = date('d M Y', strtotime('+1 years'));

$path = 'images/';
$file = $path.uniqid()."-".str_replace(' ', '-', $name).".png";


$text = "$name";
$text .= "Ticket Count $nooftickets";

QRcode ::png($text,$file, 'L',10,0);


$_SESSION["name"] = $name;
$_SESSION["nooftickets"] = $nooftickets;
$_SESSION["expiry"] = $expiry;
$_SESSION["file"] = $file;

header('Location: completed.php');
exit;
}else{
echo"Something went terribly wrong.";
}

?>