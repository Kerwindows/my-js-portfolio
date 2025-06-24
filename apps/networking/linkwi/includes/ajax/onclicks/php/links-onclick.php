<?php 
require ('../../../../../includes/linkwi.php');

function Link_OnClick($link_uniqueid,$id){

$user_ip = getenv('REMOTE_ADDR');
$geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$user_ip"));
$country = $geo["geoplugin_countryName"];
$city = $geo["geoplugin_city"];
$date = date("Y-m-d");


if(!isset($_COOKIE[$link_uniqueid.$id])){
	setCookie($link_uniqueid.$id,'yes',time()+(60*60*24*30));
	$db = new dbase;
	$db->query("UPDATE links SET link_count = link_count + 1 WHERE link_uniqueid =:id");
	$db->bind(':id', $link_uniqueid, PDO::PARAM_STR);
	$db->execute();
	
$db->query("INSERT INTO View_Link_Stats(City,UniqueID,Date,LinkID) VALUES (:country,:id,:date,:linkid)");
$db->bind(':country', $country, PDO::PARAM_STR);
$db->bind(':id', $id, PDO::PARAM_STR);
$db->bind(':date', $date, PDO::PARAM_STR);
$db->bind(':linkid', $link_uniqueid, PDO::PARAM_STR);
$db->execute();

}

}

Link_OnClick($_POST['button'],custom_decrypt($_POST['userid'],SECRET_KEY,SECRET_IV));

echo $_POST['button'];
echo custom_decrypt($_POST['userid'],SECRET_KEY,SECRET_IV);
?>