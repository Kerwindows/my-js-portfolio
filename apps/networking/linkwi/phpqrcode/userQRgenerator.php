<?php 
//require_once "../../includes/linkwi.php";

function GenerateQR($Username,$corporateUsername='',$Role='') {  
require_once 'qrlib.php';
$con=new dbase;
if($Role=='' AND $corporateUsername=''){
$qrcode = $Username."-".uniqid(rand(999,9999), true).".png";
$path = './phpqrcode/images/';
$file = $path.$qrcode;  

//Text to output 
$text = "https://linkwi.co/card/$Username";
QRcode::png($text, $file, 'L',10,2);
//png ($text, $file, ECC_LEVEL, Pixel_Size, Frame_Size)
//echo "<center><img src'".$file."'><center>";

$con->query("UPDATE `Users` SET QRCode =:qrcode WHERE Username =:Username");
$con->bind(':qrcode',$qrcode, PDO::PARAM_STR);
$con->bind(':Username',$Username, PDO::PARAM_STR);
$con->execute();
}

else{
$qrcode = $Username."-".$corporateUsername."-".uniqid(rand(999,9999), true).".png";
$path = './images/';
$file = $path.$qrcode;

// Text to output 
$text = "https://linkwi.co/card/$Username/$corporateUsername";
QRcode::png($text, $file, 'L',10,2);
// png ($text, $file, ECC_LEVEL, Pixel_Size, Frame_Size)
//echo "<center><img src'".$file."'><center>";

$con->query("UPDATE `Users` SET QRCode =:qrcode WHERE corporateUsername =:corporateUsername AND Username = :Username");
$con->bind(':qrcode',$qrcode, PDO::PARAM_STR);
$con->bind(':corporateUsername',$corporateUsername, PDO::PARAM_STR);
$con->bind(':Username',$Username, PDO::PARAM_STR);
$con->execute();
}  

}