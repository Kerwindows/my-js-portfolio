<?php
require ('../../../includes/linkwi.php');

print "<h2>Profile Images</h2>";


$get = new dbase;
$get->query("SELECT ProfileImage FROM Users WHERE ProfileImage != 'default.png'");
$showImages = $get->fetchMultiple();
foreach($showImages as $showImage){
$image[] = $showImage['ProfileImage'];
}

$filespath = (LINKWI_IMG_PATH ."/profile-images/");
// (A) GET ALL FILES + FOLDERS
$contents = scandir($filespath);

// PASS IN A SECOND PARAMETER TO SORT
//$contents = scandir($target, SCANDIR_SORT_DESCENDING);
//$contents = scandir($target, SCANDIR_SORT_NONE);

// (B) LOOP THROUGH ALL FILES + FOLDERS
foreach ($contents as $c) {
  if ($c!="." && $c!="..") {
   // echo is_dir($c) ? "DIR" : "FILE" ;
    //echo " - $c<br>";
    
    if (in_array($c, $image)) {
    echo "<img src='../../../linkwi/images/profile-images/$c' alt='' width='79px' />";
    echo $c."- DO NOT DELETE<br>";
}else{
echo "<img src='../../../linkwi/images/profile-images/$c' alt='' width='45px' />";
echo $c."- <span style='color:red'>DELETE</span><br>";
}
  }
}