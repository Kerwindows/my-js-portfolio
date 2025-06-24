<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

require ('../../../../../includes/linkwi.php');


if( (is_null($_FILES['link_file']['name'])) || ($_FILES['link_file']['name'] == "") || ($_POST['newLinkImageName'] == "") ){ 

$link_title = clean(sanitize($_POST['link_title']));
$link_url = clean(sanitize($_POST['link_url']));

if(empty($link_title)){ 
echo json_encode(["title_error" => "Please enter a title","error" => 'true']);
exit();
}

if(empty($link_url)){ 
echo json_encode(["url_error" => "Please enter a valid url"]);
exit();
}
    
$db 		= new dbase; 
$db->query("UPDATE links SET link_title = :link_title,link_url = :link_url WHERE id = :link_id ");
$db->bind(':link_title',$link_title,PDO::PARAM_STR);
$db->bind(':link_url',$link_url,PDO::PARAM_STR);
$db->bind(':link_id',$_POST['link_id'],PDO::PARAM_STR);
$db->execute();
$db->closeConnection();
    
echo json_encode(["newImage" => '',"error" => ""]);    

}else{
   $raw_img		= $_FILES['link_file']['name'];
   $img_ext 		= pathinfo(strtolower($raw_img), PATHINFO_EXTENSION);	
  
   if ($_FILES['link_file']['size'] > 300000) {
  echo json_encode(["image_error" => "The image attached is too large","error" => 'true']);
   exit();
   }
  
   //Check for right img
   $allowed_img = array('png','jpg','jpeg');
  
   if(!in_array($img_ext, $allowed_img)){
    echo json_encode(["image_error" => "The image attached is not allowed","error" => 'true']);
    exit();
   }else{
    $new_img 		= sanitize_upload_file($raw_img);
    $new_img 		= "link-img-".rand(9999, 99999)."-".date('d-m')."." .$img_ext;
    $cl_img 		= strtolower($new_img);
      
    $temp_folder 	= $_FILES['link_file']['tmp_name'];
    $folder 		= "../../../../images/profile-links/";
   
    move_uploaded_file($temp_folder, $folder.$cl_img);
    }


$db 		= new dbase; 
    
$db->query("UPDATE links SET link_title = :link_title,link_url = :link_url,link_img = :cl_img WHERE id = :link_id ");
$db->bind(':link_title',$link_title,PDO::PARAM_STR);
$db->bind(':link_url',$link_url,PDO::PARAM_STR);
$db->bind(':cl_img',$cl_img,PDO::PARAM_STR);
$db->bind(':link_id',$_POST['link_id'],PDO::PARAM_STR);
$db->execute();
$db->closeConnection();
echo json_encode(["newImage" => $cl_img,"error" => ""]);   
}

}