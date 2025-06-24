<?php 


require "../../includes/linkwi.php";

require_once 'qrlib.php';

$Username = "FMohammed";

function GenerateQR($Username) {
  $db = new dbase;
  $db->query("SELECT Username FROM Users WHERE Username =:username");
  $db->bind(':username', $Username, PDO::PARAM_STR);
   $QR = $db->fetchSingle();  

  
  
$qrcode = $QR['Username'].".png";
$id = $QR['Username'];
$path = 'images/';
$file = $path.$QR['Username'].".png";  

// Text to output 

$text = "https://linkwi.co/card/".$QR['Username']."";


QRcode::png($text, $file, 'L',10,2);
// png ($text, $file, ECC_LEVEL, Pixel_Size, Frame_Size)
//echo "<center><img src'".$file."'><center>";



$db->query("UPDATE `Users` SET QRCode =:qrcode WHERE Username =:username");
$db->bind(':qrcode',$qrcode, PDO::PARAM_STR);
$db->bind(':username',$Username, PDO::PARAM_STR);
$db->execute();
  
  
   
    
  
  
  
 
}


GenerateQR($Username);


?>