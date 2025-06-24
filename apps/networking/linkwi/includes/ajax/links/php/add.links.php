<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

require ('../../../../../includes/linkwi.php');

if($_POST['linkListCount'] <= 3 || $_POST['rle'] == 1){ 



if(empty(clean(sanitize($_POST['link_title'])))){ 
echo json_encode(["title_error" => "Please enter a title","error" => 'true']);
exit();
}

if(empty(clean(sanitize($_POST['link_url'])))){ 
echo json_encode(["url_error" => "Please enter a valid url","error" => 'true']);
exit();
}

if(empty($_FILES['link_file']['name'])){ 
//echo json_encode(["image_error" => "Please upload an image","error" => 'true']);
//exit();
$linkImage = '';

}else{

   $raw_img		= $_FILES['link_file']['name'];
   $img_ext 		= pathinfo($raw_img, PATHINFO_EXTENSION);	
  
   if ($_FILES['link_file']['size'] > 2000000) {
   echo json_encode(["image_error" => "The image attached is too large","error" => 'true']);
   exit();
   }
  
   //Check for right img
   $allowed_img = array('png','PNG','JPG','jpg','JPEG','jpeg');
  
   if(!in_array($img_ext, $allowed_img)){
    echo json_encode(["image_error" => "The image attached is not allowed","error" => 'true']);
    exit();
   }else{
    $new_img 		= sanitize_upload_file($raw_img);
    $new_img 		= "link-img-".rand(9999, 99999)."-".date('d-m')."." .$img_ext;
    $cl_img 		= strtolower($new_img);
    $linkImage = $cl_img;
   
    $temp_folder 	= $_FILES['link_file']['tmp_name'];
    $folder 		= "../../../../images/profile-links/";
   
    move_uploaded_file($temp_folder, $folder.$cl_img);
    }
    

}
$u = uniqid();
$v = uniqid();
$link_uniqueid = "$u$v";

$db = new dbase;
$db->query("INSERT INTO `links` (`UniqueID`, `link_img`, `link_title`, `link_url`,`link_uniqueid`) VALUES (:uid, :linkimage, :link_title, :link_url,:link_uniqueid)");
$db->bind(':uid',clean(sanitize(custom_decrypt($_POST['userid'],SECRET_KEY,SECRET_IV))),PDO::PARAM_STR);
$db->bind(':linkimage',$linkImage,PDO::PARAM_STR);
$db->bind(':link_title',clean(sanitize($_POST['link_title'])),PDO::PARAM_STR);
$db->bind(':link_url',clean(sanitize($_POST['link_url'])),PDO::PARAM_STR);
$db->bind(':link_uniqueid',$link_uniqueid,PDO::PARAM_STR);
$db->execute();
echo json_encode(["error" => '']);
$_FILES['link_file']['name'] = null;
exit();
}else{
echo json_encode(["links_error" => "Cannot add anymore links","error" => 'true']);
}

}