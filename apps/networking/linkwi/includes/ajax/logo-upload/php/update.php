<?php
require ('../../../../../includes/linkwi.php');

$userid                 = clean(sanitize(custom_decrypt($_POST['userid'],SECRET_KEY,SECRET_IV)));
$email			= clean(sanitize($_POST["email"]));
$contact		= clean(sanitize($_POST["contact"]));

if( (is_null($_FILES['userinfo_img']['name'])) || ($_FILES['userinfo_img']['name'] == "")){ 


$db 		= new dbase; 
$db->query('UPDATE `Users` SET 
BusinessContact		= :contact, 
BusinessEmailAddress		= :email
WHERE UniqueID 		= :userid');

$db->bind(':userid', $userid, PDO::PARAM_STR);
$db->bind(':contact', $contact, PDO::PARAM_STR);
$db->bind(':email', $email, PDO::PARAM_STR);
$db->execute();
echo json_encode(["newImage" => '',"error" => ""]);   

}else{


$folderPath = LINKWI_IMG_PATH . '/profile-logos/';


$image_parts = explode(";base64,", $_POST['image']);
$image_type_aux = explode("image/", $image_parts[0]);
$image_type = $image_type_aux[1];
$image_base64 = base64_decode($image_parts[1]);
$file = $userid .'-logo-'.rand(999, 9999) . '.png';
$file = str_replace(' ', '-', $file);
$fileupload = $folderPath . $file;
file_put_contents($fileupload, $image_base64);



/*
$raw_img		= $_FILES['userinfo_img']['name'];
   $img_ext 		= pathinfo($raw_img, PATHINFO_EXTENSION);	
   //1 mb
   if ($_FILES['userinfo_img']['size'] > 1000000) {
   echo json_encode(["newImage" => '',"error" => "The img attached is too large"]); 
   exit();
   die;
   }
  
   //Check for right img
   $allowed_img = array('png','PNG','JPG','jpg','JPEG','jpeg');
  
   if(!in_array($img_ext, $allowed_img)){
    echo json_encode(["newImage" => '',"error" => "The img attached is not allowed"]); 
    exit();
   }else{
    $new_img 		= sanitize_upload_file($raw_img);
    $new_img 		= $userid .'-logo-'.rand(999, 9999). '.' .$img_ext;
    $cl_img 		= strtolower($new_img);
   
   
    $temp_folder 	= $_FILES['userinfo_img']['tmp_name'];
    $folder 		= LINKWI_IMG_PATH . '/profile-logos/';
   
    move_uploaded_file($temp_folder, $folder.$cl_img);
    //unlink(LINKWI_IMG_PATH . '/profile-logos/'.$_POST['oldImage']); 
    }
*/
$db 		= new dbase; 
$db->query('UPDATE `Users` SET 
Contact		= :contact, 
EmailAddress		= :email,
Image_one	= :logo
WHERE UniqueID 		= :userid');

$db->bind(':userid', $userid, PDO::PARAM_STR);
$db->bind(':contact', $contact, PDO::PARAM_STR);
$db->bind(':email', $email, PDO::PARAM_STR);
$db->bind(':logo', $file, PDO::PARAM_STR);
$db->execute();
echo json_encode(["newImage" => $file,"error" => ""]); 
}