<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

require ('../../../../../includes/linkwi.php');

$db = new dbase; 
$db->query("Select * FROM `links` WHERE `links`.`id` = '".$_POST['id']."'");
$linkz = $db->fetchSingle();

$uniqueID = $linkz["UniqueID"];
$link_title = $linkz["link_title"];
$link_url = $linkz["link_url"];
$link_uniqueid = $linkz["link_uniqueid"];
$count = $linkz["link_count"];

$db->query("INSERT INTO Link_Archive (`UniqueID`, `link_title`, `link_url`,`link_uniqueid`,`Count`) VALUES ('$uniqueID','$link_title','$link_url','$link_uniqueid','$count')");
$db->execute();

    
$db->query("DELETE FROM `links` WHERE `links`.`id` = '".$_POST['id']."'");
if($db->execute()){
	if (is_dir(LINKWI_IMG_PATH . '/profile-links/'.$_POST['imagePath'])) {
	unlink(LINKWI_IMG_PATH . '/profile-links/'.$_POST['imagePath']);   
	}
}
    

}