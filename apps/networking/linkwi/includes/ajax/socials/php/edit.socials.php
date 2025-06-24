<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
require('../../../../../includes/linkwi.php');

if (custom_decrypt($_POST['chk'],SECRET_KEY,SECRET_IV)  == 1){
  $check = true;
  }
else {
    $check = false;
}

$db         = new dbase;
$db->query("SELECT * FROM `socials` WHERE `UniqueID` = :uid ");
$db->bind(':uid',custom_decrypt($_POST['userid'],SECRET_KEY,SECRET_IV),PDO::PARAM_STR);
$getSocials = $db->fetchMultiple();
$db->closeConnection();


if(empty($getSocials)){
}else{

foreach ($getSocials as $social) {
$id = $social['id'];
$link = $social['social_link'];
$name = $social['social_name'];
$name_slug = strtolower($social['social_name']);
$icon = $social['fa_icon'];
$userid = $_POST['userid'];

echo "<div class='popup__social'>
      <span class='popup__social-icon relative'>
      <i class='".$icon."'></i>
      <div class='delete-social' data-id='".$id."'><i class='fa fa-times' aria-hidden='true'></i></div>
      </span>
      <input id='".$name_slug."-input' class='popup__form-input popup__form-input_type_".$name_slug."' data-id='".$id."' data-name='".$name."' data-icon='".$icon."'  name='".$name_slug."' type='url' placeholder='".$name." url' value='".$link."' />
      </div>
      <span class='input_error ".$name_slug."-input-error'></span>";
   } 
}
}
?>